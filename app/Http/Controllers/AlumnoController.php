<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\TelefonosAlumnos;

class AlumnoController extends Controller
{
    public function index()
    {
        return view('alumnos'); 
    }


    public function guardar(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'clave_unica' => 'required|integer',           
            'nombre_alumno' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'segundo_apellido' => 'nullable|string|max:50',
            'correo_institucional' => 'required|email|max:50',
            'clave_carrera' => 'required|string|max:25',
            'fecha_ingreso' => 'required|string',
            'telefonos.*.numero' => 'required|digits:10', // Validar que cada teléfono tenga 10 dígitos
            'telefonos.*.descripcion' => 'required|string|max:150'
        ]);

        try {
            // Guardar los datos del profesor
            $alumno = Profesor::create([
                'clave_Unica' => $request->clave_unica,
                'nombre_alumno' => $request->nombre_alumno,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo_institucional' => $request->correo_institucional,
                'clave_carrera' => $request->clave_carrera,
                'fecha_ingreso' => $request->fecha_ingreso
            ]);

            // Guardar los teléfonos de emergencia relacionados al alumno
            foreach ($request->telefonos as $telefono) {
                TelefonosAlumnos::create([
                    'clave_Unica' => $alumno->clave_Unica,
                    'numero' => $telefono['telefono'],
                    'descripcion' => $telefono['descripcion']
                ]);
            }

            // Redirigir a la vista de alumnos con un mensaje de éxito
            session()->flash('success', 'Alumno registrado exitosamente.');
            return redirect()->route('alumnos.index');

        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Error al registrar alumno: ' . $e->getMessage());
            return redirect()->route('alumnos.index');
        }
    }

    public function buscar(Request $request)
    {
        // Comprobar si al menos uno de los campos tiene datos
        if ($request->filled('nombre') || $request->filled('apellido_paterno') || $request->filled('apellido_materno')) {
            // Construir la consulta
            $query = Alumno::query();
    
            // Agregar condiciones a la consulta según los campos llenos
            if ($request->filled('nombre')) {
                $query->where('nombre_alumno', 'like', '%' . $request->nombre . '%');
            }
            if ($request->filled('apellido_paterno')) {
                $query->where('primer_apellido', 'like', '%' . $request->apellido_paterno . '%');
            }
            if ($request->filled('apellido_materno')) {
                $query->where('segundo_apellido', 'like', '%' . $request->apellido_materno . '%');
            }
    
            // Ejecutar la consulta y obtener los resultados
            $alumnos = $query->get();
    
            // Verificar si se encontraron profesores
            if ($alumnos->isNotEmpty()) {
                // Retornar una vista con todos los resultados encontrados
                return view('alumnos_Encontrados', compact('alumnos'));
            } else {
                // Si no se encuentran resultados, redirigir con un mensaje
                return redirect()->back()->with('error', 'No se encontraron alumnos con los datos proporcionados.');
            }
        }
        else
        {
            return $this->search($request->rpe);
        }
    }

    public function search($clave_unica)
    {
        

        // Realizar la búsqueda en la base de datos
        $alumno = Alumno::where('clave_Unica', $clave_unica)->first(); // Obtener solo el primer resultado

        // Verificar si se encontró el profesor
        if ($alumno) {
             // Obtener todos los teléfonos de emergencia asociados al profesor
             $telefonos = $alumno->telefonosAlumno()->get(); 
        
             // Si no se encontraron teléfonos, inicializar como un array vacío
             if (!$telefonos) {
                 $telefonos = []; // O también podrías usar collect() para convertirlo en una colección
             }
            // Si se encuentra, retorna la vista con los datos del profesor
            return view('alumno_search_and_edit', compact('alumno', 'telefonos')); 
        } else {
            // Si no se encuentra, redirigir con un mensaje de error
            return redirect()->back()->with('error', 'No se encontró un alumno con la Clave Unica proporcionada.');
        }
    }

    public function update(Request $request)
    {
        
        // Validar los datos recibidos
        $request->validate([          
            'nombre_alumno' => 'required|string|max:50',
            'primer_apellido' => 'required|string|max:50',
            'segundo_apellido' => 'nullable|string|max:50',
            'correo_institucional' => 'required|email|max:50',
            'clave_carrera' => 'required|string|max:25',
            'fecha_ingreso' => 'required|digits:10',
            'telefonos.*.numero' => 'required|digits:10', // Validar que cada teléfono tenga 10 dígitos
            'telefonos.*.descripcion' => 'required|string|max:150'
        ]);
        
        try {
            // Buscar al alumno por su clave
            $alumno = Profesor::where('clave_Unica', $request->clave_unica)->firstOrFail();
            
            $profesor->update([
                'nombre_alumno' => $request->nombre_alumno,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo_institucional' => $request->correo_institucional,
                'clave_carrera' => $request->clave_carrera,
                'fecha_ingreso' => $request->fecha_ingreso,
            ]);

            // Actualizar los teléfonos 
            foreach ($request->telefonos as $index => $telefono) {
                // Busca el teléfono de emergencia correspondiente al RPE del profesor
                $telefonoAlumno = TelefonoAlumno::where('clave_unica', $alumno->Clave_Unica)->skip($index)->first();
                
                if ($telefonoAlumno) {
                    $telefonoAlumno->update([
                        'telefono' => $telefono['telefono'],
                        'descripcion' => $telefono['descripcion'],
                    ]);
                } else {
                    // Si no existe, puedes optar por crear uno nuevo si así lo deseas
                    TelefonoAlumno::create([
                        'clave_unica' => $alumno->clave_Alumno,
                        'telefono' => $telefono['telefono'],
                        'descripcion' => $telefono['descripcion'],
                    ]);
                }
            }

            session()->flash('success', 'Datos del alumno actualizados exitosamente.');
            return redirect()->back(); 

        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar los datos del alumno: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    

}
