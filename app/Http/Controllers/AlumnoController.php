<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::all(); // Get all students from the database
        return view('alumnos_search_and_edit', compact('alumnos'));
    }

    public function buscar(Request $request)
    {
        $query = Alumno::query();

        if ($request->filled('no_registro')) {
            $query->where('no_registro', $request->input('no_registro'));
        }
        if ($request->filled('nombre_alumno')) {
            $query->where('nombre_alumno', 'like', '%' . $request->input('nombre_alumno') . '%');
        }
        // Add additional search criteria as needed

        $alumnos = $query->get();
        return view('alumnos_search_and_edit', compact('alumnos'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'no_registro' => 'required|integer',
            'clave_unica' => 'required|string|max:255',
            'nombre_alumno' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'correo' => 'required|email',
            'clave_carrera' => 'required|string|max:255',
            'telefono' => 'required|integer',
            'fecha_ingreso' => 'required|date',
        ]);

        Alumno::create($request->all());

        return redirect()->back()->with('success', 'Alumno guardado exitosamente.');
    }
}
