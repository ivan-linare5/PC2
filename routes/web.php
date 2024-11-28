<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\ListaController;
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\FacultadController;
use App\Http\Controllers\InscripcionesController;


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
Route::put('/materias/update', [MateriaController::class, 'update'])->name('materia.update');


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
Route::post('/alumno/registrar-nuevos', [AlumnoController::class, 'registrarNuevosAlumnos'])->name('alumno.registrarNuevos');
Route::post('/alumno/consultar', [AlumnoController::class, 'consultarAlumno'])->name('alumno.consultar');


//GRUPOS
Route::get('/grupos', [GrupoController::class, 'index'])->name('grupos.index');
Route::post('/grupos/update', [GrupoController::class, 'update'])->name('grupos.update');
Route::post('/grupos/store', [GrupoController::class, 'store'])->name('grupos.store');


//LISTAS
Route::get('/listas', [ListaController::class, 'index'])->name('listas.index');
Route::get('/listas/asistencia/{clave_horario}', [ListaController::class, 'obtenerListaAsistencia'])->name('listas.asistencia');
Route::get('/listas/asistencia/pdf/{clave_horario}', [ListaController::class, 'exportarPDF'])->name('listas.exportarPDF');
Route::get('/buscar-horario', [ListaController::class, 'buscarHorario'])->name('buscar.horario');
Route::get('/exportar-excel/{clave_horario}', [ListaController::class, 'exportarExcel'])->name('exportarExcel');


//ESTADISTICA
Route::get('/estadisticas', [EstadisticaController::class, 'index'])->name('estadisticas.index');

//FACULTADES
Route::get('/facultades', [FacultadController::class, 'index'])->name('facultades.index');
Route::post('/facultades/guardar', [FacultadController::class, 'guardar'])->name('facultades.guardar');
Route::get('/facultades/buscar', [FacultadController::class, 'buscar'])->name('facultades.buscar');
Route::get('/facultades/{id_clave}', [FacultadController::class, 'search'])->name('facultades.search');
Route::post('/facultades/actualizar', [FacultadController::class, 'update'])->name('facultades.update');
Route::get('/facultades/{id_clave}/edit', [FacultadController::class, 'edit'])->name('facultades.edit');

//INSCRIPCIONES
Route::get('/inscripcion', [InscripcionesController::class, 'index'])->name('inscripcion.index');
Route::post('/inscripcion/semestre', [InscripcionesController::class, 'inscribirSemestre'])->name('inscripcion.semestre');
Route::post('/inscripcion/alumno', [InscripcionesController::class, 'inscribirAlumno'])->name('inscripcion.alumno');