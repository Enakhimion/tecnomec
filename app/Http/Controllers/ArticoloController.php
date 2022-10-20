<?php

namespace App\Http\Controllers;

use App\Models\AltroCosto;
use App\Models\Articolo;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Macchinario;
use App\Models\Materiale;
use App\Models\Preventivo;
use App\Models\TipologiaLavEsterna;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ArticoloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {

        $data = [
            'materiali' => Materiale::pluck('nome','id'),
            'clienti' => Cliente::pluck('nome','id'),
            'categorie' => Categoria::pluck('descrizione','id'),
        ];

        return view('articoli.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        /*--- Inizio validazione input --*/

        //Validazione dei campi presi in input
        $validator = Validator::make(request()->all(),[
            'id_materiale' => ['required','numeric','exists:materiali,id'],
            'id_cliente' => ['required','numeric','exists:clienti,id'],
            'id_categoria' => ['required','numeric','exists:categorie,id'],
            'codice' => ['required','max:80',Rule::unique('articoli')->where(function ($query) use ($request) {
                return $query->where('id_cliente', $request->id_cliente);
            })],
            'descrizione' => ['required','max:80'],
            'peso_articolo' => ['required','numeric'],
            'lunghezza_tornito' => ['required','numeric'],
            'spessore_taglio' => ['nullable','numeric'],
            'sovrametallo' => ['nullable','numeric'],
            'lunghezza_barra' => ['nullable','numeric'],
            'lunghezza_spezzone' => ['nullable','numeric'],
            'recupero' => ['nullable','numeric'],
            'is_contolavoro'  => ['nullable'],
        ]);

        //Validazione degli input
        $validator->validate();

        $articolo = Articolo::create([
            'id_materiale' => $request->id_materiale,
            'id_cliente' => $request->id_cliente,
            'id_categoria' => $request->id_categoria,
            'codice' => $request->codice,
            'descrizione' => $request->descrizione,
            'peso_articolo' => $request->peso_articolo,
            'lunghezza_tornito' => $request->lunghezza_tornito,
            'spessore_taglio' => $request->spessore_taglio ?? 3,
            'sovrametallo' => $request->sovrametallo ?? 0.5,
            'lunghezza_barra' => $request->lunghezza_barra ?? 3000,
            'lunghezza_spezzone' => $request->lunghezza_spezzone ??150,
            'recupero' => $request->recupero ?? 0.1,
            'is_contolavoro' => $request->is_contolavoro ? 1 : 0
        ]);

        //Creo anche il preventivo
        Preventivo::create([
            'id_articolo' => $articolo->id,
            'data' => Carbon::now(),
            'qta1' => 0,
        ]);

        //Creo i costi di trasporto e consegna di default
        AltroCosto::create([
            'id_articolo' => $articolo->id,
            'descrizione' => 'Consegna',
            'importo' => 8
        ]);

        AltroCosto::create([
            'id_articolo' => $articolo->id,
            'descrizione' => 'Trasporto',
            'importo' => 8
        ]);

        return redirect()->route('articoli.edit', $articolo)->with('success', 'Articolo inserito correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articolo  $articolo
     * @return \Illuminate\Http\Response
     */
    public function show(Articolo $articolo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articolo  $articolo
     * @return Application|Factory|View
     * TODO migliorare la funzione
     */
    public function edit(Articolo $articolo)
    {

        //Recupero tutti i costi in un unico array
        $elenco_interne = [];

        foreach ($articolo->lav_interne as $lavorazione_interna){

            $elenco_interne[$lavorazione_interna->id] = [
                'descrizione' => $lavorazione_interna->descrizione,
                'tempo_effettivo' => $lavorazione_interna->tempo_effettivo,
                'stato' => $lavorazione_interna->stato === 'S' ? '<i class="fa-solid fa-check"></i>' : '<i class="fa-solid fa-xmark"></i>',
                'tipo' => 'Lavorazione interna',
                'delete' => route('lav_interne.destroy',[$articolo,$lavorazione_interna])
            ];
        }

        //Recupero tutti i costi in un unico array
        $elenco_esterne = [];

        foreach ($articolo->lav_esterne as $lavorazione_esterna){

            $elenco_esterne[$lavorazione_esterna->id] = [
                'descrizione' => $lavorazione_esterna->descrizione,
                'stato' => $lavorazione_esterna->stato === 'S' ? 'Attiva, clicca qui per disattivarla' : 'Disattivata, clicca qui per attivarla',
                'tipo' => 'Lavorazione/Trattamento',
                'delete' => route('lav_esterne.destroy',[$articolo,$lavorazione_esterna]),
                'importo'=> $lavorazione_esterna->importo
            ];
        }

        //Recupero tutti i costi in un unico array
        $elenco_altri_costi = [];

        foreach ($articolo->altri_costi as $altro_costo){

            $elenco_altri_costi[$altro_costo->id] = [
                'descrizione' => $altro_costo->descrizione,
                'tipo' => 'Altro costo',
                'delete' => route('altri_costi.destroy',[$articolo,$altro_costo]),
                'importo' => $altro_costo->importo
            ];
        }

        //Calcolo i costi dell'articolo
        $preventivo = $articolo->preventivi[0];
        $materiale = $articolo->materiale;

        //Calcolo il costo del materiale univoco per tutte le quantita
        $pesomm = $materiale->peso / 1000;
        $peso_tronchetto = $pesomm * $articolo->lunghezza_tronchetto_totale;
        $recupero = ($articolo->lunghezza_tronchetto_totale - $articolo->lunghezza_tronchetto * $peso_tronchetto) * $articolo->recupero / 1000;
        $costo_mat_mm = $pesomm * $materiale->prezzo_kg;
        $costo_materiale = $articolo->is_contolavoro ? 0 : $costo_mat_mm * $articolo->lunghezza_tronchetto_totale - $recupero;
        $costo_materiale = $costo_materiale / 100 * $preventivo->ricarico_materiale + $costo_materiale;

        $costi = [];

        for ($i = 0; $i < 4; $i++){

            //In base al numero del ciclo prendo la qta
            switch ($i) {
                case 0:
                    $qta = $preventivo->qta1;
                    break;
                case 1:
                    $qta = $preventivo->qta2;
                    break;
                case 2:
                    $qta = $preventivo->qta3;
                    break;
                case 3:
                    $qta = $preventivo->qta4;
                    break;
            }

            if($qta !== null && $qta !== 0){

                //Calcolo le lavorazioni interne
                foreach ($articolo->lav_interne as $lavorazione_interna){

                    $macchinario = $lavorazione_interna->macchinario;

                    //Se il costo macchina della lavorazione interna e null recupero il costo orario macchina del macchinario collegato
                    if($lavorazione_interna->costo_orario_macchina === null){
                        $lavorazione_interna->update(['costo_orario_macchina' => $macchinario->costo_orario_macchina]);
                    }

                    if($lavorazione_interna->costo_setup === null){
                        $lavorazione_interna->update(['costo_setup' => $macchinario->costo_orario_setup]);
                    }


                    $costo_lavorazione = $lavorazione_interna->tempo_effettivo * ($lavorazione_interna->costo_orario_macchina / 3600);
                    $costo_setup = $lavorazione_interna->minuti_setup / 60 * $lavorazione_interna->costo_setup;
                    $costo_setup_qta = $costo_setup / $qta;
                    $costo_utensileria_qta = $lavorazione_interna->costo_utensileria / $qta;
                    //TODO costo struttura farlo parametrico
                    $costo_struttura_qta = (1400 / 175 / 7) * ($lavorazione_interna->tempo_effettivo * $qta / 3600) / $qta;
                    //Costo totale senza ricarico
                    $tot = $costo_lavorazione + $costo_setup_qta + $costo_utensileria_qta + $costo_struttura_qta;

                    if($lavorazione_interna->stato === 'S'){
                        if(isset($costo[$i]['lav_interne']) ){
                            $costo[$i]['lav_interne'] += $tot / 100 * $preventivo->ricarico_interne + $tot;
                        }else{
                            $costo[$i]['lav_interne'] = $tot / 100 * $preventivo->ricarico_interne + $tot;
                        }
                    }else{
                        if(isset($costo[$i]['lav_interne']) ){
                            $costo[$i]['lav_interne'] += 0;
                        }else{
                            $costo[$i]['lav_interne'] = 0;
                        }
                    }


                    //In base al numero decido che key dargli
                    switch ($i) {
                        case 0:
                            $elenco_interne[$lavorazione_interna->id]['qta1'] = $costo_lavorazione + $costo_setup_qta + $costo_utensileria_qta;
                            $elenco_interne[$lavorazione_interna->id]['qta2'] = 0;
                            $elenco_interne[$lavorazione_interna->id]['qta3'] = 0;
                            $elenco_interne[$lavorazione_interna->id]['qta4'] = 0;
                            break;
                        case 1:
                            $elenco_interne[$lavorazione_interna->id]['qta2'] = $costo_lavorazione + $costo_setup_qta + $costo_utensileria_qta;
                            break;
                        case 2:
                            $elenco_interne[$lavorazione_interna->id]['qta3'] = $costo_lavorazione + $costo_setup_qta + $costo_utensileria_qta;
                            break;
                        case 3:
                            $elenco_interne[$lavorazione_interna->id]['qta4'] = $costo_lavorazione + $costo_setup_qta + $costo_utensileria_qta;
                            break;
                    }

                }

                //Controllo se non ha lavorazioni interene
                if(count($articolo->lav_interne) === 0){
                    $costo[$i]['lav_interne'] = 0;
                }

                //Calcolo le lavorazioni esterne
                foreach ($articolo->lav_esterne as $lavorazioni_esterne){

                    $costo_lavorazione_esterna = 0;

                    //In base alla tipologia cambia il calcolo
                    switch ($lavorazioni_esterne->id_tipologia) {
                        //Al lotto
                        case 1:
                            $costo_lavorazione_esterna = $lavorazioni_esterne->importo / $qta;
                            break;
                        //Al KG
                        case 2:
                            $costo_lavorazione_esterna = $lavorazioni_esterne->importo * $articolo->peso_articolo;
                            break;
                        //Singolo pezzo
                        case 3:
                            $costo_lavorazione_esterna = $lavorazioni_esterne->importo;
                            break;
                    }

                    if($lavorazione_esterna->stato === 'S'){
                        if(isset($costo[$i]['lav_esterne'])){
                            $costo[$i]['lav_esterne'] += $costo_lavorazione_esterna / 100 * $preventivo->ricarico_esterne + $costo_lavorazione_esterna;
                        }else{
                            $costo[$i]['lav_esterne'] = $costo_lavorazione_esterna / 100 * $preventivo->ricarico_esterne + $costo_lavorazione_esterna;
                        }
                    }else{
                        if(isset($costo[$i]['lav_esterne'])){
                            $costo[$i]['lav_esterne'] += 0;
                        }else{
                            $costo[$i]['lav_esterne'] = 0;
                        }
                    }



                    //In base al numero decido che key dargli
                    switch ($i) {
                        case 0:
                            $elenco_esterne[$lavorazioni_esterne->id]['qta1'] = $costo_lavorazione_esterna;
                            $elenco_esterne[$lavorazioni_esterne->id]['qta2'] = 0;
                            $elenco_esterne[$lavorazioni_esterne->id]['qta3'] = 0;
                            $elenco_esterne[$lavorazioni_esterne->id]['qta4'] = 0;
                            break;
                        case 1:
                            $elenco_esterne[$lavorazioni_esterne->id]['qta2'] = $costo_lavorazione_esterna;
                            break;
                        case 2:
                            $elenco_esterne[$lavorazioni_esterne->id]['qta3'] = $costo_lavorazione_esterna;
                            break;
                        case 3:
                            $elenco_esterne[$lavorazioni_esterne->id]['qta4'] = $costo_lavorazione_esterna;
                            break;
                    }
                }

                //Controllo se non ha lavorazioni esterne
                if(count($articolo->lav_esterne) === 0){
                    $costo[$i]['lav_esterne'] = 0;
                }

                //Calcolo altri costi
                foreach ($articolo->altri_costi as $altro_costo){

                    //Importo degli altri costi
                    $costo_altro = $altro_costo->importo / $qta;

                    if(isset($costo[$i]['altri_costi'])){
                        $costo[$i]['altri_costi'] += $costo_altro / 100 * $preventivo->ricarico_esterne + $costo_altro;
                    }else{
                        $costo[$i]['altri_costi'] = $costo_altro / 100 * $preventivo->ricarico_esterne + $costo_altro;
                    }



                    //In base al numero decido che key dargli
                    switch ($i) {
                        case 0:
                            $elenco_altri_costi[$altro_costo->id]['qta1'] = $altro_costo->importo / $qta;
                            $elenco_altri_costi[$altro_costo->id]['qta2'] = 0;
                            $elenco_altri_costi[$altro_costo->id]['qta3'] = 0;
                            $elenco_altri_costi[$altro_costo->id]['qta4'] = 0;
                            break;
                        case 1:
                            $elenco_altri_costi[$altro_costo->id]['qta2'] = $altro_costo->importo / $qta;
                            break;
                        case 2:
                            $elenco_altri_costi[$altro_costo->id]['qta3'] = $altro_costo->importo / $qta;
                            break;
                        case 3:
                            $elenco_altri_costi[$altro_costo->id]['qta4'] = $altro_costo->importo / $qta;
                            break;
                    }
                }

                //Controllo se non ha altri_costi
                if(count($articolo->altri_costi) === 0){
                    $costo[$i]['altri_costi'] = 0;
                }

                //Totalone
                $costo[$i]['costo'] = $costo[$i]['altri_costi'] + $costo[$i]['lav_esterne'] + $costo[$i]['lav_interne'] + $costo_materiale;

                $costo[$i]['lunghezza'] = ceil($articolo->lunghezza_tronchetto_totale * $qta / $articolo->lunghezza_barra);
                $costo[$i]['peso'] = ceil($materiale->peso * ($articolo->lunghezza_barra / 1000) * $costo[$i]['lunghezza']);

            }else{

                $costo[$i]['costo'] = 0;
                $costo[$i]['altri_costi'] = 0;
                $costo[$i]['lav_esterne'] = 0;
                $costo[$i]['lav_interne'] = 0;
                $costo[$i]['lunghezza'] = 0;
                $costo[$i]['peso'] = 0;
            }

        }




        $data = [
            'articolo' => $articolo,
            'materiali' => Materiale::pluck('nome','id'),
            'clienti' => Cliente::pluck('nome','id'),
            'tipologie' => TipologiaLavEsterna::pluck('descrizione','id'),
            'macchinari' => Macchinario::pluck('nome','id'),
            'categorie' => Categoria::pluck('descrizione','id'),
            'costo' => $costo,
            'costo_materiale' => $costo_materiale,
            'elenco_interne'=> $elenco_interne,
            'elenco_esterne' => $elenco_esterne,
            'elenco_altri_costi' => $elenco_altri_costi
        ];

        return view('articoli.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articolo  $articolo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Articolo $articolo)
    {
        /*--- Inizio validazione input --*/

        //Validazione dei campi presi in input
        $validator = Validator::make(request()->all(),[
            'id_materiale' => ['required','numeric','exists:materiali,id'],
            'id_cliente' => ['required','numeric','exists:clienti,id'],
            'id_categoria' => ['required','numeric','exists:categorie,id'],
            'codice' => ['required','max:80',Rule::unique('articoli')->where(function ($query) use ($request) {
                return $query->where('id_cliente', $request->id_cliente);
            })],
            'descrizione' => ['required','max:80'],
            'peso_articolo' => ['required','numeric'],
            'lunghezza_tornito' => ['required','numeric'],
            'spessore_taglio' => ['nullable','numeric'],
            'sovrametallo' => ['nullable','numeric'],
            'lunghezza_barra' => ['nullable','numeric'],
            'lunghezza_spezzone' => ['nullable','numeric'],
            'recupero' => ['nullable','numeric'],
            'is_contolavoro'  => [Rule::in(0,1)],
        ]);

        //Validazione degli input
        $validator->validate();

        $articolo->update([
            'id_materiale' => $request->id_materiale,
            'id_cliente' => $request->id_cliente,
            'id_categoria' => $request->id_categoria,
            'codice' => $request->codice,
            'descrizione' => $request->descrizione,
            'peso_articolo' => $request->peso_articolo,
            'lunghezza_tornito' => $request->lunghezza_tornito,
            'spessore_taglio' => $request->spessore_taglio ?? 3,
            'sovrametallo' => $request->sovrametallo ?? 0.5,
            'lunghezza_barra' => $request->lunghezza_barra ?? 3000,
            'lunghezza_spezzone' => $request->lunghezza_spezzone ??150,
            'recupero' => $request->recupero ?? 0.1,
            'is_contolavoro' => $request->is_contolavoro
        ]);

        return back()->with('success', 'Articolo inserito correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articolo  $articolo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articolo $articolo)
    {

        //Elimino tutti gli oggetti collegati all'articolo
        foreach($articolo->lav_interne as $lav_interna){
            $lav_interna->delete();
        }

        foreach($articolo->lav_esterne as $lav_esterna){
            $lav_esterna->delete();
        }

        foreach($articolo->altri_costi as $altro_costo){
            $altro_costo->delete();
        }

        foreach($articolo->preventivi as $preventivo){
            $preventivo->delete();
        }

        $articolo->delete();

        return redirect()->route('dashboard');

    }
}
