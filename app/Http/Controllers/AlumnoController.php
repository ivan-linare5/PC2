<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // Método para mostrar la lista de alumnos
    public function index()
    {
        $alumnos = Alumno::all(); // Obtiene todos los alumnos de la base de datos
        return view('alumnos', compact('alumnos'));
    }

    // Método para buscar alumnos
    public function buscar(Request $request)
    {
        $query = Alumno::query();

        // Filtrar por No Registro
        if ($request->filled('no_registro')) {
            $query->where('no_registro', $request->input('no_registro'));
        }

        // Filtrar por Clave Única
        if ($request->filled('clave_unica')) {
            $query->where('clave_unica', 'LIKE', '%' . $request->input('clave_unica') . '%');
        }

        // Filtrar por Nombre
        if ($request->filled('nombre')) {
            $query->where('nombre_alumno', 'LIKE', '%' . $request->input('nombre') . '%');
        }

        // Filtrar por Apellido Paterno
        if ($request->filled('apellido_paterno')) {
            $query->where('apellido_paterno', 'LIKE', '%' . $request->input('apellido_paterno') . '%');
        }

        // Filtrar por Apellido Materno
        if ($request->filled('apellido_materno')) {
            $query->where('apellido_materno', 'LIKE', '%' . $request->input('apellido_materno') . '%');
        }

        $alumnos = $query->get(); // Ejecuta la consulta y obtiene los resultados

        return view('alumnos', compact('alumnos'));
    }

    // Método para guardar un nuevo alumno
    public function guardar(Request $request)
    {
        $request->validate([
            'no_registro' => 'required|integer|unique:alumnos,no_registro',
            'clave_unica' => 'required|string|max:255',
            'nombre_alumno' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:15',
            'clave_carrera' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',
        ]);

        Alumno::create($request->all());

        return redirect()->back()->with('success', 'Alumno agregado exitosamente.');
    }

    // Método para editar un alumno existente
    public function editar($id)
    {
        $alumno = Alumno::findOrFail($id); // Busca el alumno por ID
        return view('alumnos_search_and_edit', compact('alumno'));
    }

    // Método para actualizar el alumno
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'nombre_alumno' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'correo' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:15',
            'clave_carrera' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',
        ]);

        $alumno = Alumno::findOrFail($id);
        $alumno->update($request->all());

        return redirect()->back()->with('success', 'Alumno actualizado exitosamente.');
    }
}
