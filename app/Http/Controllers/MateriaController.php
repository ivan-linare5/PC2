<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;

class MateriaController extends Controller
{
    public function index()
    {
        // Muestra la vista de materias
        return view('materias'); 
    }

    public function guardar(Request $request)
    {
        // Validar los datos recibidos
        /*$request->validate([
            'clave_materia' => 'required|string|max:10',
            'nombre_materia' => 'required|string|max:100',
            'lleva_laboratorio' => 'required|string|in:Sí,No',
            'clave_ingenieria' => 'nullable|string|max:10',
            'creditos_ingenieria' => 'nullable|integer|min:0',
            'clave_quimica' => 'nullable|string|max:10',
            'creditos_quimica' => 'nullable|integer|min:0'
        ]);*/

        try {
            // Guardar los datos de la materia
            Materia::create([
                'clave_materia' => $request->clave_materia,
                'nombre_materia' => $request->nombre_materia,
                'lleva_laboratorio' => $request->lleva_laboratorio,
                'clave_ingenieria' => $request->clave_ingenieria,
                'creditos_ingenieria' => $request->creditos_ingenieria,
                'clave_quimica' => $request->clave_quimica,
                'creditos_quimica' => $request->creditos_quimica,
            ]);

            // Redirigir a la vista de materias con un mensaje de éxito
            session()->flash('success', 'Materia registrada exitosamente.');
            return redirect()->route('materias.index');

        } catch (\Exception $e) {
            // Manejar errores
            session()->flash('error', 'Error al registrar la materia: ' . $e->getMessage());
            return redirect()->route('materias.index');
        }
    }

    public function buscar(Request $request)
{
    // Comprobar si al menos uno de los campos tiene datos
    if ($request->filled('clave_materia') || $request->filled('nombre_materia')) {
        // Construir la consulta
        $query = Materia::query();

        // Agregar condiciones a la consulta según los campos llenos
        if ($request->filled('clave_materia')) {
            $query->where('clave_materia', 'like', '%' . $request->clave_materia . '%');
        }
        if ($request->filled('nombre_materia')) {
            $query->where('nombre_materia', 'like', '%' . $request->nombre_materia . '%');
        }

        // Ejecutar la consulta y obtener los resultados
        $materias = $query->get();

        // Verificar si se encontraron materias
        if ($materias->isNotEmpty()) {
            // Si solo se encuentra una materia, redirigir directamente a la vista de edición
            if ($materias->count() == 1) {
                $materia = $materias->first();
                return view('materia_search_and_edit', compact('materia'));
            } else {
                // Si se encuentran varias materias, mostrar la lista
                return view('materias_encontradas', compact('materias'));
            }
        } else {
            // Si no se encuentran resultados, redirigir con un mensaje
            return redirect()->back()->with('error', 'No se encontraron materias con los datos proporcionados.');
        }
    } else {
        return redirect()->back()->with('error', 'Debe ingresar al menos un campo de búsqueda.');
    }
}


    public function search($clave_materia)
    {
        // Realizar la búsqueda en la base de datos
        $materia = Materia::where('clave_materia', $clave_materia)->first();

        // Verificar si se encontró la materia
        if ($materia) {
            // Si se encuentra, retorna la vista con los datos de la materia
            return view('materia_search_and_edit', compact('materia'));
        } else {
            // Si no se encuentra, redirigir con un mensaje de error
            return redirect()->back()->with('error', 'No se encontró una materia con la clave proporcionada.');
        }
    }

    public function update(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'clave_materia' => 'required|string|max:10',
            'nombre_materia' => 'required|string|max:100',
            'lleva_laboratorio' => 'required|string|in:Sí,No',
            'clave_ingenieria' => 'nullable|string|max:10',
            'creditos_ingenieria' => 'nullable|integer|min:0',
            'clave_quimica' => 'nullable|string|max:10',
            'creditos_quimica' => 'nullable|integer|min:0'
        ]);

        try {
            // Buscar la materia por su clave
            $materia = Materia::where('clave_materia', $request->clave_materia)->firstOrFail();

            // Actualizar los datos de la materia
            $materia->update([
                'nombre_materia' => $request->nombre_materia,
                'lleva_laboratorio' => $request->lleva_laboratorio,
                'clave_ingenieria' => $request->clave_ingenieria,
                'creditos_ingenieria' => $request->creditos_ingenieria,
                'clave_quimica' => $request->clave_quimica,
                'creditos_quimica' => $request->creditos_quimica,
            ]);

            // Redirigir con un mensaje de éxito
            session()->flash('success', 'Datos de la materia actualizados exitosamente.');
            return redirect()->back();

        } catch (\Exception $e) {
            session()->flash('error', 'Error al actualizar los datos de la materia: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
