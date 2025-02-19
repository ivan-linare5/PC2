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
            'horas_definitivas' => 'nullable|integer',
            'grado_maximo' => 'required|string|max:25',
            'telefono_personal' => 'required|digits:10',
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
                'horas_definitivas' => $request->horas_definitivas,
                'grado_maximo' => $request->grado_maximo,
                'telefono_personal' => $request->telefono_personal,
                'Activo' => 1 //por default cada que se registra un nuevo profesor esta activo
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

        } catch (\Illuminate\Database\QueryException $e) {
            // Errores relacionados con la base de datos (por ejemplo, conexión o restricciones únicas)
            if ($e->getCode() === '23000') { // Código SQL para violación de restricción única
                session()->flash('error', 'ERROR: El profesor ya está registrado en la base de datos.');
            } else {
                session()->flash('error', 'ERROR al conectarse a la base de datos o realizar la consulta. Inténtelo más tarde.');
            }
            return redirect()->route('profesores.index');
        } catch (\Exception $e) {
            // Otros errores generales
            session()->flash('error', 'Ocurrió un error inesperado: ' . $e->getMessage());
            return redirect()->route('profesores.index');
        }
    }

    public function buscar(Request $request)
    {
        // Comprobar si al menos uno de los campos tiene datos
        if ($request->filled('nombre') || $request->filled('apellido_paterno') || $request->filled('apellido_materno')) {
            // Construir la consulta
            $query = Profesor::query();
    
            // Agregar condiciones a la consulta según los campos llenos
            if ($request->filled('nombre')) {
                $query->where('nombre_profesor', 'like', '%' . $request->nombre . '%');
            }
            if ($request->filled('apellido_paterno')) {
                $query->where('primer_apellido', 'like', '%' . $request->apellido_paterno . '%');
            }
            if ($request->filled('apellido_materno')) {
                $query->where('segundo_apellido', 'like', '%' . $request->apellido_materno . '%');
            }
    
            // Ejecutar la consulta y obtener los resultados
            $profesores = $query->get();
    
            // Verificar si se encontraron profesores
            if ($profesores->isNotEmpty()) {
                // Retornar una vista con todos los resultados encontrados
                return view('profesores_Encontrados', compact('profesores'));
            } else {
                // Si no se encuentran resultados, redirigir con un mensaje
                return redirect()->back()->with('error', 'No se encontraron profesores con los datos proporcionados.');
            }
        }
        else
        {
            return $this->search($request->rpe);
        }
    }

    public function search($rpe)
    {
        // Realizar la búsqueda en la base de datos
        $profesor = Profesor::where('RPE_Profesor', $rpe)->first(); // Obtener solo el primer resultado

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
            // Buscar al profesor por su RPE
            $profesor = Profesor::where('RPE_Profesor', $request->rpe)->firstOrFail();
            //dd($profesor);
            // Actualizar los datos del profesor
            $profesor->update([
                'nombre_profesor' => $request->nombre_profesor,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo_institucional' => $request->correo_institucional,
                'grado_maximo' => $request->grado_maximo,
                'horas_definitivas' => $request->horas_definitivas,
                'telefono_personal' => $request->telefono_personal,
                'Activo' => $request->activo // Asegúrate de que 'Activo' es un campo de la base de datos
            ]);

            // Actualizar los teléfonos de emergencia
            foreach ($request->telefonos as $index => $telefono) {
                // Busca el teléfono de emergencia correspondiente al RPE del profesor
                $telefonoEmergencia = TelefonoEmergencia::where('RPE', $profesor->RPE_Profesor)->skip($index)->first();
                
                if ($telefonoEmergencia) {
                    $telefonoEmergencia->update([
                        'numero' => $telefono['numero'],
                        'descripcion' => $telefono['descripcion'],
                    ]);
                } else {
                    // Si no existe, puedes optar por crear uno nuevo si así lo deseas
                    TelefonoEmergencia::create([
                        'RPE' => $profesor->RPE_Profesor,
                        'numero' => $telefono['numero'],
                        'descripcion' => $telefono['descripcion'],
                    ]);
                }
            }

            session()->flash('success', 'Datos del profesor actualizados exitosamente.');
            return redirect()->back(); 

        } catch (\Illuminate\Database\QueryException $e) {
            // Manejar errores relacionados con la base de datos
            if ($e->getCode() === '23000') { // Violación de restricción única, por ejemplo, un campo duplicado
                session()->flash('error', 'Ya existe un registro con los mismos datos. Verifique la información ingresada.');
            } else {
                session()->flash('error', 'Error al conectarse a la base de datos o realizar la consulta. Inténtelo más tarde.');
            }
            return redirect()->back();
        } catch (\Exception $e) {
            // Otros errores generales
            session()->flash('error', 'Error inesperado al actualizar los datos del profesor: ' . $e->getMessage());
            return redirect()->back();
        }
    }  
}
