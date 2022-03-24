<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoordenadasBacheo;
use App\Http\Resources\Place;
use App\Http\Resources\Place as PlaceResource;
use App\Models\Bacheos;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    //

    public function index(Request $request)
    {
        $places = Bacheos::all();

        $geoJSONdata = $places->map(function ($place) {
            return [
                'type' => 'Feature',
                'properties' =>new PlaceResource($place),
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => new CoordenadasBacheo($place),
                ],
            ];
        });
        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
}
