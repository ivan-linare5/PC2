<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListaController extends Controller
{
    public function index()
    {
        return view('listas'); 
    }
}
