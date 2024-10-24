<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salon;

class SalonController extends Controller
{
    public function index()
    {
        return view('salones'); 
    }

    public function guardar(Request $request)
    {
        try {
            // Guardar los datos del salón
            Salon::create([
                'id_salon' => $request->id_salon,
                'capacidad' => $request->capacidad,
                'tipo' => $request->tipo,
                'ubicacion' => $request->ubicacion,
                'nivel' => $request->nivel,
                'disponibilidad' => $request->disponibilidad,
            ]);

            // Redirigir a la vista de salones con un mensaje de éxito
            session()->flash('success', 'Salón registrado exitosamente.');
            return redirect()->route('salones.index');

        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Error al registrar el salón: ' . $e->getMessage());
            return redirect()->route('salones.index');
        }
    }

    public function buscar(Request $request)
    {
        
        // Verificar si se proporcionó el número de salón
        if ($request->filled('id_salon')) {
            // Realizar la búsqueda por número de salón
            $salon = Salon::where('id_salon', $request->id_salon)->first();

            // Verificar si se encontró el salón
            if ($salon) {
                //dd($request->All());
                // Redirigir a la vista de edición con los datos del salón
                return view('salon_search_and_edit', compact('salon'));
            } else {
                // Si no se encuentra, redirigir con un mensaje de error
                return redirect()->back()->with('error', 'No se encontró un salón con el número proporcionado.');
            }
        } else {
            // Si no se proporcionó el número de salón, redirigir con un mensaje de error
            return redirect()->back()->with('error', 'Por favor ingrese el número de salón para buscar.');
        }
    }

    public function update(Request $request)
    {
        try {
            // Buscar el salón por su número
            $salon = Salon::where('id_salon', $request->id_salon)->firstOrFail();

            // Actualizar los datos del salón
            $salon->update([
                'capacidad' => $request->capacidad,
                'tipo' => $request->tipo,
                'ubicacion' => $request->ubicacion,
                'nivel' => $request->nivel,
                'disponibilidad' => $request->disponibilidad
            ]);

            // Redirigir con un mensaje de éxito
            session()->flash('success', 'Datos del salón actualizados exitosamente.');
            return redirect()->back(); 

        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar los datos del salón: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
