@extends('layouts.Principal')

@section('contenido')

<style>
    table.table-bordered th {
        text-align: center;
    }
</style>

<div class="container mt-4">
    <h2>Resultados de la Búsqueda</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ciclo Escolar</th>
                <th>Materia</th>
                <th>Horas</th>
                <th>Profesor</th>
                <th>Total Alumnos</th>
                <th>Total Aprobados</th>
                <th>Porcentaje de Aprobados</th>

            </tr>
        </thead>
        <tbody>
            @forelse($calificaciones as $calificacion)
                <tr>
                    <td>{{ $calificacion->horarios->configuracionSemestre->ciclo_escolar }}</td>
                    <td>{{ $calificacion->horarios->materia->nombre_materia }}</td>
                    <td></td>
                    <td>{{ $calificacion->horarios->profesor->primer_apellido}} {{ $calificacion->horarios->profesor->segundo_apellido}} {{ $calificacion->horarios->profesor->nombre_profesor}}</td>
                    <td>{{ $calificacion->total_alumnos }}</td>
                    <td>{{ $calificacion->alumnos->nombre_alumno }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2">No hay resultados para la búsqueda.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

