<?php

namespace App\Http\Controllers;

use App\Models\Articolo;
use App\Models\Preventivo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PreventivoController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Preventivo  $preventivo
     * @return \Illuminate\Http\Response
     */
    public function show(Preventivo $preventivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Preventivo  $preventivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Preventivo $preventivo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Preventivo  $preventivo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request,Articolo $articolo, Preventivo $preventivo)
    {
        /*--- Inizio validazione input --*/

        //Validazione dei campi presi in input
        $validator = Validator::make(request()->all(),[
            'ricarico_materiale' => ['required','numeric'],
            'ricarico_interne' => ['required','numeric'],
            'ricarico_esterne' => ['required','numeric'],
            'ricarico_altro' => ['required','numeric'],
            'qta1' => ['required','numeric'],
            'qta2' => ['nullable','numeric'],
            'qta3' => ['nullable','numeric'],
            'qta4' => ['nullable','numeric'],
            'prezzo1' => ['nullable','numeric'],
            'prezzo2' => ['nullable','numeric'],
            'prezzo3' => ['nullable','numeric'],
            'prezzo4' => ['nullable','numeric']
        ]);

        //Validazione degli input
        $validator->validate();

        //Aggiorno il preventivo
        $preventivo->update([
            'ricarico_materiale' => $request->ricarico_materiale,
            'ricarico_interne' => $request->ricarico_interne,
            'ricarico_esterne' => $request->ricarico_esterne,
            'ricarico_altro' => $request->ricarico_altro,
            'qta1' => $request->qta1,
            'qta2' => $request->qta2,
            'qta3' => $request->qta3,
            'qta4' => $request->qta4,
            'prezzo1' => $request->prezzo1,
            'prezzo2' => $request->prezzo2,
            'prezzo3' => $request->prezzo3,
            'prezzo4' => $request->prezzo4
        ]);

        return back()->with('success','Preventivo aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Preventivo  $preventivo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Articolo $articolo, Preventivo $preventivo)
    {
        //Elimino il preventivo
        $preventivo->delete();

        //Creo anche il preventivo
        Preventivo::create([
            'id_articolo' => $articolo->id,
            'data' => Carbon::now(),
            'qta1' => 0,
        ]);

        return back()->with('success','Preventivo eliminato con successo');
    }
}
