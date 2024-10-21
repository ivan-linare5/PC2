<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\ListaController;

Route::get('/', function () {
    return view('layouts.Principal');
});


//PROFESORES
Route::get('/profesores', [ProfesorController::class, 'index'])->name('profesores.index');
Route::post('/profesor/guardar', [ProfesorController::class, 'guardar'])->name('profesor.guardar');
Route::get('/profesor/buscar', [ProfesorController::class, 'buscar'])->name('profesor.buscar');
Route::put('/profesor/update', [ProfesorController::class, 'update'])->name('profesor.update');

//MATERIAS
Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');

//SALONES
Route::get('/salones', [SalonController::class, 'index'])->name('salones.index');

//ALUMNOS
Route::get('/alumnos', [AlumnoController::class, 'index'])->name('alumnos.index');
Route::get('/alumnos/buscar', [AlumnoController::class, 'buscar'])->name('alumnos.buscar');
Route::post('/alumnos/guardar', [AlumnoController::class, 'guardar'])->name('alumnos.guardar');


//GRUPOS
Route::get('/grupos', [GrupoController::class, 'index'])->name('grupos.index');

//LISTAS
Route::get('/listas', [ListaController::class, 'index'])->name('listas.index');


