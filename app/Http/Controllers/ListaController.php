<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
class ListaController extends Controller
{

    public function index()
    {
        $horarios = Horario::all(); 
        return view('listas', compact('horarios'));
    }

    public function obtenerListaAsistencia($clave_horario)
    {
        // Inscripción con todas las relaciones necesarias usando clave_horario
        $horario = Horario::with(['profesor','materia', 'salon', 'inscripcion.alumnos', 'configuracion'])
            ->where('clave_horario', $clave_horario) 
            ->firstOrFail(); 
    
        $salon = DB::table('horarios')
                ->join('salon', 'horarios.ID_salon', '=', 'salon.id_salon')
                ->where('horarios.clave_horario', $clave_horario)
                ->select('horarios.*', 'salon.id_salon', 'salon.capacidad','salon.tipo','salon.ubicacion','salon.nivel','salon.disponibilidad',) 
                ->first(); 

        return view('listas.asistencia', compact('horario','salon'));
    }

    public function exportarPDF($clave_horario) 
    {
        
        $horario = Horario::with(['profesor', 'materia','salon','inscripcion.alumnos'])
                ->where('clave_horario', $clave_horario) 
                ->firstOrFail();

        $salon = DB::table('horarios')
                ->join('salon', 'horarios.ID_salon', '=', 'salon.id_salon')
                ->where('horarios.clave_horario', $clave_horario)
                ->select('horarios.*', 'salon.id_salon', 'salon.capacidad','salon.tipo','salon.ubicacion','salon.nivel','salon.disponibilidad',) 
                ->first(); 

        $fechaHoraActual = Carbon::now('America/Mexico_City')->format('d/m/Y h:i:s A');
       
        $pdf = Pdf::loadView('listas.pdf', compact('horario', 'fechaHoraActual','salon'));

        //792 largo
        //ancho 612
        $pdf->setPaper([0, 0, 612, 792], 'portrait');

        return $pdf->stream('Lista_Asistencia.pdf');
    }

    public function buscarHorario(Request $request)
{
    // Validación del input con mensaje personalizado para formato inválido
    $request->validate([
        'query' => [
            'required',
            'string',
            'max:255',
            'regex:/^\d+\s+\d+$/', // Formato esperado: "número número" con un solo espacio
        ],
    ], [
        'query.regex' => 'El formato ingresado no es válido. Use el formato: "clave_materia numero_grupo" (Ejemplo: 48 18).',
    ]);

    try {
        // Separar clave_materia y numero_grupo
        $input = $request->input('query');
        [$clave_materia, $numero_grupo] = explode(' ', $input);

        // Buscar el horario
        $horario = Horario::with(['profesor', 'materia', 'salon', 'inscripcion.alumnos'])
            ->where('clave_materia', $clave_materia)
            ->where('numero_grupo', $numero_grupo)
            ->firstOrFail();

        // Obtener detalles del salón
        $salon = DB::table('horarios')
            ->join('salon', 'horarios.ID_salon', '=', 'salon.id_salon')
            ->where('horarios.clave_materia', $clave_materia)
            ->where('horarios.numero_grupo', $numero_grupo)
            ->select(
                'horarios.*', 
                'salon.id_salon', 
                'salon.capacidad',
                'salon.tipo',
                'salon.ubicacion',
                'salon.nivel',
                'salon.disponibilidad'
            )
            ->first();

        return view('listas.asistencia', compact('horario', 'salon'));
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        // Si no se encuentra el grupo
        return redirect()->back()->with('error', 'El grupo no existe. Por favor, verifica los datos ingresados.');
    } catch (\Exception $e) {
        // Otros errores
        return redirect()->back()->with('error', 'Ocurrió un error inesperado. Por favor, intente nuevamente.');
    }
}

    

    
    public function exportarExcel($clave_horario)
    {
        // Cargar la plantilla existente
        $spreadsheet = IOFactory::load(storage_path('app/plantillas/Plantilla_Listas.xlsx'));

        // Acceder a la hoja activa
        $sheet = $spreadsheet->getActiveSheet();
    
        // Obtener datos de la base de datos
        $horario = Horario::with(['inscripcion.alumnos','profesor','materia','salon'])
            ->where('clave_horario', $clave_horario)
            ->firstOrFail();

        $salon = DB::table('horarios')
            ->join('salon', 'horarios.ID_salon', '=', 'salon.id_salon')
            ->where('horarios.clave_horario', $clave_horario)
            ->select('horarios.*', 'salon.id_salon', 'salon.capacidad','salon.tipo','salon.ubicacion','salon.nivel','salon.disponibilidad',) 
            ->first(); 
    
        $asistencia = $horario->inscripcion->pluck('alumnos')->flatten(); 
    
         // Encabezado para el profesor
        $row = 7; 
        $profesor = $horario->profesor; 
        $sheet->setCellValue('I' . $row, strtoupper($profesor->primer_apellido) . ' ' . strtoupper($profesor->segundo_apellido). ' ' . strtoupper($profesor->nombre_profesor));

        // Encabezado para grupo
        $row = 6; 
        $sheet->setCellValue('H' . $row, $horario->numero_grupo);

        // Encabezado para Materia
        $row = 6; 
        $materia = $horario->materia; 
        $sheet->setCellValue('P' . $row, strtoupper($materia->nombre_materia));

        // Encabezado para Materia
        $row = 8; 
        $configuracion = $horario->configuracion; 
        $sheet->setCellValue('H' . $row, $configuracion->ciclo_escolar);

       // Encabezado para Tipo
        $row = 8;
            if (strtoupper($horario->tipo_materia) === 'T') {
                $sheet->setCellValue('U' . $row, 'TEORÍA');
            } elseif (strtoupper($horario->tipo_materia) === 'L') {
                $sheet->setCellValue('U' . $row, 'LABORATORIO');
            } 

       // Encabezado para Materia
         $row = 8;  
         $sheet->setCellValue('P' . $row, $salon->id_salon);
            
        // Encabezado para Materia con laboratorio
        $row = 9;
        $materia = $horario->materia; 
        if (strtoupper($materia->lleva_laboratorio) === '0') {
            $sheet->setCellValue('N' . $row, 'SI');
        } elseif (strtoupper($materia->lleva_laboratorio) === '1') {
            $sheet->setCellValue('N' . $row, 'NO');
        }  

        // Encabezado para Fecha
        $row = 9; 
        $fechaHoraActual = Carbon::now('America/Mexico_City')->format('d/m/Y h:i:s A');
        $sheet->setCellValue('C' . $row, $fechaHoraActual);
 

        // Llenar los datos en la plantilla con los alumnos
        $row = 12; 
        $num = 1;
        $cero=0;
        foreach ($asistencia as $alumno) {
            $sheet->setCellValue('D' . $row, strtoupper($alumno->primer_apellido).' '.strtoupper($alumno->segundo_apellido).' '.strtoupper($alumno->nombre_alumno)); 
            $sheet->setCellValue('C' . $row, $cero.$alumno->clave_Unica); 
            $sheet->setCellValue('B' . $row, $num); 
            $row++;
            $num++;
        }
    
        // Guardar el archivo modificado
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filePath = storage_path('app/plantillas/Lista_Asistencia.xlsx');
        $writer->save($filePath);
    
        // Descargar el archivo
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
    
}

