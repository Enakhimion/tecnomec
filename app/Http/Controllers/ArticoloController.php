<?php

namespace App\Http\Controllers;

use App\Models\Articolo;
use App\Models\Cliente;
use App\Models\Materiale;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'codice' => ['required','numeric'],
            'descrizione' => ['required','max:80'],
            //'perc_aggiunta_prezzo' => ['required', 'numeric','max:100'],
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
     */
    public function edit(Articolo $articolo)
    {
        $data = [
            'articolo' => $articolo,
            'materiali' => Materiale::pluck('nome','id'),
            'clienti' => Cliente::pluck('nome','id'),
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
            'codice' => ['required','numeric'],
            'descrizione' => ['required','max:80'],
            //'perc_aggiunta_prezzo' => ['required', 'numeric','max:100'],
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
            'is_contolavoro' => $request->is_contolavoro ? 1 : 0
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
