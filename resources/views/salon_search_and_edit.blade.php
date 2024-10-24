@extends('layouts.Principal')

@section('contenido')
<div class="container mt-2" id="caja">
    <h2 class="text-center">SALONES</h2>

    <!-- Mensajes de éxito o error -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="bi bi-x-circle"></i>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <i class="bi bi-x-circle"></i>
            </button>
        </div>
    @endif

    <form id="datos" action="{{ route('salon.update') }}" method="POST">
        @csrf
        @method('PUT') 
        
        <div class="mb-3">
            <label for="id_salon" class="form-label">Número de Salón <span class="text-danger">*</span></label>
            <input type="text" name="id_salon" class="form-control" id="id_salon" value="{{ $salon->id_salon }}" required readonly>
        </div> 

        <div class="mb-3">
            <label for="capacidad" class="form-label">Capacidad <span class="text-danger">*</span></label>
            <input type="number" name="capacidad" class="form-control" id="capacidad" value="{{ $salon->capacidad }}" required disabled>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Salón <span class="text-danger">*</span></label>
            <input type="text" name="tipo" class="form-control" id="tipo" value="{{ $salon->tipo }}" required disabled>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación <span class="text-danger">*</span></label>
            <input type="text" name="ubicacion" class="form-control" id="ubicacion" value="{{ $salon->ubicacion }}" required disabled>
        </div>

        <div class="mb-3">
            <label for="nivel" class="form-label">Nivel <span class="text-danger">*</span></label>
            <input type="text" name="nivel" class="form-control" id="nivel" value="{{ $salon->nivel }}" required disabled>
        </div>

        <div class="mb-3">
            <label for="disponibilidad" class="form-label">Disponibilidad <span class="text-danger">*</span></label>
            <select name="disponibilidad" class="form-control" id="disponibilidad" disabled>
                <option value="Sí" {{ $salon->disponibilidad == 'Sí' ? 'selected' : '' }}>Sí</option>
                <option value="No" {{ $salon->disponibilidad == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <button type="button" class="btn btn-outline-success" id="busca" style="display:none;" onclick="mostrarConfirmacion()">Guardar</button>
        <button type="button" class="btn btn-outline-primary" onclick="activarInputs()" id="edit">Modificar</button>
        <a href="{{ route('salones.index') }}" class="btn btn-outline-warning">Regresar</a>

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
                    ¿Está seguro de que desea modificar los datos del salón?
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
