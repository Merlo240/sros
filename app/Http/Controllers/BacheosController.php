<?php

namespace App\Http\Controllers;

use App\Models\Bacheos;
use App\Models\Calles;
use App\Models\status;
use Illuminate\Http\Request;

class BacheosController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.bacheos.index')->only('index');
        $this->middleware('can:admin.bacheos.create')->only('create', 'store');
        $this->middleware('can:admin.bacheos.edit')->only('edit', 'update','show');
        $this->middleware('can:admin.bacheos.destroy')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bacheos = Bacheos::all();
        return view('admin.bacheos.index', compact('bacheos'));
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
        return view('admin.bacheos.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Bacheos $bacheos)
    {
        //
        $request->validate([
            'barrio' => 'required',
            'calle' => 'required',
            'numeracion' => "required",
            'largo' => 'required',
            'ancho' => 'required',
            'mts' => 'required',
            'status_id' => 'required',
        ]);

        $bacheos = Bacheos::create($request->all());
        return redirect()->route('admin.bacheos.create', compact('bacheos'))->with('mensaje', 'ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bacheos  $bacheos
     * @return \Illuminate\Http\Response
     */
    public function show(Bacheos $bacheo)
    {
        //

        return view('admin.bacheos.show', compact('bacheo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bacheos  $bacheos
     * @return \Illuminate\Http\Response
     */
    public function edit(Bacheos $bacheo)
    {
        //
        $status = status::pluck('name', 'id');
        return view('admin.bacheos.edit', compact('bacheo', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bacheos  $bacheos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bacheos $bacheo)
    {
        //
        $request->validate([
            'barrio' => 'required',
            'calle' => 'required',
            'numeracion' => "required",
            'largo' => 'required',
            'ancho' => 'required',
            'mts' => 'required',
            'status_id' => 'required',
        ]);

        $bacheo->update($request->all());
        return redirect()->route('admin.bacheos.edit', $bacheo)->with('mensaje', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bacheos  $bacheos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bacheos $bacheo)
    {
        //
        $bacheo->delete();
        return redirect()->route('admin.bacheos.index')->with('mensaje', 'ok');
    }
}
