<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use App\Models\Facultad;
use App\Models\CreditosMateriasFacultades;

class MateriaController extends Controller
{
    public function index()
    {
        // Muestra la vista de materias
        $facultades = Facultad::all();
        return view('materias', compact('facultades'));
    }

    public function guardar(Request $request)
    {
        try {
            // Guardar los datos de la materia
            $materia = Materia::create([
                'clave_materia' => $request->clave_materia,
                'nombre_materia' => $request->nombre_materia,
                'lleva_laboratorio' => $request->lleva_laboratorio,
            ]);
    
            // Verificar si hay facultades asociadas
            if ($request->has('facultades')) {
                foreach ($request->facultades as $claveFacultad => $datosFacultad) {
                    // Verificar que se haya ingresado la clave y los créditos
                    if (!empty($datosFacultad['clave']) && !empty($datosFacultad['creditos'])) {
                        // Insertar los datos en la tabla intermedia (creditos_materias_facultades)
                        CreditosMateriasFacultades::create([
                           'clave_materia' => $request->clave_materia,
                           'clave_facultad' => $datosFacultad['clave_facultad'], // Esta es la clave_facultad recibida desde el formulario
                           'clave_materia_facultad' => $datosFacultad['clave'], // La clave específica de cada facultad
                           'creditos' => $datosFacultad['creditos'],
                        ]);
                    }
                }
            }
    
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
            $materia = Materia::query();

            // Agregar condiciones a la consulta según los campos llenos
            if ($request->filled('clave_materia')) {
                $materia->where('clave_materia', 'like', '%' . $request->clave_materia . '%');
            }
            if ($request->filled('nombre_materia')) {
                $materia->where('nombre_materia', 'like', '%' . $request->nombre_materia . '%');
            }

            // Ejecutar la consulta para obtener los datos
            $materia = $materia->first(); // Usamos `first` porque esperamos encontrar solo un registro

            if ($materia) {
                // Obtener todas las facultades
                $facultades = Facultad::all();
            
                // Obtener las claves de las facultades asociadas a la materia
                $datos = CreditosMateriasFacultades::where('clave_materia', $materia->clave_materia)->get();
            
                // Filtrar las facultades restantes (eliminar las facultades que coinciden con las claves de $datos)
                foreach ($facultades as $key => $facultad) {
                    foreach ($datos as $dato) {
                        // Si la clave de la facultad coincide con la clave en los datos, eliminarla de la colección de facultades
                        if ($facultad->clave_facultad == $dato->clave_facultad) {
                            unset($facultades[$key]);
                        }
                    }
                }
                // Redireccionar a la vista con los datos encontrados
                return view('materia_search_and_edit', compact('materia', 'datos', 'facultades'))
                    ->with('success', 'Búsqueda realizada con éxito.');
            } else {
                return redirect()->back()->with('error', 'No se encontraron resultados.');
            }

        } else {
            return redirect()->back()->with('error', 'Debe ingresar al menos un campo de búsqueda.');
        }
    }


    public function update(Request $request)
{
    try {
        // Buscar la materia por su clave
        $materia = Materia::where('clave_materia', $request->clave_materia)->firstOrFail();

        // Actualizar los datos de la materia (nombre, laboratorio)
        $materia->update([
            'nombre_materia' => $request->nombre_materia,
            'lleva_laboratorio' => $request->lleva_laboratorio,
        ]);
        
        // Verificar si se han enviado datos de facultades existentes para actualizar
        if ($request->has('dato')) {
            foreach ($request->dato as $claveFacultad => $datosFacultad) {
                // Verificar que se haya ingresado la clave y los créditos
                if (!empty($datosFacultad['clave']) && !empty($datosFacultad['creditos'])) {
                    // Verificar si ya existe un registro para esa facultad y materia
                    $existe = CreditosMateriasFacultades::where('clave_materia', $request->clave_materia)
                        ->where('clave_facultad', $claveFacultad)
                        ->first();
                    if ($existe) {
                        // Si el registro existe, solo actualizamos los créditos
                        $existe->update([
                            'clave_materia_facultad' => $datosFacultad['clave'], 
                            'creditos' => $datosFacultad['creditos'],
                        ]);
                    }
                }
            }
        }

        // Redirigir con un mensaje de éxito
        session()->flash('success', 'Datos de la materia actualizados exitosamente.');
        return redirect()->back();

    } catch (\Exception $e) {
        session()->flash('error', 'Error al actualizar los datos de la materia: ' . $e->getMessage());
        return redirect()->back();
    }
}

    
}

?>
