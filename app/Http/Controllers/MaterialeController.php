<?php

namespace App\Http\Controllers;

use App\Models\Materiale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialeController extends Controller
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
            'nome' => ['required','max:250','unique:materiali,nome'],
            'peso' => ['required','numeric'],
            'base' => ['required','numeric'],
            'extra' => ['required','numeric'],
        ]);

        //Validazione degli input
        $validator->validate();

        Materiale::create([
            'nome' => $request->nome,
            'peso' => $request->peso,
            'base' => $request->base,
            'extra' => $request->extra,
            'prezzo_kg' => $request->base + $request->extra
        ]);

        return back()->with('success','Materiale inserito correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
