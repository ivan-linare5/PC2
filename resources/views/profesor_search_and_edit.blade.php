@extends('layouts.Principal')

@section('contenido')
<div class="container mt-2" id="caja">
    <h2 class="text-center">PROFESOR</h2>

    <form id="datos" action="#" method="POST"><!--COMPLETAR CON EL BOTON DE ACTUALIZAR-->
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="rpe" class="form-label">RPE <span class="text-danger">*</span></label>
        <input type="number" name="rpe" class="form-control" id="rpe" value="{{ $profesor->RPE_Profesor }}" required disabled>
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

    <!-- Inputs para los teléfonos de emergencia -->
    <div id="telefonos-container">
    <label class="form-label text-center d-block mb-3">TELÉFONOS DE EMERGENCIAS</label>
        @foreach ($telefonos as $telefono)
            <div class="mb-3 d-flex align-items-center">
                <div class="flex-grow-1 me-2">
                    <label for="telefono_numero_{{ $loop->index }}" class="form-label text-center">Número Teléfonico</label>
                    <input type="text" name="telefonos[{{ $loop->index }}][numero]" class="form-control" id="telefono_numero_{{ $loop->index }}" value="{{ $telefono->numero }}" disabled>
                </div>

                <div class="flex-grow-1">
                    <label for="telefono_descripcion_{{ $loop->index }}" class="form-label text-center">Descripción</label>
                    <input type="text" name="telefonos[{{ $loop->index }}][descripcion]" class="form-control" id="telefono_descripcion_{{ $loop->index }}" value="{{ $telefono->descripcion }}" disabled>
                </div>
            </div>
        @endforeach
    </div>

    <button type="submit" class="btn btn-outline-success" id="busca" style="display:none;">Guardar</button>
    <button type="button" class="btn btn-outline-primary" onclick="activarInputs()" id="edit">Modificar</button>
    <a href="{{ route('profesores.index') }}" class="btn btn-outline-warning">Regresar</a>

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

@endsection|