@extends('layouts.Principal')

@section('contenido')
<div class="container">
    <h1>Resultados de la Búsqueda</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Clave Única</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnos as $alumno)
                <tr onclick="window.location='{{ route('alumno.search', $alumno->clave_Unica) }}'" style="cursor: pointer;">
                    <td>{{ $alumno->clave_Unica }}</td>
                    <td>{{ $alumno->nombre_alumno }}</td>
                    <td>{{ $alumno->primer_apellido }}</td>
                    <td>{{ $alumno->segundo_apellido }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection