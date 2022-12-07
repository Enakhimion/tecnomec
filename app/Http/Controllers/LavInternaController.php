<?php

namespace App\Http\Controllers;

use App\Models\Articolo;
use App\Models\LavInterna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LavInternaController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Articolo $articolo)
    {
        /*--- Inizio validazione input --*/

        //Validazione dei campi presi in input
        $validator = Validator::make(request()->all(),[
            'id_macchinario' => ['required','numeric','exists:macchinari,id'],
            'id_dominio_lav_interna' => ['required','numeric','exists:domini_lav_interne,id'],
            'costo_utensileria' => ['required','numeric'],
            'costo_setup' => ['nullable','numeric'],
            'costo_orario_macchina' => ['nullable','numeric'],
            'minuti_setup' => ['required','numeric'],
            'perc_resa' => ['nullable','numeric'],
            'tempo_pezzo' => ['required','numeric'],
        ]);

        //Validazione degli input
        $validator->validate();

        LavInterna::create([
            'id_articolo' => $articolo->id,
            'id_macchinario' => $request->id_macchinario,
            'id_dominio_lav_interna' => $request->id_dominio_lav_interna,
            'costo_utensileria' => $request->costo_utensileria,
            'costo_setup' => $request->costo_setup,
            'costo_orario_macchina' => $request->costo_orario_macchina,
            'minuti_setup' => $request->minuti_setup,
            'perc_resa' => $request->perc_resa ?? 85,
            'tempo_pezzo' => $request->tempo_pezzo,
        ]);

        return back()->with('success','Lavorazione interna insertia correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LavInterna  $lavInterna
     * @return \Illuminate\Http\Response
     */
    public function show(LavInterna $lavInterna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LavInterna  $lavInterna
     * @return \Illuminate\Http\Response
     */
    public function edit(LavInterna $lavInterna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LavInterna  $lavInterna
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Articolo $articolo, LavInterna $lav_interna)
    {
        /*--- Inizio validazione input --*/

        //Validazione dei campi presi in input
        $controlli = [
            'id_macchinario' => ['required','numeric','exists:macchinari,id'],
            'costo_utensileria' => ['required','numeric'],
            'costo_setup' => ['nullable','numeric'],
            'costo_orario_macchina' => ['nullable','numeric'],
            'minuti_setup' => ['required','numeric'],
            'perc_resa' => ['nullable','numeric'],
            'tempo_pezzo' => ['required','numeric'],
        ];

        if($lav_interna->descrizione !== null){
            $controlli['id_dominio_lav_interna'] = ['nullable','numeric','exists:domini_lav_interne,id'];
        }else{
            $controlli['id_dominio_lav_interna'] = ['required','numeric','exists:domini_lav_interne,id'];
        }

        //Validazione dei campi presi in input
        $validator = Validator::make(request()->all(), $controlli);

        //Validazione degli input
        $validator->validate();

        $lav_interna->update([
            'id_articolo' => $articolo->id,
            'id_macchinario' => $request->id_macchinario,
            'id_dominio_lav_interna' => $request->id_dominio_lav_interna,
            'costo_utensileria' => $request->costo_utensileria,
            'costo_setup' => $request->costo_setup,
            'costo_orario_macchina' => $request->costo_orario_macchina,
            'minuti_setup' => $request->minuti_setup,
            'perc_resa' => $request->perc_resa ?? 85,
            'tempo_pezzo' => $request->tempo_pezzo,
        ]);

        return back()->with('success','Lavorazione interna aggiornata correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LavInterna  $lavInterna
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articolo $articolo, LavInterna $lav_interna)
    {
        $lav_interna->delete();

        return back()->with('success', "Lavorazione interna eliminata correttamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LavEsterna  $lavEsterna
     * @return \Illuminate\Http\Response
     */
    public function soft_delete(Articolo $articolo,LavInterna $lav_interna)
    {

        if($lav_interna->stato === 'S'){

            $lav_interna->update(['stato' => 'N']);
            return back()->with('success','Lavorazione disattivata correttamente');

        }else{

            $lav_interna->update(['stato' => 'S']);
            return back()->with('success','Lavorazione attivata correttamente');

        }
    }
}
