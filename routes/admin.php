<?php

use App\Http\Controllers\BacheosController;
use App\Http\Controllers\BarriosController;
use App\Http\Controllers\CallesController;
use App\Http\Controllers\CloacasController;
use App\Http\Controllers\CordonController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OutletMapCloacaController;
use App\Http\Controllers\OutletMapController;
use App\Http\Controllers\OutletMapCordonController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('', [HomeController::class,'index'])->name('admin.home');

Route::resource('users', UserController::class)->names('admin.users');

Route::resource('barrios', BarriosController::class)->names('admin.barrios');

Route::resource('calles', CallesController::class)->names('admin.calles');

Route::resource('bacheos', BacheosController::class)->names('admin.bacheos');

Route::resource('roles', RoleController::class)->names('admin.roles');

Route::resource('status', StatusController::class)->names('admin.status');

Route::get('datatables/users', [DatatableController::class, 'index'])->name('datatables.user');

Route::resource('cloacas', CloacasController::class)->names('admin.cloaca');

Route::resource('cordon', CordonController::class)->names('admin.cordon');

Route::get('/our_outlets', [OutletMapController::class, 'index'])->name('outlet_map.index');

Route::get('/our_outlets_cloaca', [OutletMapCloacaController::class, 'index'])->name('outlet_map_cloaca.index');

Route::get('/our_outlets_cordon', [OutletMapCordonController::class, 'index'])->name('outlet_map_cordon.index');