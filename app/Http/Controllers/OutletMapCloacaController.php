<?php

namespace App\Http\Controllers;

use App\Models\Cloacas;
use Illuminate\Http\Request;

class OutletMapCloacaController extends Controller
{
    //

    public function index(Request $request)
    {
        $cloacas = Cloacas::all();
        return view('admin.cloacas.map',compact('cloacas'));
    }
}
