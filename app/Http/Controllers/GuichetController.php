<?php

namespace App\Http\Controllers;

use App\Models\Guichet;
use Illuminate\Http\Request;

class GuichetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas=[
            Guichet::all(),
        ];
        return view("guichet.index",compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("guichet.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            "code"=>'required',
            "statut"=>'required',
        ]);

        $message=[
            "code.required"=>'Le champ code est obligatoire',
            "statut.required"=>'Le champ statut est obligatoire',
        ];

        Guichet::create($data);

        return view('guichet.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=Guichet::findOrFail($id);
        return view("guichet.show",compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data=Guichet::findOrFail($id);
        return view("guichet.edit",compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item=Guichet::findOrFail($id);
        $datas=$request->validate([
            'code'=>'required',
            'statut'=>'required',
        ]);
        $message=[
            'code.required'=>'Le champ code est obligatoire',
            'statut.required'=>'Le champ statut est obligatoire',
        ];

        $item->update($datas);
        return view("guichet.show",compact('datas'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data=Guichet::findOrFail($id);
        $data->delete();
    }
}
