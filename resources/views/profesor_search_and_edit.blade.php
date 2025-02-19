@extends('layouts.Principal')

@section('contenido')
<div class="container mt-2" id="caja">
    <h2 class="text-center">PROFESOR</h2>

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

    
    <form id="datos" action="{{ route('profesor.update') }}" method="POST">
    @csrf
    @method('PUT') 
    
    <div class="mb-3">
        <label for="rpe" class="form-label">RPE <span class="text-danger">*</span></label>
        <input type="text" name="rpe" class="form-control" id="rpe" value="{{ $profesor->RPE_Profesor}}" required readonly>
    </div>

    <div class="mb-3">
        <label for="nombre_profesor" class="form-label">Nombre <span class="text-danger">*</span></label>
        <input type="text" name="nombre_profesor" class="form-control" id="nombre_profesor" value="{{ $profesor->nombre_profesor }}" required disabled>
    </div>

    <div class="mb-3">
        <label for="primer_apellido" class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
        <input type="text" name="primer_apellido" class="form-control" id="primer_apellido" value="{{ $profesor->primer_apellido }}" required disabled>
    </div>

    <div class="mb-3">
        <label for="segundo_apellido" class="form-label">Apellido Materno</label>
        <input type="text" name="segundo_apellido" class="form-control" id="segundo_apellido" value="{{ $profesor->segundo_apellido }}" disabled>
    </div>

    <div class="mb-3">
        <label for="correo_institucional" class="form-label">Correo Institucional <span class="text-danger">*</span></label>
        <input type="email" name="correo_institucional" class="form-control" id="correo_institucional" value="{{ $profesor->correo_institucional }}" required disabled>
    </div>

    <div class="mb-3">
        <label for="grado_maximo" class="form-label">Grado Máximo <span class="text-danger">*</span></label>
        <input type="text" name="grado_maximo" class="form-control" id="grado_maximo" value="{{ $profesor->grado_maximo }}" required disabled>
    </div>

    <div class="mb-3">
        <label for="horas_definitivas" class="form-label">Horas Definitivas Totales</label>
        <input type="number" name="horas_definitivas" class="form-control" id="horas_definitivas" value="{{ $profesor->horas_definitivas }}" min='0' disabled>
    </div>

    <div class="mb-3">
        <label for="telefono_personal" class="form-label">Teléfono Personal <span class="text-danger">*</span></label>
        <input type="text" name="telefono_personal" class="form-control" id="telefono_personal" value="{{ $profesor->telefono_personal }}" minlength="10" maxlength="10" pattern="\d{10}" title="Debe tener exactamente 10 dígitos"required disabled>
    </div>

    <!-- Inputs para los teléfonos de emergencia -->
    <div id="telefonos-container">
    <label class="form-label text-center d-block mb-3">TELÉFONOS DE EMERGENCIAS</label>
        @foreach ($telefonos as $telefono)
            <div class="mb-3 d-flex align-items-center">
                <div class="flex-grow-1 me-2">
                    <label for="telefono_numero_{{ $loop->index }}" class="form-label text-center">Número Telefónico/label>
                    <input type="text" name="telefonos[{{ $loop->index }}][numero]" class="form-control" id="telefono_numero_{{ $loop->index }}" value="{{ $telefono->numero }}" disabled minlength="10" maxlength="10" pattern="\d{10}" title="Debe tener exactamente 10 dígitos">
                </div>

                <div class="flex-grow-1">
                    <label for="telefono_descripcion_{{ $loop->index }}" class="form-label text-center">Descripción</label>
                    <input type="text" name="telefonos[{{ $loop->index }}][descripcion]" class="form-control" id="telefono_descripcion_{{ $loop->index }}" value="{{ $telefono->descripcion }}" disabled>
                </div>
            </div>
        @endforeach
    </div>

    <button class="btn btn-outline-secondary btn-add-more" type="button" id="addTelefonos" onclick="agregarTelefono()" style="display:none;">
        <i class="bi bi-plus"></i>
    </button><br><br>

    <div class="mb-3">
        <input type="hidden" name="activo" value="0"> <!-- Valor por defecto si el checkbox no está marcado -->
        <div class="form-check">
            <input type="checkbox" name="activo" class="form-check-input" id="activo" value="1" {{ $profesor->Activo == 1 ? 'checked' : '' }} required disabled>
            <label for="activo" class="form-label">Activo <span class="text-danger">*</span></label>
        </div>
    </div>
    

    <button type="button" class="btn btn-outline-success" id="busca" style="display:none;" onclick="mostrarConfirmacion()">Guardar</button>
    <button type="button" class="btn btn-outline-primary" onclick="activarInputs()" id="edit">Modificar</button>
    <a href="{{ route('profesores.index') }}" class="btn btn-outline-warning">Regresar</a>

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
                    ¿Está seguro de que desea modificar los datos del profesor?
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
        
        // Mostrar el botón de agregar numeros de telefonos
        document.getElementById('addTelefonos').style.display = 'inline-block';
        
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
