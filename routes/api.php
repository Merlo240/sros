<?php

use App\Http\Controllers\Api\PlaceBarrioController;
use App\Http\Controllers\Api\PlaceCalleController;
use App\Http\Controllers\Api\PlaceCloacaController;
use App\Http\Controllers\Api\PlaceController;
use App\Http\Controllers\Api\PlaceCordonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['as' => 'api.', 'namespace' => 'Api'], function () {
    Route::get('places', [PlaceController::class, 'index'])->name('places.index');
    Route::get('places_cloaca', [PlaceCloacaController::class, 'index'])->name('places_cloaca.index');
    Route::get('places_cordon', [PlaceCordonController::class, 'index'])->name('places_cordon.index');
    Route::get('places_barrio', [PlaceBarrioController::class, 'index'])->name('places_barrio.index');
    Route::get('places_calle', [PlaceCalleController::class, 'index'])->name('places_calle.index');
    Route::get('places_calle/{coordinates}', [PlaceCalleController::class, 'coordenadas']);
});

