<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'clienti' => \App\Models\Cliente::all()
        ];

        return view('clienti.index', $data);
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
            'nome' => ['required','max:250','unique:clienti,nome'],
            'desinenza' => ['required','max:250','unique:clienti,desinenza'],
        ]);

        //Validazione degli input
        $validator->validate();

        Cliente::create([
            'nome' => $request->nome,
            'desinenza' => $request->desinenza
        ]);

        return back()->with('success','Cliente inserito correttamente');
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
    public function update(Request $request, Cliente $cliente)
    {
        /*--- Inizio validazione input --*/

        //Validazione dei campi presi in input
        $validator = Validator::make(request()->all(),[
            'nome' => ['required','max:250',Rule::unique('clienti')->where(function ($query) use ($cliente) {
                return $query->where('id','!=', $cliente->id);
            })],
            'desinenza' => ['required',Rule::unique('clienti')->where(function ($query) use ($cliente) {
                return $query->where('id','!=', $cliente->id);
            })],
        ]);

        //Validazione degli input
        $validator->validate();

        $cliente->update([
            'nome' => $request->nome,
            'desinenza' => $request->desinenza
        ]);

        return back()->with('success','Cliente aggiornato correttamente');
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
