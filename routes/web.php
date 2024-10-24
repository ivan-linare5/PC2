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
Route::get('/profesor/search/{rpe}', [ProfesorController::class, 'search'])->name('profesor.search');


//MATERIAS
Route::get('/materias', [MateriaController::class, 'index'])->name('materias.index');
Route::post('/materias/guardar', [MateriaController::class, 'guardar'])->name('materia.guardar');
Route::get('/materias/buscar', [MateriaController::class, 'buscar'])->name('materia.buscar');
Route::post('/materias/update', [MateriaController::class, 'update'])->name('materia.update');


//SALONES
Route::get('/salones', [SalonController::class, 'index'])->name('salones.index');
Route::post('/salones/guardar', [SalonController::class, 'guardar'])->name('salon.guardar');
Route::get('/salones/buscar', [SalonController::class, 'buscar'])->name('salon.buscar');
Route::put('/salones/update', [SalonController::class, 'update'])->name('salon.update');


//ALUMNOS

Route::get('/alumnos', [AlumnoController::class, 'index'])->name('alumnos.index');
Route::post('/alumno/guardar', [AlumnoController::class, 'guardar'])->name('alumno.guardar');
Route::get('/alumno/buscar', [AlumnoController::class, 'buscar'])->name('alumno.buscar');
Route::put('/alumno/update', [AlumnoController::class, 'update'])->name('alumno.update');
Route::get('/alumno/search/{clave_Unica}', [AlumnoController::class, 'search'])->name('alumno.search');
//GRUPOS
Route::get('/grupos', [GrupoController::class, 'index'])->name('grupos.index');

//LISTAS
Route::get('/listas', [ListaController::class, 'index'])->name('listas.index');


