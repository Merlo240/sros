<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Calle;
use App\Http\Resources\CoordenadasCalle;
use App\Models\Calles;
use Illuminate\Http\Request;

class PlaceCalleController extends Controller
{
    //
    public function index(Request $request)
    {
        $places = Calles::all();  

        $geoJSONdata = $places->map(function ($place) {
            return [
                'type' => 'Feature',
                'properties' =>new Calle($place),
                'geometry' => [
                    'type' =>'LineString',
                    'coordinates' => new CoordenadasCalle($place)
                    ,
                ],
            ];
        });
        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }

    public function coordenadas ($coordinates){
        return Calles::where("coordenadas","like","%".$coordinates."%")->get();
    }
}
