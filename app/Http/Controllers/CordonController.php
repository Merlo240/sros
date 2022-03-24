<?php

namespace App\Http\Controllers;
use App\Models\Cordones;
use App\Models\status;
use Illuminate\Http\Request;

class CordonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cordon = Cordones::all();
        return view('admin.cordon.index', compact('cordon'));
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
        return view('admin.cordon.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Cordones $cordon)
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

        $Cordones = Cordones::create($request->all());
        return redirect()->route('admin.cordon.create', compact('Cordones'))->with('mensaje', 'ok');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cordones $cordon)
    {
        //
        return view('admin.cordon.show', compact('cordon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cordones $cordon)
    {
        //
        $status = status::pluck('name', 'id');
        return view('admin.cordon.edit', compact('cordon', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Cordones $cordon)
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

        $cordon->update($request->all());
        return redirect()->route('admin.cordon.edit', $cordon)->with('mensaje', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cordones $cordon)
    {
        //
        $cordon->delete();
        return redirect()->route('admin.cordon.index')->with('mensaje', 'ok');
    }
}
