<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Inscripcion;
use Carbon\Carbon;
use App\Models\Horario;

class InscripcionesController extends Controller
{
    public function index()
    {
        // Obtener todos los registros de la tabla configuracion_semestre
        $configuracion_semestre = DB::table('configuracion_semestre')->get();

        // Retornar la vista con los datos
        return view('inscripciones', ['configuracion_semestre' => $configuracion_semestre]);
    }

    public function inscribirSemestre(Request $request)
    {
        // Endpoint y carga de datos
        $endpoint = 'https://servicios.ing.uaslp.mx/ws_dfm/RecibirInscripcionSemestre.php';
        $payload = $request->input('payload');

        // Enviar la solicitud POST
        $response = $this->sendPostRequest($endpoint, $payload);
        
        // Decodificar la respuesta JSON
        $data = json_decode($response, true);

        // Verificar si la respuesta contiene los datos correctos
        if (isset($data['correcto']) && $data['correcto'] == true) {
            // Verificar si existen los datos de inscripción
            if (isset($data['datos']) && is_array($data['datos'])) {
                // Recorrer los datos de inscripción y guardarlos
                foreach ($data['datos'] as $inscripcion) {
                    // Concatenar la fecha y hora de alta
                    $fechaHora = $inscripcion['fecha_alta'] . ' ' . $inscripcion['hora_alta'];

                    // Eliminar ceros a la izquierda en clave_materia y grupo
                    $claveMateria = ltrim($inscripcion['clave_materia'], '0');
                    $grupo = ltrim($inscripcion['grupo'], '0');

                    // Consultar el horario para obtener el id basado en clave_materia y grupo
                    $horario = Horario::where('clave_materia', $claveMateria)
                                        ->where('numero_grupo', $grupo)
                                        ->first();


                    if ($horario) {
                        // Crear la inscripción en la base de datos
                        Inscripcion::create([
                            'clave_unica' => $inscripcion['clave_unica'],
                            'fecha_hora' => $fechaHora, // Fecha y hora que llega en el JSON
                            'estado' => 'Activo', // Estado por defecto
                            'clave_horario' => $horario->clave_horario, // Usar el id del horario encontrado
                            'fecha_alta' => Carbon::now(), // Fecha y hora actual del sistema
                            'fecha_baja' => null, // Asignar null si no hay fecha de baja
                            'RPE_bajaM' => null, // RPE de baja, si está disponible
                            'RPE_altaM' => "1234", // RPE de quien da de alta en el sistema
                        ]);
                    } else {
                        // Si no se encuentra el horario, manejar el error adecuadamente
                        return redirect()->back()->with('error', 'Horario no encontrado para la clave_materia ' . $claveMateria . ' y grupo ' . $grupo . '.');
                    }
                }

                return redirect()->back()->with('success', 'Datos importados correctamente.');
            } else {
                // Si no se reciben los datos de inscripción en 'datos'
                return redirect()->back()->with('error', 'No se encontraron datos de inscripción válidos.');
            }
        } else {
            // Si la clave 'correcto' no es verdadera en la respuesta principal
            return redirect()->back()->with('error', 'Error en la respuesta del servidor.');
        }
    }


    public function inscribirAlumno(Request $request)
    {
        $endpoint = 'https://servicios.ing.uaslp.mx/ws_dfm/RecibirInscripcionAlumno.php';
        $payload = $request->input('payload');

        $response = $this->sendPostRequest($endpoint, $payload);

        // Decodificar la respuesta JSON
        $data = json_decode($response, true);
        
        // Verificar si la respuesta contiene los datos correctos
        if (isset($data['correcto']) && $data['correcto'] == true) {
            // Verificar si existen los datos de inscripción
            if (isset($data['datos']) && is_array($data['datos'])) {
                // Recorrer los datos de inscripción y guardarlos
                foreach ($data['datos'] as $inscripcion) {
                    // Concatenar la fecha y hora de alta
                    $fechaHora = $inscripcion['fecha_alta'] . ' ' . $inscripcion['hora_alta'];

                    // Eliminar ceros a la izquierda en clave_materia y grupo
                    $claveMateria = ltrim($inscripcion['clave_materia'], '0');
                    $grupo = ltrim($inscripcion['grupo'], '0');

                    // Consultar el horario para obtener el id basado en clave_materia y grupo
                    $horario = Horario::where('clave_materia', $claveMateria)
                                        ->where('numero_grupo', $grupo)
                                        ->first();


                    if ($horario) {
                        // Crear la inscripción en la base de datos
                        Inscripcion::create([
                            'clave_unica' => $inscripcion['clave_unica'],
                            'fecha_hora' => $fechaHora, // Fecha y hora que llega en el JSON
                            'estado' => 'Activo', // Estado por defecto
                            'clave_horario' => $horario->clave_horario, // Usar el id del horario encontrado
                            'fecha_alta' => Carbon::now(), // Fecha y hora actual del sistema
                            'fecha_baja' => null, // Asignar null si no hay fecha de baja
                            'RPE_bajaM' => null, // RPE de baja, si está disponible
                            'RPE_altaM' => "1234", // RPE de quien da de alta en el sistema
                        ]);
                    } else {
                        // Si no se encuentra el horario, manejar el error adecuadamente
                        return redirect()->back()->with('error', 'Horario no encontrado para la clave_materia ' . $claveMateria . ' y grupo ' . $grupo . '.');
                    }
                }

                return redirect()->back()->with('success', 'Datos importados correctamente.');
            } else {
                // Si no se reciben los datos de inscripción en 'datos'
                return redirect()->back()->with('error', 'No se encontraron datos de inscripción válidos.');
            }
        } else {
            // Si la clave 'correcto' no es verdadera en la respuesta principal
            return redirect()->back()->with('error', 'Error en la respuesta del servidor.');
        }
        
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
