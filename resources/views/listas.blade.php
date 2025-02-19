@extends('layouts.Principal')

@section('contenido')
<form id="search-form" class="d-flex" action="{{ route('buscar.horario') }}" method="GET">
    <input type="text" id="query" name="query" placeholder="Ejemplo: Clave Materia Grupo (48 18)" class="form-control me-2" required>
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>


@if ($errors->has('query'))
    <div class="alert alert-danger mt-2">
        {{ $errors->first('query') }}
    </div>
@endif


@if (session('error'))
    <div class="alert alert-danger mt-2">
        {{ session('error') }}
    </div>
@endif



<br>
<div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        Ver Horarios
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
        @foreach($horarios as $horario)
            <li>
                <a class="dropdown-item" href="{{ route('listas.asistencia', ['clave_horario' => $horario->clave_horario]) }}">
                    {{ $horario->clave_horario }} - {{ $horario->materia->nombre_materia}} 
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection