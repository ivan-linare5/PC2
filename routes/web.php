<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Principal');
});


// Ruta para Profesores
Route::get('/profesores', function () {
    return view('partials.profesores'); // Vista parcial para Profesores
});