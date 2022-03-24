<?php

namespace App\Http\Controllers;

use App\Models\Bacheos;
use Illuminate\Http\Request;
use JeroenNoten\LaravelAdminLte\Components\Tool\Datatable;

class DatatableController extends Controller
{
    //
    public function index()
    {
        $bacheo = Bacheos::select('id', 'calle_id', 'numeracion', 'largo', 'ancho', 'mts', 'status_id', 'created_at', 'updated_at')->get();
        return datatables()->of($bacheo)->addColumn('Barrio', function (Bacheos $bacheo) {
            return $bacheo->calle->barrios->name;
        })->editColumn('calle_id', function (Bacheos $bacheo) {
            return $bacheo->calle->name;
        })->addColumn('Tiempo', function (Bacheos $bacheo) {
            return $bacheo->created_at->diffForHumans();
        })->editColumn('created_at', function (Bacheos $bacheo) {
            return $bacheo->created_at->toDateTimeString();
        })->editColumn('updated_at', function (Bacheos $bacheo) {
            return $bacheo->updated_at->toDateTimeString();
        })->editColumn('status_id', function (Bacheos $bacheo) {
            return $bacheo->status->name;
        })->toJson();
    }
}
