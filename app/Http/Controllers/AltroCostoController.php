<?php

namespace App\Http\Controllers;

use App\Models\AltroCosto;
use App\Models\Articolo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AltroCostoController extends Controller
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
            'descrizione' => ['required','max:80'],
            'importo' => ['required','numeric'],
        ]);

        //Validazione degli input
        $validator->validate();

        AltroCosto::create([
            'id_articolo' => $articolo->id,
            'descrizione' => $request->descrizione,
            'importo' => $request->importo
        ]);

        return back()->with('success','Altro costo insertito correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AltroCosto  $altroCosto
     * @return \Illuminate\Http\Response
     */
    public function show(AltroCosto $altroCosto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AltroCosto  $altroCosto
     * @return \Illuminate\Http\Response
     */
    public function edit(AltroCosto $altroCosto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AltroCosto  $altroCosto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AltroCosto $altroCosto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AltroCosto  $altroCosto
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Articolo $articolo, AltroCosto $altroCosto)
    {
        $altroCosto->delete();

        return back()->with('success','Costo eliminato correttamente');
    }
}
