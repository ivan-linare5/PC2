@extends('layouts.Principal')

@section('contenido')
<div class="container mt-2" id="caja">
    <h2 class="text-center">MATERIA</h2>

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

    <form id="datos" action="{{ route('materia.update') }}" method="POST">
    @csrf
    @method('PUT') 
    
    <div class="mb-3">
        <label for="clave_materia" class="form-label">Clave de la Materia <span class="text-danger">*</span></label>
        <input type="text" name="clave_materia" class="form-control" id="clave_materia" value="{{ $materia->clave_materia }}" required readonly>
    </div>

    <div class="mb-3">
        <label for="nombre_materia" class="form-label">Nombre de la Materia <span class="text-danger">*</span></label>
        <input type="text" name="nombre_materia" class="form-control" id="nombre_materia" value="{{ $materia->nombre_materia }}" required disabled>
    </div>

    <div class="mb-3">
        <label for="lleva_laboratorio" class="form-label">Lleva Laboratorio <span class="text-danger">*</span></label>
        <select name="lleva_laboratorio" class="form-control" id="lleva_laboratorio" disabled>
            <option value="Sí" {{ $materia->lleva_laboratorio == 'Sí' ? 'selected' : '' }}>Sí</option>
            <option value="No" {{ $materia->lleva_laboratorio == 'No' ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="clave_ingenieria" class="form-label">Clave Ingeniería <span class="text-danger">*</span></label>
        <input type="text" name="clave_ingenieria" class="form-control" id="clave_ingenieria" value="{{ $materia->clave_ingenieria }}" required disabled>
    </div>

    <div class="mb-3">
        <label for="creditos_ingenieria" class="form-label">Créditos Ingeniería <span class="text-danger">*</span></label>
        <input type="number" name="creditos_ingenieria" class="form-control" id="creditos_ingenieria" value="{{ $materia->creditos_ingenieria }}" required disabled>
    </div>

    <div class="mb-3">
        <label for="clave_quimica" class="form-label">Clave Química</label>
        <input type="text" name="clave_quimica" class="form-control" id="clave_quimica" value="{{ $materia->clave_quimica }}" disabled>
    </div>

    <div class="mb-3">
        <label for="creditos_quimica" class="form-label">Créditos Química</label>
        <input type="number" name="creditos_quimica" class="form-control" id="creditos_quimica" value="{{ $materia->creditos_quimica }}" disabled>
    </div>

    <button type="button" class="btn btn-outline-success" id="busca" style="display:none;" onclick="mostrarConfirmacion()">Guardar</button>
    <button type="button" class="btn btn-outline-primary" onclick="activarInputs()" id="edit">Modificar</button>
    <a href="{{ route('materias.index') }}" class="btn btn-outline-warning">Regresar</a>

    </form>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmacionModalLabel">Confirmación de Modificación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de que desea modificar los datos de la materia?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-outline-success" onclick="enviar()">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function activarInputs() {
        // Obtener todos los inputs dentro del formulario
        const inputs = document.querySelectorAll('#datos input, #datos select');
        
        // Habilitar todos los inputs
        inputs.forEach(input => {
            input.disabled = false;
        });

        // Ocultar el botón Modificar
        document.getElementById('edit').style.display = 'none';

        // Mostrar el botón Guardar
        document.getElementById('busca').style.display = 'inline-block';
    }

    function enviar(){
        // Enviar el formulario
        document.getElementById('datos').submit();

        // Cerrar el modal de confirmación
        const modal = bootstrap.Modal.getInstance(document.getElementById('confirmacionModal'));
        modal.hide();
    }

    function mostrarConfirmacion() {
        // Mostrar el modal de confirmación
        const modal = new bootstrap.Modal(document.getElementById('confirmacionModal'));
        modal.show();
    }

</script>

@endsection
