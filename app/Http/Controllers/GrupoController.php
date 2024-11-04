<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Salon;
use App\Models\Materia;
use App\Models\Profesor; // Import the Profesor model
use App\Models\HorarioCupo; // Import if needed
use Illuminate\Http\Request;
use Carbon\Carbon;


class GrupoController extends Controller
{
    public function index()
    {
        // Obtener todos los horarios con las relaciones
        $horarios = Horario::with(['materia', 'profesor', 'salon', 'horarioCupo'])->get();

        // Obtener todas las materias
        $materias = Materia::all();

        // Obtener todos los profesores
        $profesores = Profesor::all();
        
        $salones = Salon::all();

        // Pasar tanto los horarios como las materias y profesores a la vista
        return view('grupos', compact('horarios', 'materias', 'profesores', 'salones'));
    }

    public function update(Request $request)
    {
        $horario = Horario::findOrFail($request->horario_id);

        $horario->RPE_profesor = $request->profesor_id;
        $horario->ID_salon = $request->salon_id;
        $horario->numero_grupo = $request->grupo;
        $horario->lun_Ini = $request->lun_Ini;
        $horario->lun_Fin = $request->lun_Fin;
        $horario->mar_Ini = $request->mar_Ini;
        $horario->mar_Fin = $request->mar_Fin;
        $horario->mie_Ini = $request->mie_Ini;
        $horario->mie_Fin = $request->mie_Fin;
        $horario->jue_Ini = $request->jue_Ini;
        $horario->jue_Fin = $request->jue_Fin;
        $horario->vie_Ini = $request->vie_Ini;
        $horario->vie_Fin = $request->vie_Fin;
        $horario->sab_Ini = $request->sab_Ini;
        $horario->sab_Fin = $request->sab_Fin;
        $horario->save();

        // Update the 'cupo' in HorarioCupo if needed
        $horarioCupo = HorarioCupo::where('clave_horario', $horario->clave_horario)->first();
        if ($horarioCupo) {
            $horarioCupo->cupo = $request->cupo;
            $horarioCupo->save();
        }

        return redirect()->route('grupos.index')->with('success', 'Grupo actualizado correctamente.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'clave_materia' => 'required',
            'RPE_registro' => 'required',
            'RPE_profesor' => 'required',
            'ID_salon' => 'required',
            'id_configuracionsemestre' => 'required',
            'numero_grupo' => 'required|integer',
            'tipo_materia' => 'required|string|max:1',
            'lun_Ini' => 'required|integer|min:0|max:23',
            'lun_Fin' => 'required|integer|min:0|max:23',
            'mar_Ini' => 'required|integer|min:0|max:23',
            'mar_Fin' => 'required|integer|min:0|max:23',
            'mie_Ini' => 'required|integer|min:0|max:23',
            'mie_Fin' => 'required|integer|min:0|max:23',
            'jue_Ini' => 'required|integer|min:0|max:23',
            'jue_Fin' => 'required|integer|min:0|max:23',
            'vie_Ini' => 'required|integer|min:0|max:23',
            'vie_Fin' => 'required|integer|min:0|max:23',
            'sab_Ini' => 'nullable|integer|min:0|max:23',
            'sab_Fin' => 'nullable|integer|min:0|max:23',
        ]);

        Horario::create([
            'clave_materia' => $request->clave_materia,
            'RPE_registro' => $request->RPE_registro,
            'RPE_profesor' => $request->RPE_profesor,
            'ID_salon' => $request->ID_salon,
            'id_configuracionsemestre' => $request->id_configuracionsemestre,
            'numero_grupo' => $request->numero_grupo,
            'tipo_materia' => $request->tipo_materia,
            'fecha_registro' => Carbon::now()->toDateString(),
            'lun_Ini' => $request->lun_Ini,
            'lun_Fin' => $request->lun_Fin,
            'mar_Ini' => $request->mar_Ini,
            'mar_Fin' => $request->mar_Fin,
            'mie_Ini' => $request->mie_Ini,
            'mie_Fin' => $request->mie_Fin,
            'jue_Ini' => $request->jue_Ini,
            'jue_Fin' => $request->jue_Fin,
            'vie_Ini' => $request->vie_Ini,
            'vie_Fin' => $request->vie_Fin,
            'sab_Ini' => $request->sab_Ini,
            'sab_Fin' => $request->sab_Fin,
        ]);

        return redirect()->route('grupos.index')->with('success', 'Grupo agregado correctamente.');
    }

}
