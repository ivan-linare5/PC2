<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesor;
use App\Models\TelefonoEmergencia;

class ProfesorController extends Controller
{
    public function index()
    {
        return view('profesores'); 
    }


    public function guardar(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'rpe' => 'required|integer',
            'rpe_temporal' => 'nullable|boolean',            
            'nombre_profesor' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'segundo_apellido' => 'nullable|string|max:50',
            'correo_institucional' => 'required|email|max:50',
            'grado_maximo' => 'required|string|max:25',
            'telefono_personal' => 'required|digits:10',
            'telefonos.*.numero' => 'required|digits:10', // Validar que cada teléfono tenga 10 dígitos
            'telefonos.*.descripcion' => 'required|string|max:150'
        ]);

        try {
            // Guardar los datos del profesor
            $profesor = Profesor::create([
                'RPE_Profesor' => $request->rpe,
                'rpe_temporal' => $request->rpe_temporal ? 1 : 0,
                'nombre_profesor' => $request->nombre_profesor,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo_institucional' => $request->correo_institucional,
                'grado_maximo' => $request->grado_maximo,
                'telefono_personal' => $request->telefono_personal,
                'Activo' => 1 
            ]);

            // Guardar los teléfonos de emergencia relacionados al profesor
            foreach ($request->telefonos as $telefono) {
                TelefonoEmergencia::create([
                    'RPE' => $profesor->RPE_Profesor,
                    'numero' => $telefono['numero'],
                    'descripcion' => $telefono['descripcion']
                ]);
            }

            // Redirigir a la vista de profesores con un mensaje de éxito
            session()->flash('success', 'Profesor registrado exitosamente.');
            return redirect()->route('profesores.index');

        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Error al registrar el profesor: ' . $e->getMessage());
            return redirect()->route('profesores.index');
        }
    }

    public function buscar(Request $request)
    {
        // Validar que el RPE esté presente y sea numérico
        $request->validate([
            'rpe' => 'required|numeric', // Hacer obligatorio y numérico
        ]);

        // Realizar la búsqueda en la base de datos
        $profesor = Profesor::where('RPE_Profesor', $request->rpe)->first(); // Obtener solo el primer resultado

        // Verificar si se encontró el profesor
        if ($profesor) {
             // Obtener todos los teléfonos de emergencia asociados al profesor
             $telefonos = $profesor->telefonosEmergencia()->get(); 
        
             // Si no se encontraron teléfonos, inicializar como un array vacío
             if (!$telefonos) {
                 $telefonos = []; // O también podrías usar collect() para convertirlo en una colección
             }
            // Si se encuentra, retorna la vista con los datos del profesor
            return view('profesor_search_and_edit', compact('profesor', 'telefonos')); 
        } else {
            // Si no se encuentra, redirigir con un mensaje de error
            return redirect()->back()->with('error', 'No se encontró un profesor con el RPE proporcionado.');
        }
    }

    public function update(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'rpe' => 'required|integer',
            'nombre_profesor' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'segundo_apellido' => 'nullable|string|max:50',
            'correo_institucional' => 'required|email|max:50',
            'grado_maximo' => 'required|string|max:25',
            'telefono_personal' => 'required|digits:10',
            'activo' => 'required|boolean', // Validar el campo 'activo'
            'telefonos.*.numero' => 'required|digits:10',
            'telefonos.*.descripcion' => 'required|string|max:150'
        ]);

        try {
            // Buscar al profesor por su RPE
            $profesor = Profesor::where('RPE_Profesor', $request->rpe)->first();

            // Verificar si el profesor existe
            if (!$profesor) {
                return redirect()->back()->with('error', 'Profesor no encontrado.');
            }

            // Actualizar los datos del profesor
            $profesor->update([
                'RPE_Profesor' => $request->rpe,
                'rpe_temporal' => $profesor->rpe_temporal, // Mantener el valor actual
                'nombre_profesor' => $request->nombre_profesor,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo_institucional' => $request->correo_institucional,
                'grado_maximo' => $request->grado_maximo,
                'telefono_personal' => $request->telefono_personal,
                'Activo' => $request->activo // Asegúrate de que 'Activo' es un campo de la base de datos
            ]);

            // Actualizar los teléfonos de emergencia
            $profesor->telefonosEmergencia()->delete();

            foreach ($request->telefonos as $telefono) {
                TelefonoEmergencia::create([
                    'RPE' => $profesor->RPE_Profesor,
                    'numero' => $telefono['numero'],
                    'descripcion' => $telefono['descripcion']
                ]);
            }

            session()->flash('success', 'Datos del profesor actualizados exitosamente.');
            return redirect()->route('profesor.buscar');

        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar los datos del profesor: ' . $e->getMessage());
            return redirect()->route('profesor.buscar');
        }
    }
}
