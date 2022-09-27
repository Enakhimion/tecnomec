<?php

namespace App\Http\Controllers;

use App\Models\Macchinario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MacchinarioController extends Controller
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
    public function store(Request $request)
    {
        /*--- Inizio validazione input --*/

        //Validazione dei campi presi in input
        $validator = Validator::make(request()->all(),[
            'nome' => ['required','max:80'],
            'descrizione' => ['required','max:80'],
            'costo_orario_macchina' => ['required','numeric'],
            'costo_orario_setup' => ['required','numeric'],
        ]);

        //Validazione degli input
        $validator->validate();

        Macchinario::create([
            'nome' => $request->nome,
            'descrizione' => $request->descrizione,
            'costo_orario_macchina' => $request->costo_orario_macchina,
            'costo_orario_setup' => $request->costo_orario_setup
        ]);

        return back()->with('success','Macchinario insertio correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Macchinario  $macchinario
     * @return \Illuminate\Http\Response
     */
    public function show(Macchinario $macchinario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Macchinario  $macchinario
     * @return \Illuminate\Http\Response
     */
    public function edit(Macchinario $macchinario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Macchinario  $macchinario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Macchinario $macchinario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Macchinario  $macchinario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Macchinario $macchinario)
    {
        //
    }
}
