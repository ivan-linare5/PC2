<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Models\TelefonoAlumno;

class AlumnoController extends Controller
{
    public function index()
    {
        return view('alumnos'); 
    }


    public function guardar(Request $request)
    {
       

        try {
            $alumno = Alumno::create([
                'clave_Unica' => $request->clave_Unica,
                'nombre_alumno' => $request->nombre_alumno,
                'primer_apellido' => $request->primer_apellido,
                'segundo_apellido' => $request->segundo_apellido,
                'correo_institucional' => $request->correo_institucional,
                'clave_carrera' => $request->clave_carrera,
                'fecha_ingreso' => $request->fecha_ingreso
            ]);

            // Guardar los teléfonos de emergencia relacionados al alumno
            foreach ($request->telefonos as $telefono) {
                TelefonoAlumno::create([
                    'clave_unica' => $alumno->clave_Unica,
                    'telefono' => $telefono['telefono'],
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
            return $this->search($request->clave_Unica);
        }
    }

    public function search($clave_Unica)
    {
        

        // Realizar la búsqueda en la base de datos
        $alumno = Alumno::where('clave_Unica', $clave_Unica)->first(); // Obtener solo el primer resultado

        // Verificar si se encontró el profesor
        if ($alumno) {
             // Obtener todos los teléfonos de emergencia asociados al profesor
             $telefonos = $alumno->telefonosAlumno()->get(); 
        
             // Si no se encontraron teléfonos, inicializar como un array vacío
             if (!$telefonos) {
                 $telefonos = []; // O también podrías usar collect() para convertirlo en una colección
             }
            // Si se encuentra, retorna la vista con los datos del profesor
            return view('alumnos_search_and_edit', compact('alumno', 'telefonos')); 
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
        'fecha_ingreso' => 'required|date',
    ]);

    try {
        // Buscar al alumno por su clave única
        $alumno = Alumno::where('clave_Unica', $request->clave_Unica)->firstOrFail();
        \Log::info('Alumno encontrado antes de actualizar:', $alumno->toArray());

        // Actualizar los datos del alumno
        $alumno->update([
            'nombre_alumno' => $request->nombre_alumno,
            'primer_apellido' => $request->primer_apellido,
            'segundo_apellido' => $request->segundo_apellido,
            'correo_institucional' => $request->correo_institucional,
            'clave_carrera' => $request->clave_carrera,
            'fecha_ingreso' => $request->fecha_ingreso,
        ]);

        \Log::info('Alumno después de actualizar:', $alumno->toArray());

        session()->flash('success', 'Datos del alumno actualizados exitosamente.');
        return redirect()->route('alumnos.index');

    } catch (\Exception $e) {
        \Log::error('Error al actualizar alumno:', ['error' => $e->getMessage()]);
        session()->flash('error', 'Error al actualizar los datos del alumno. Detalles: ' . $e->getMessage());
        return redirect()->back();
    }
}

// **Nuevo: Método para registrar nuevos alumnos**
public function registrarNuevosAlumnos(Request $request)
{
    $endpoint = 'https://servicios.ing.uaslp.mx/ws_dfm/RecibirNuevosAlumnos.php';
    $payload = json_encode([
        'key' => '1',
        'ciclo' => $request->input('ciclo'),
        'semestre' => $request->input('semestre'),
    ]);

    $response = $this->sendPostRequest($endpoint, $payload);

    $data = json_decode($response, true);

    if (isset($data['correcto']) && $data['correcto'] == true) {
        session()->flash('success', 'Nuevos alumnos registrados correctamente.');
    } else {
        session()->flash('error', 'Error al registrar nuevos alumnos.');
    }

    return redirect()->route('alumnos.index');
}

// **Nuevo: Método para consultar un alumno**
public function consultarAlumno(Request $request)
{
    $endpoint = 'https://servicios.ing.uaslp.mx/ws_dfm/RecibirAlumno.php';
    $payload = json_encode([
        'key' => '1',
        'clave_unica' => $request->input('clave_unica'),
    ]);

    $response = $this->sendPostRequest($endpoint, $payload);

    $data = json_decode($response, true);

    if (isset($data['correcto']) && $data['correcto'] == true) {
        $alumno = $data['datos'] ?? null;
        if ($alumno) {
            return view('alumno_consultado', compact('alumno'));
        } else {
            session()->flash('error', 'No se encontraron datos para el alumno solicitado.');
        }
    } else {
        session()->flash('error', 'Error al consultar datos del alumno.');
    }

    return redirect()->route('alumnos.index');
}

private function sendPostRequest($endpoint, $payload)
{
    $ch = curl_init($endpoint);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload)
    ]);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $response = 'Error: ' . curl_error($ch);
    }

    curl_close($ch);

    return $response;
}


        

}
