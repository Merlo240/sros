<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Barrio;
use App\Http\Resources\CoordenadasBarrio;
use App\Models\Barrios;
use Illuminate\Http\Request;

class PlaceBarrioController extends Controller
{
    //

    public function index(Request $request)
    {
        $places = Barrios::all();  

        $geoJSONdata = $places->map(function ($place) {
            return [
                'type' => 'Feature',
                'properties' =>new Barrio($place),
                'geometry' => [
                    'type' =>'Polygon',
                    'coordinates' => new CoordenadasBarrio($place)
                    ,
                ],
            ];
        });
        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
}
