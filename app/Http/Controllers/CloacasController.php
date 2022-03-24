<?php

namespace App\Http\Controllers;

use App\Models\Cloacas;
use App\Models\status;
use Illuminate\Http\Request;

class CloacasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cloacas = Cloacas::all();
        return view('admin.cloacas.index', compact('cloacas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $status = status::pluck('name', 'id');
        return view('admin.cloacas.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Cloacas $cloaca)
    {
        //
        $request->validate([
            'nombre' => 'required',
            'coordenadas' => 'required',
            'metros' => 'required',
            'ancho' => "required",
            'typo' => 'required',
            'status_id' => 'required',
        ]);

        $cloacas = Cloacas::create($request->all());
        return redirect()->route('admin.cloaca.create', compact('cloacas'))->with('mensaje', 'ok');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cloacas $cloaca)
    {
        //
        return view('admin.cloacas.show', compact('cloaca'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cloacas $cloaca)
    {
        //
        $status = status::pluck('name', 'id');
        return view('admin.cloacas.edit', compact('cloaca', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cloacas $cloaca)
    {
        //
        $request->validate([
            'nombre' => 'required',
            'coordenadas' => 'required',
            'metros' => 'required',
            'ancho' => "required",
            'typo' => 'required',
            'status_id' => 'required',
        ]);

        $cloaca->update($request->all());
        return redirect()->route('admin.cloaca.edit', $cloaca)->with('mensaje', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cloacas $cloaca)
    {
        //
        $cloaca->delete();
        return redirect()->route('admin.cloaca.index')->with('mensaje', 'ok');
    }
}
