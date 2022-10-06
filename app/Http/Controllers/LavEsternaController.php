<?php

namespace App\Http\Controllers;

use App\Models\Articolo;
use App\Models\LavEsterna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LavEsternaController extends Controller
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
            'id_tipologia' => ['required','numeric','exists:tipologie_lav_esterne,id'],
            'descrizione' => ['required','max:80'],
            'importo' => ['required','numeric'],
        ]);

        //Validazione degli input
        $validator->validate();

        LavEsterna::create([
            'id_articolo' => $articolo->id,
            'id_tipologia' => $request->id_tipologia,
            'descrizione' => $request->descrizione,
            'importo' => $request->importo
        ]);

        return back()->with('success','Lavorazione esterna insertia correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LavEsterna  $lavEsterna
     * @return \Illuminate\Http\Response
     */
    public function show(LavEsterna $lavEsterna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LavEsterna  $lavEsterna
     * @return \Illuminate\Http\Response
     */
    public function edit(LavEsterna $lavEsterna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LavEsterna  $lavEsterna
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Articolo $articolo, LavEsterna $lav_esterna)
    {
        /*--- Inizio validazione input --*/

        //Validazione dei campi presi in input
        $validator = Validator::make(request()->all(),[
            'id_tipologia' => ['required','numeric','exists:tipologie_lav_esterne,id'],
            'descrizione' => ['required','max:80'],
            'importo' => ['required','numeric'],
        ]);

        //Validazione degli input
        $validator->validate();

        $lav_esterna->update([
            'id_articolo' => $articolo->id,
            'id_tipologia' => $request->id_tipologia,
            'descrizione' => $request->descrizione,
            'importo' => $request->importo
        ]);

        return back()->with('success','Lavorazione esterna aggiornata correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LavEsterna  $lavEsterna
     * @return \Illuminate\Http\Response
     */
    public function destroy(Articolo $articolo,LavEsterna $lav_esterna)
    {
        $lav_esterna->delete();

        return back()->with('success','Lavorazione eliminata correttamente');
    }
}
