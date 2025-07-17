<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\CuerpoArbitroController;
use App\Http\Controllers\PartidoController;
use App\Http\Controllers\ReporteController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('equipos', EquipoController::class);
    Route::resource('cuerpo-arbitros', CuerpoArbitroController::class);
    Route::resource('partidos', PartidoController::class);
    Route::resource('reportes', ReporteController::class);
});


Route::get('/partido-real', function () {
    return view('playingMatch.partido-real');
})->name('partido-real');
