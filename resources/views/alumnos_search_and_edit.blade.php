@extends('layouts.Principal')

@section('contenido')
<div class="container mt-2" id="caja">
    <h2 class="text-center">ALUMNO</h2>

    <form id="datos" action="{{ route('alumno.actualizar', $alumno->no_registro) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="no_registro" class="form-label">No Registro <span class="text-danger">*</span></label>
            <input type="number" name="no_registro" class="form-control" id="no_registro" value="{{ $alumno->no_registro }}" required disabled>
        </div>

        <div class="mb-3">
            <label for="clave_unica" class="form-label">Clave Única <span class="text-danger">*</span></label>
            <input type="text" name="clave_unica" class="form-control" id="clave_unica" value="{{ $alumno->clave_unica }}" required disabled>
        </div>

        <div class="mb-3">
            <label for="nombre_alumno" class="form-label">Nombre <span class="text-danger">*</span></label>
            <input type="text" name="nombre_alumno" class="form-control" id="nombre_alumno" value="{{ $alumno->nombre_alumno }}" required disabled>
        </div>

        <div class="mb-3">
            <label for="apellido_paterno" class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
            <input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" value="{{ $alumno->apellido_paterno }}" required disabled>
        </div>

        <div class="mb-3">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <input type="text" name="apellido_materno" class="form-control" id="apellido_materno" value="{{ $alumno->apellido_materno }}" disabled>
        </div>

        <div class="mb-3">
            <label for="correo" class="form-label">Correo <span class="text-danger">*</span></label>
            <input type="email" name="correo" class="form-control" id="correo" value="{{ $alumno->correo }}" required disabled>
        </div>

        <div class="mb-3">
            <label for="clave_carrera" class="form-label">Clave Carrera <span class="text-danger">*</span></label>
            <input type="text" name="clave_carrera" class="form-control" id="clave_carrera" value="{{ $alumno->clave_carrera }}" required disabled>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" id="telefono" value="{{ $alumno->telefono }}" disabled>
        </div>

        <div class="mb-3">
            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso <span class="text-danger">*</span></label>
            <input type="date" name="fecha_ingreso" class="form-control" id="fecha_ingreso" value="{{ $alumno->fecha_ingreso }}" required disabled>
        </div>

        <button type="submit" class="btn btn-outline-success" id="busca" style="display:none;">Guardar</button>
        <button type="button" class="btn btn-outline-primary" onclick="activarInputs()" id="edit">Modificar</button>
        <a href="{{ route('alumnos.index') }}" class="btn btn-outline-warning">Regresar</a>

    </form>
</div>

<script>
    function activarInputs() {
        // Obtener todos los inputs dentro del formulario
        const inputs = document.querySelectorAll('#datos input');
        
        // Habilitar todos los inputs
        inputs.forEach(input => {
            input.disabled = false;
        });

        // Ocultar el botón Modificar
        document.getElementById('edit').style.display = 'none';

        // Mostrar el botón Guardar
        document.getElementById('busca').style.display = 'inline-block';
    }
</script>

@endsection
