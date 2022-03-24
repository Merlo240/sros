<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Cloaca;
use App\Http\Resources\Cloaca as CloacaResource;
use App\Http\Resources\Coordenadas;
use App\Models\Cloacas;
use Illuminate\Http\Request;

class PlaceCloacaController extends Controller
{
    //

    public function index(Request $request)
    {
        $places = Cloacas::all();  

        $geoJSONdata = $places->map(function ($place) {
            return [
                'type' => 'Feature',
                'properties' =>new CloacaResource($place),
                'geometry' => [
                    'type' =>$place->typo,
                    'coordinates' => new Coordenadas($place)
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
