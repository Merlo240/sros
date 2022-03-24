<?php

namespace App\Http\Controllers;

use App\Models\Bacheos;
use App\Models\Barrios;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $users = User::count();
        $obras = Bacheos::where('status_id', '=', '3')->count();
        $obras_activas = Bacheos::where('status_id', '=', '2')->count();
        $obras_Interrumpidas = Bacheos::where('status_id', '=', '4')->count();
        $obras_total = Bacheos::all()->count();
        $Barrios = Bacheos::where('status_id', '=', '1')->count();
        $places =Bacheos::all(); 	
        return view('admin.index', compact('users', 'obras', 'obras_activas', 'obras_Interrumpidas', 'obras_total', 'Barrios','places'));
    }
}
