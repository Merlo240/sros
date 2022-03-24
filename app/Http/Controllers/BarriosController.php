<?php

namespace App\Http\Controllers;

use App\Models\Barrios;
use Illuminate\Http\Request;

class BarriosController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:admin.barrios.index')->only('index');
        $this->middleware('can:admin.barrios.create')->only('create', 'store');
        $this->middleware('can:admin.barrios.create')->only('create', 'store');
        $this->middleware('can:admin.barrios.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $barrios = Barrios::all();
        return view('admin.barrios.index', compact('barrios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.barrios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Barrios $barrio)
    {
        //
        $request->validate([
            'name' => 'required|unique:barrios',
            'coordenadas'=>'required'
        ]);

        $barrio = Barrios::create($request->all());
        return redirect()->route('admin.barrios.create', compact('barrio'))->with('mensaje', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barrios  $barrios
     * @return \Illuminate\Http\Response
     */
    public function show(Barrios $barrio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barrios  $barrios
     * @return \Illuminate\Http\Response
     */
    public function edit(Barrios $barrio)
    {
        //
        return view('admin.barrios.edit', compact('barrio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barrios  $barrios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barrios $barrio)
    {
        //
        $request->validate([
            'name' => 'required'
        ]);

        $barrio->update($request->all());
        return redirect()->route('admin.barrios.edit', $barrio)->with('mensaje', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barrios  $barrios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barrios $barrio)
    {
        //
        $barrio->delete();
        return redirect()->route('admin.barrios.index')->with('mensaje', 'ok');
    }
}
