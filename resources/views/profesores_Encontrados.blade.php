@extends('layouts.Principal')

@section('contenido')
<div class="container">
    <h1>Resultados de la Búsqueda</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>RPE</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profesores as $profesor)
                <tr onclick="window.location='{{ route('profesor.search', $profesor->RPE_Profesor) }}'" style="cursor: pointer;">
                    <td>{{ $profesor->RPE_Profesor }}</td>
                    <td>{{ $profesor->nombre_profesor }}</td>
                    <td>{{ $profesor->primer_apellido }}</td>
                    <td>{{ $profesor->segundo_apellido }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection
