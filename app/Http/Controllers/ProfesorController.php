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
            'nombre_profesor' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'segundo_apellido' => 'nullable|string|max:50',
            'correo_institucional' => 'required|email|max:50',
            'grado_maximo' => 'required|string|max:25',
            'telefonos.*.numero' => 'required|digits:10', // Validar que cada teléfono tenga 10 dígitos
            'telefonos.*.descripcion' => 'required|string|max:150'
        ]);

        try {
            // Guardar los datos del profesor
            $profesor = Profesor::create([
                'RPE_Profesor' => $request->rpe,
                'nombre_profesor' => $request->nombre_profesor,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo_institucional' => $request->correo_institucional,
                'grado_maximo' => $request->grado_maximo,
                'Activo' => 1 // Puedes cambiar esto dependiendo de tu lógica
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

}
