<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoordenadasCordon;
use App\Http\Resources\Cordon;
use App\Models\Cordones;
use Illuminate\Http\Request;

class PlaceCordonController extends Controller
{
    //
    public function index(Request $request)
    {
        $places = Cordones::all();  

        $geoJSONdata = $places->map(function ($place) {
            return [
                'type' => 'Feature',
                'properties' =>new Cordon ($place),
                'geometry' => [
                    'type' =>$place->typo,
                    'coordinates' => new CoordenadasCordon ($place)
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
