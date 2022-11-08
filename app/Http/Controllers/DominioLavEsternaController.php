<?php

namespace App\Http\Controllers;

use App\Models\DominioLavEsterna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DominioLavEsternaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'domini_lav_esterne' => \App\Models\DominioLavEsterna::all()
        ];

        return view('domini_lav_esterne.index', $data);
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
            'descrizione' => ['required','max:250','unique:domini_lav_esterne,descrizione']
        ]);

        //Validazione degli input
        $validator->validate();

        DominioLavEsterna::create([
            'descrizione' => $request->descrizione
        ]);

        return back()->with('success','Descrizione inserita correttamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DominioLavEsterna  $dominioLavEsterna
     * @return \Illuminate\Http\Response
     */
    public function show(DominioLavEsterna $dominioLavEsterna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DominioLavEsterna  $dominioLavEsterna
     * @return \Illuminate\Http\Response
     */
    public function edit(DominioLavEsterna $dominioLavEsterna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DominioLavEsterna  $dominioLavEsterna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DominioLavEsterna $dominioLavEsterna)
    {
        /*--- Inizio validazione input --*/

        //Validazione dei campi presi in input
        $validator = Validator::make(request()->all(),[
            'nome' => ['required','max:250',Rule::unique('domini_lav_esterne')->where(function ($query) use ($dominioLavEsterna) {
                return $query->where('id','!=', $dominioLavEsterna->id);
            })]
        ]);

        //Validazione degli input
        $validator->validate();

        $dominioLavEsterna->update([
            'descrizione' => $request->descrizione
        ]);

        return back()->with('success','Descrizione inserita correttamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DominioLavEsterna  $dominioLavEsterna
     * @return \Illuminate\Http\Response
     */
    public function destroy(DominioLavEsterna $dominioLavEsterna)
    {
        //
    }
}
