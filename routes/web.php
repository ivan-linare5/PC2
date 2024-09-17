<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Principal');
});


// Ruta para Profesores
Route::get('/profesores', function () {
    return view('partials.profesores'); // Vista parcial para Profesores
});

// Ruta para materias
Route::get('/materias', function () {
    return view('partials.materias'); // Vista parcial para materias
});

// Ruta para salones
Route::get('/salones', function () {
    return view('partials.salones'); // Vista parcial para salones
});

// Ruta para alumnos
Route::get('/alumnos', function () {
    return view('partials.alumnos'); // Vista parcial para alumnos
});

// Ruta para grupos
Route::get('/grupos', function () {
    return view('partials.grupos'); // Vista parcial para grupos
});
