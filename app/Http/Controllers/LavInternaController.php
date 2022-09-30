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
            'descrizione' => ['required','max:80'],
            'costo_utensileria' => ['required','numeric'],
            'minuti_setup' => ['required','numeric'],
            'perc_resa' => ['nullable','numeric'],
            'tempo_pezzo' => ['required','numeric'],
        ]);

        //Validazione degli input
        $validator->validate();

        LavInterna::create([
            'id_articolo' => $articolo->id,
            'id_macchinario' => $request->id_macchinario,
            'descrizione' => $request->descrizione,
            'costo_utensileria' => $request->costo_utensileria,
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LavInterna $lavInterna)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LavInterna  $lavInterna
     * @return \Illuminate\Http\Response
     */
    public function destroy(LavInterna $lavInterna)
    {
        //
    }
}