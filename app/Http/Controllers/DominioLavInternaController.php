<?php

namespace App\Http\Controllers;

use App\Models\DominioLavInterna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DominioLavInternaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'domini_lav_interne' => \App\Models\DominioLavInterna::all()
        ];

        return view('domini_lav_interne.index', $data);
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
        /*--- Inizio validazione input --*/

        //Validazione dei campi presi in input
        $validator = Validator::make(request()->all(),[
            'descrizione' => ['required','max:250','unique:domini_lav_interne,descrizione']
        ]);

        //Validazione degli input
        $validator->validate();

        DominioLavInterna::create([
            'descrizione' => $request->descrizione
        ]);

        return back()->with('success','Descrizione inserita correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DominioLavInterna  $dominioLavInterna
     * @return \Illuminate\Http\Response
     */
    public function show(DominioLavInterna $dominioLavInterna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DominioLavInterna  $dominioLavInterna
     * @return \Illuminate\Http\Response
     */
    public function edit(DominioLavInterna $dominioLavInterna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DominioLavInterna  $dominioLavInterna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DominioLavInterna $dominioLavInterna)
    {
        /*--- Inizio validazione input --*/

        //Validazione dei campi presi in input
        $validator = Validator::make(request()->all(),[
            'nome' => ['required','max:250',Rule::unique('domini_lav_interne')->where(function ($query) use ($dominioLavInterna) {
                return $query->where('id','!=', $dominioLavInterna->id);
            })]
        ]);

        //Validazione degli input
        $validator->validate();

        $dominioLavInterna->update([
            'descrizione' => $request->descrizione
        ]);

        return back()->with('success','Descrizione inserita correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DominioLavInterna  $dominioLavInterna
     * @return \Illuminate\Http\Response
     */
    public function destroy(DominioLavInterna $dominioLavInterna)
    {
        //
    }
}
