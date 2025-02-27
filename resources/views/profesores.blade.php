@extends('layouts.Principal')

@section('contenido')
<!-- contenido a cargar -->
<div class="container mt-2" id="caja">
    <h2 class="text-center">CATÁLOGO DE PROFESORES</h2>

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


    <form id="datos" action="{{ route('profesor.buscar') }}" method="GET">
    @csrf
    @method('GET')
        <div class="mb-4">
            <input type="number" class="form-control" name="rpe" id="input1" placeholder="RPE">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" name="nombre" id="input2" placeholder="NOMBRE">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" name="apellido_paterno" id="input3" placeholder="APELLIDO PATERNO">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" name="apellido_materno" id="input4" placeholder="APELLIDO MATERNO">
        </div>
        <button type="submit" class="btn btn-primary" id="busca" disabled>Buscar</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">Agregar Nuevo</button>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Nuevo Registro</h5>
                </div>
                <div class="modal-body">
                    <form id="modalFormulario" action="{{ route('profesor.guardar') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="rpe" class="form-label">RPE <span class="text-danger">*</span></label>
                        <input type="number" name="rpe" class="form-control" id="rpe" placeholder="RPE" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_profesor" class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre_profesor" class="form-control" id="nombre_profesor" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="primer_apellido" class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
                        <input type="text" name="primer_apellido" class="form-control" id="primer_apellido" placeholder="Apellido Paterno" required>
                    </div>
                    <div class="mb-3">
                        <label for="segundo_apellido" class="form-label">Apellido Materno</label>
                        <input type="text" name="segundo_apellido" class="form-control" id="segundo_apellido" placeholder="Apellido Materno">
                    </div>
                    <div class="mb-3">
                        <label for="correo_institucional" class="form-label">Correo Institucional <span class="text-danger">*</span></label>
                        <input type="email" name="correo_institucional" class="form-control" id="correo_institucional" placeholder="Correo Institucional" required>
                    </div>
                    <div class="mb-3">
                        <label for="grado_maximo" class="form-label">Grado Máximo <span class="text-danger">*</span></label>
                        <input type="text" name="grado_maximo" class="form-control" id="grado_maximo" placeholder="Grado Máximo" required>
                    </div>
                    <div class="mb-3">
                        <label for="horas_definitivas" class="form-label">Horas definitivas totales</label>
                        <input type="number" name="horas_definitivas" class="form-control" id="horas_definitivas" placeholder="Horas definitivas" min='0'>
                    </div>
                    <div class="mb-3">
                        <label for="telefono_personal" class="form-label">Teléfono personal <span class="text-danger">*</span></label>
                        <input type="text" name="telefono_personal" class="form-control" id="telefono_personal" placeholder="Telefono personal" minlength="10" maxlength="10" pattern="\d{10}" title="Debe tener exactamente 10 dígitos" required>
                    </div>

                    <!-- Teléfonos de Emergencia -->
                    <div class="mb-3">
                        <label for="telefonosEmergencia" class="form-label">Teléfonos de emergencia <span class="text-danger">*</span></label>
                        <div id="telefonos-container">
                            <div class="input-group mb-3">
                                <input type="text" name="telefonos[0][numero]" class="form-control" placeholder="Teléfono de Emergencia" minlength="10" maxlength="10" pattern="\d{10}" title="Debe tener exactamente 10 dígitos" required>
                                <input type="text" name="telefonos[0][descripcion]" class="form-control" placeholder="Descripción" required>
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary btn-add-more" type="button" id="addTelefonos" onclick="agregarTelefono()">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>

                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- JavaScript para habilitar/deshabilitar inputs y botón Buscar -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const buscarButton = document.getElementById("busca"); // Botón "Buscar"
    const rpeInput = document.getElementById("input1"); // Input de RPE
    const otherInputs = [document.getElementById("input2"), document.getElementById("input3"), document.getElementById("input4")]; // Otros inputs

    // Función para comprobar si algún campo del formulario tiene contenido
    function checkInputs() {
        let isAnyInputFilled = false;

        if (rpeInput.value.trim() !== "") {
            isAnyInputFilled = true;
            otherInputs.forEach(input => input.disabled = true); // Deshabilitar otros inputs si RPE tiene contenido
        } else {
            otherInputs.forEach(input => input.disabled = false); // Habilitar otros inputs si RPE está vacío
            isAnyInputFilled = otherInputs.some(input => input.value.trim() !== ""); // Verificar si otros inputs tienen contenido
        }

        buscarButton.disabled = !isAnyInputFilled; // Habilitar/deshabilitar botón "Buscar"
    }

    // Deshabilitar RPE si se escribe en otros inputs
    otherInputs.forEach(input => {
        input.addEventListener("input", function () {
            if (input.value.trim() !== "") {
                rpeInput.disabled = true; // Deshabilitar RPE
            } else if (otherInputs.every(input => input.value.trim() === "")) {
                rpeInput.disabled = false; // Habilitar RPE si los otros inputs están vacíos
            }
            checkInputs();
        });
    });

    // Escuchar el input de RPE
    rpeInput.addEventListener("input", checkInputs);

    // Inicialmente, deshabilitar el botón "Buscar"
    buscarButton.disabled = true;
});
</script>
@endsection