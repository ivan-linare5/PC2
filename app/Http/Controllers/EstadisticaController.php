<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ConfiguracionSemestre;
use App\Models\Materia;
use App\Models\Horario;
use App\Models\Profesor;
use App\Models\Salon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EstadisticaController extends Controller
{

    public function index(Request $request)
    {
        $query = Horario::with(['profesor', 'materia', 'salon', 'inscripcion.alumnos', 'configuracion'])
            ->withCount(['inscripcion as total_alumnos' => function($query) {
                $query->select(DB::raw('count(*)'));
            }])
            ->withCount(['inscripcion as total_aprobados' => function($query) {
                $query->join('calificacion_parcial', 'inscripcion.id_inscripcion', '=', 'calificacion_parcial.id_inscripcion')
                    ->where('calificacion_parcial.calificacion', '>=', 60)
                    ->select(DB::raw('count(*)'));
            }]);

        // Filtrar por semestre 
        if ($request->has('semestre') && $request->semestre != '') {
            $query->whereHas('configuracion', function($q) use ($request) {
                $q->where('ciclo_escolar', $request->semestre);
            });
        }

        // Filtrar por materia
        if ($request->has('materia') && $request->materia != '') {
            $query->whereHas('materia', function($q) use ($request) {
                $q->where('nombre_materia', $request->materia);
            });
        }

        // Filtrar por RPE del profesor
        if ($request->has('RPE_Profesor') && $request->RPE_Profesor != '') {
            $query->whereHas('profesor', function($q) use ($request) {
                $q->where('RPE_Profesor', $request->RPE_Profesor);
            });
        }

        // Obtener los horarios filtrados
        $horarios = $query->get();

        foreach ($horarios as $horario) {
            $horario->porcentaje_aprobados = $horario->total_alumnos > 0
                ? ($horario->total_aprobados / $horario->total_alumnos) * 100
                : 0;
        }

        
        if ($request->ajax()) {
            return response()->json([
                'html' => view('table', compact('horarios'))->render()
            ]);
        }

        $configuraciones = ConfiguracionSemestre::all();
        $materias = Materia::all();
        $profesores = Profesor::all();
        $salones = Salon::all();

        return view('estadisticas', compact('horarios', 'salones', 'profesores', 'materias', 'configuraciones'));
    }
 
}
