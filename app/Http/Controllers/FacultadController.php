<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facultad;

class FacultadController extends Controller
{
    public function index()
    {
        $facultades = Facultad::all();
        return view('facultades', compact('facultades'));
    }

    public function guardar(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre_facultad' => 'required|string|max:255',
        ]);

        try {
            // Guardar los datos de la facultad
            Facultad::create([
                'nombre_facultad' => $request->nombre_facultad,
            ]);

            // Redirigir a la vista de facultades con un mensaje de éxito
            session()->flash('success', 'Facultad registrada exitosamente.');
            return redirect()->route('facultades.index');

        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Error al registrar la facultad: ' . $e->getMessage());
            return redirect()->route('facultades.index');
        }
    }

    public function buscar(Request $request)
    {
        // Comprobar si el campo nombre tiene datos
        if ($request->filled('nombre_facultad')) {
            // Construir la consulta
            $query = Facultad::query();
    
            // Agregar condiciones a la consulta según los campos llenos
            if ($request->filled('nombre_facultad')) {
                $query->where('nombre_facultad', 'like', '%' . $request->nombre_facultad . '%');
            }
    
            // Ejecutar la consulta y obtener los resultados
            $facultades = $query->get();
    
            // Verificar si se encontraron facultades
            if ($facultades->isNotEmpty()) {
                // Retornar una vista con todos los resultados encontrados
                return view('facultades_Encontradas', compact('facultades'));
            } else {
                // Si no se encuentran resultados, redirigir con un mensaje
                return redirect()->back()->with('error', 'No se encontraron facultades con los datos proporcionados.');
            }
        } else {
            return redirect()->back()->with('error', 'Debe proporcionar al menos un dato para buscar.');
        }
    }

    public function search($id_clave)
    {
        // Realizar la búsqueda en la base de datos
        $facultad = Facultad::where('id_clave', $id_clave)->first(); // Obtener solo el primer resultado

        // Verificar si se encontró la facultad
        if ($facultad) {
            // Si se encuentra, retorna la vista con los datos de la facultad
            return view('facultad_search_and_edit', compact('facultad')); 
        } else {
            // Si no se encuentra, redirigir con un mensaje de error
            return redirect()->back()->with('error', 'No se encontró una facultad con el ID proporcionado.');
        }
    }

    public function edit($clave_facultad) 
    { $facultad = Facultad::findOrFail($clave_facultad); 
        return view('facultad_edit', compact('facultad')); }

    public function update(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre_facultad' => 'required|string|max:255',
        ]);
        
        try {
            // Buscar la facultad por su ID
            $facultad = Facultad::where('id_clave', $request->id_clave)->firstOrFail();

            // Actualizar los datos de la facultad
            $facultad->update([
                'nombre_facultad' => $request->nombre_facultad,
            ]);

            session()->flash('success', 'Datos de la facultad actualizados exitosamente.');
            return redirect()->back(); 

        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar los datos de la facultad: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
