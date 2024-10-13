<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function Guardar(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'rpe' => 'required|integer',
            'nombre_profesor' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'segundo_apellido' => 'nullable|string|max:50',
            'correo_institucional' => 'required|email',
            'grado_maximo' => 'required|string|max:50',
        ]);

        // Guardar el profesor en la base de datos
        Profesor::create([
            'rpe' => $validated['rpe'],
            'nombre' => $validated['nombre_profesor'],
            'apellido_paterno' => $validated['primer_apellido'],
            'apellido_materno' => $validated['segundo_apellido'],
            'correo_institucional' => $validated['correo_institucional'],
            'grado_maximo' => $validated['grado_maximo'],
            'telefono_emergencia' => $validated['telefono_emergencia'],
            'descripcion' => $validated['descripcion'],
        ]);

        return redirect()->back()->with('success', 'Profesor registrado exitosamente.');
    }
}
