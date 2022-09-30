<?php

namespace App\Http\Controllers;

use App\Models\Articolo;
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
            'codice' => ['required','max:80'],
            'descrizione' => ['required','max:80'],
            'perc_aggiunta_prezzo' => ['required', 'numeric','max:100'],
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
            'codice' => $request->codice,
            'descrizione' => $request->descrizione,
            'perc_aggiunta_prezzo' => $request->perc_aggiunta_pezzo ?? 5,
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
                'tipo' => 'Lavorazione interna',
                'delete' => route('lav_interne.destroy',[$articolo,$lavorazione_interna])
            ];
        }

        //Recupero tutti i costi in un unico array
        $elenco_esterne = [];

        foreach ($articolo->lav_esterne as $lavorazione_esterna){

            $elenco_esterne[$lavorazione_esterna->id] = [
                'descrizione' => $lavorazione_esterna->descrizione,
                'tipo' => 'Lavorazione esterna',
                'delete' => route('lav_esterne.destroy',[$articolo,$lavorazione_esterna])
            ];
        }

        //Recupero tutti i costi in un unico array
        $elenco_altri_costi = [];

        foreach ($articolo->altri_costi as $altro_costo){

            $elenco_altri_costi[$altro_costo->id] = [
                'descrizione' => $altro_costo->descrizione,
                'tipo' => 'Altro costo',
                'delete' => route('altri_costi.destroy',[$articolo,$altro_costo])
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
                    $costo_lavorazione = $lavorazione_interna->tempo_effettivo * ($macchinario->costo_orario_macchina / 3600);
                    $costo_setup = $lavorazione_interna->minuti_setup / 60 * $macchinario->costo_orario_setup;
                    $costo_setup_qta = $costo_setup / $qta;
                    $costo_utensileria_qta = $lavorazione_interna->costo_utensileria / $qta;
                    //TODO costo struttura farlo parametrico
                    $costo_struttura_qta = (1400 / 175 / 7) * ($lavorazione_interna->tempo_effettivo * $qta / 3600) / $qta;

                    if(isset($costo[$i]['lav_interne'])){
                        $costo[$i]['lav_interne'] += $costo_lavorazione + $costo_setup_qta + $costo_utensileria_qta;
                    }else{
                        $costo[$i]['lav_interne'] = $costo_lavorazione + $costo_setup_qta + $costo_utensileria_qta;
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
                            $costo_lavorazione_esterna = $lavorazioni_esterne->importo / 1000 * $articolo->peso_articolo;
                            break;
                        //Singolo pezzo
                        case 3:
                            $costo_lavorazione_esterna = $lavorazioni_esterne->importo;
                            break;
                    }

                    if(isset($costo[$i]['lav_esterne'])){
                        $costo[$i]['lav_esterne'] += $costo_lavorazione_esterna;
                    }else{
                        $costo[$i]['lav_esterne'] = $costo_lavorazione_esterna;
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

                    if(isset($costo[$i]['altri_costi'])){
                        $costo[$i]['altri_costi'] += $altro_costo->importo / $qta;
                    }else{
                        $costo[$i]['altri_costi'] = $altro_costo->importo / $qta;
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

                //Calcolo il ricarico
                $costo[$i]['costo'] =  $costo[$i]['costo'] / 100 * $articolo->perc_aggiunta_prezzo + $costo[$i]['costo'];

            }else{

                $costo[$i]['costo'] = 0;
                $costo[$i]['altri_costi'] = 0;
                $costo[$i]['lav_esterne'] = 0;
                $costo[$i]['lav_interne'] = 0;
            }

        }




        $data = [
            'articolo' => $articolo,
            'materiali' => Materiale::pluck('nome','id'),
            'clienti' => Cliente::pluck('nome','id'),
            'tipologie' => TipologiaLavEsterna::pluck('descrizione','id'),
            'macchinari' => Macchinario::pluck('nome','id'),
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
            'codice' => ['required','max:80'],
            'descrizione' => ['required','max:80'],
            'perc_aggiunta_prezzo' => ['required', 'numeric','max:100'],
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
            'codice' => $request->codice,
            'descrizione' => $request->descrizione,
            'perc_aggiunta_prezzo' => $request->perc_aggiunta_pezzo ?? 5,
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
        //
    }
}
