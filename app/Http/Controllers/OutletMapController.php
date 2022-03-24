<?php

namespace App\Http\Controllers;

use App\Models\Bacheos;
use Illuminate\Http\Request;

class OutletMapController extends Controller
{
    //
    public function index(Request $request)
    {
        $bacheos = Bacheos::all();
        return view('admin.bacheos.map',compact('bacheos'));
    }
}
