<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Materia;
use App\Models\Profesor; // Import the Profesor model
use App\Models\HorarioCupo; // Import if needed
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        // Obtener todos los horarios con las relaciones
        $horarios = Horario::with(['materia', 'profesor', 'salon', 'horarioCupo'])->get();

        // Obtener todas las materias
        $materias = Materia::all();

        // Obtener todos los profesores
        $profesores = Profesor::all(); // Fetch all profesores

        // Pasar tanto los horarios como las materias y profesores a la vista
        return view('grupos', compact('horarios', 'materias', 'profesores'));
    }
}
