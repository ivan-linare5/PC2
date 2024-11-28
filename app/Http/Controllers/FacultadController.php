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
            'clave_facultad' => 'required|integer|max:99999999999',
            'nombre_facultad' => 'required|string|max:255',
        ]);
    
        try {
            // Guardar los datos de la facultad
            Facultad::create([
                'clave_facultad' => $request->clave_facultad,
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
    

    public function edit($clave_facultad)
    {
        $facultad = Facultad::findOrFail($clave_facultad);
        return view('facultad_edit', compact('facultad'));
    }

    public function update(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'nombre_facultad' => 'required|string|max:255',
        ]);

        try {
            // Buscar la facultad por su ID
            $facultad = Facultad::where('clave_facultad', $request->clave_facultad)->firstOrFail();

            // Actualizar los datos de la facultad
            $facultad->update([
                'nombre_facultad' => $request->nombre_facultad,
            ]);

            session()->flash('success', 'Datos de la facultad actualizados exitosamente.');
            $facultades = Facultad::all();
            return view('facultades', compact('facultades'));

        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar los datos de la facultad: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}