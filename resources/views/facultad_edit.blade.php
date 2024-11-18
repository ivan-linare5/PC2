@extends('layouts.Principal')

@section('contenido')

<div class="container mt-2" id="caja">
    <h2 class="text-center">Editar Facultad</h2>

    <!-- Mensajes de éxito o error -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-circle"></i></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-circle"></i></button>
        </div>
    @endif

    <form id="editFormulario" action="{{ route('facultades.update', $facultad->clave_facultad) }}" method="POST">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="clave_facultad" class="form-label">Clave de Facultad</label>
            <input type="text" name="clave_facultad" class="form-control" id="clave_facultad" value="{{ $facultad->clave_facultad }}" readonly>
        </div>

        <div class="mb-3">
            <label for="nombre_facultad" class="form-label">Nombre de Facultad <span class="text-danger">*</span></label>
            <input type="text" name="nombre_facultad" class="form-control" id="nombre_facultad" value="{{ $facultad->nombre_facultad }}" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('facultades.index') }}" class="btn btn-danger">Cancelar</a>
    </form>
</div>

@endsection
