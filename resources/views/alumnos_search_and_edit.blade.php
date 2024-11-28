@extends('layouts.Principal')

@section('contenido')
<div class="container mt-2" id="caja">
    <h2 class="text-center">ALUMNO</h2>

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

    
    <form id="datos" action="{{ route('alumno.update') }}" method="POST">
    @csrf
    @method('PUT') 
    
    <div class="mb-3">
        <label for="clave_Unica" class="form-label">Clave Unica <span class="text-danger">*</span></label>
        <input type="text" name="clave_Unica" class="form-control" id="clave_Unica" value="{{ $alumno->clave_Unica}}" required readonly>
    </div>

    <div class="mb-3">
        <label for="nombre_alumno" class="form-label">Nombre <span class="text-danger">*</span></label>
        <input type="text" name="nombre_alumno" class="form-control" id="nombre_alumno" value="{{ $alumno->nombre_alumno }}" required readonly>
    </div>

    <div class="mb-3">
        <label for="primer_apellido" class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
        <input type="text" name="primer_apellido" class="form-control" id="primer_apellido" value="{{ $alumno->primer_apellido }}" required readonly>
    </div>

    <div class="mb-3">
        <label for="segundo_apellido" class="form-label">Apellido Materno</label>
        <input type="text" name="segundo_apellido" class="form-control" id="segundo_apellido" value="{{ $alumno->segundo_apellido }}" readonly>
    </div>

    <div class="mb-3">
        <label for="correo_institucional" class="form-label">Correo Institucional <span class="text-danger">*</span></label>
        <input type="email" name="correo_institucional" class="form-control" id="correo_institucional" value="{{ $alumno->correo_institucional }}" required readonly>
    </div>

    <div class="mb-3">
        <label for="clave_carrera" class="form-label">Clave Carrera <span class="text-danger">*</span></label>
        <input type="text" name="clave_carrera" class="form-control" id="clave_carrera" value="{{ $alumno->clave_carrera }}" required readonly>
    </div>

    <div class="mb-3">
    <label for="fecha_ingreso" class="form-label">Generacion <span class="text-danger">*</span></label>
    <input type="number" name="fecha_ingreso" class="form-control" id="fecha_ingreso" value="{{ $alumno->generacion }}" required readonly>
</div>

    
    <!-- Inputs para los teléfonos de emergencia -->
    <div id="telefonos-container">
    <!--<label class="form-label text-center d-block mb-3">TELÉFONOS</label>-->
        @foreach ($telefonos as $telefono)
            <div class="mb-3 d-flex align-items-center">
                <div class="flex-grow-1 me-2">
                    <label for="telefono_numero_{{ $loop->index }}" class="form-label text-center">Número Teléfonico</label>
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

    

    <button type="button" class="btn btn-outline-success" id="busca" style="display:none;" onclick="mostrarConfirmacion()">Guardar</button>
    <!--<button type="button" class="btn btn-outline-primary" onclick="activarInputs()" id="edit">Modificar</button>-->
    <a href="{{ route('alumnos.index') }}" class="btn btn-outline-warning">Regresar</a>

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
                    ¿Está seguro de que desea modificar los datos del alumno?
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
