<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salon;
use Illuminate\Support\Facades\Log;

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
            
    
            Log::info('Actualizando salón con ID:', ['id_salon' => $request->id_salon]);
    
            // Actualizar directamente basado en id_salon
            $affected = Salon::where('id_salon', $request->id_salon)
                ->update($request->only([
                    'capacidad',
                    'tipo',
                    'ubicacion',
                    'nivel',
                    'disponibilidad',
                ]));
    
            if ($affected === 0) {
                session()->flash('error', 'No se encontró un salón con el número proporcionado.');
                return redirect()->back();
            }
    
            session()->flash('success', 'Datos del salón actualizados exitosamente.');
            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Error al actualizar los datos del salón: ' . $e->getMessage());
            session()->flash('error', 'Error al actualizar los datos del salón: ' . $e->getMessage());
            return redirect()->back();
        }
    }

}
