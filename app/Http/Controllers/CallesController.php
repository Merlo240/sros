<?php

namespace App\Http\Controllers;

use App\Models\Barrios;
use App\Models\Calles;
use Illuminate\Http\Request;

class CallesController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.calles.index')->only('index');
        $this->middleware('can:admin.calles.create')->only('create', 'store');
        $this->middleware('can:admin.calles.create')->only('create', 'store');
        $this->middleware('can:admin.calles.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $calles = Calles::all();
        return view('admin.calles.index', compact('calles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $barrios = Barrios::pluck('name', 'id');
        return view('admin.calles.create', compact('barrios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:calles',
            'barrio_id' => 'required'
        ]);

        $calles = Calles::create($request->all());
        return redirect()->route('admin.calles.create', compact('calles'))->with('mensaje', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Calles  $calles
     * @return \Illuminate\Http\Response
     */
    public function show(Calles $calle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Calles  $calles
     * @return \Illuminate\Http\Response
     */
    public function edit(Calles $calle)
    {
        //
        $barrios = Barrios::pluck('name', 'id');
        return view('admin.calles.edit', compact('calle', 'barrios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Calles  $calles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Calles $calle)
    {
        //
        $request->validate([
            'name' => 'required',
            'barrio_id' => 'required'
        ]);

        $calle->update($request->all());
        return redirect()->route('admin.calles.edit', $calle)->with('mensaje', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Calles  $calles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Calles $calle)
    {
        //
        $calle->delete();
        return redirect()->route('admin.calles.index')->with('mensaje', 'ok');
    }
}
