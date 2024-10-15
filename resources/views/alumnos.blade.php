@extends('layouts.Principal')

@section('contenido')

<!-- contenido a cargar -->
<div class="container mt-2" id="caja">
    <h2 class="text-center">CATÁLOGO ALUMNOS</h2>

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

    <form id="datos" action="{{ route('alumnos.buscar') }}" method="GET">
        @csrf
        @method('GET')
        <div class="mb-4">
            <input type="number" class="form-control" name="no_registro" id="input1" placeholder="No Registro">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" name="clave_unica" id="input2" placeholder="Clave Única">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" name="nombre" id="input3" placeholder="Nombre">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" name="apellido_paterno" id="input4" placeholder="Apellido Paterno">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" name="apellido_materno" id="input5" placeholder="Apellido Materno">
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
                    <form id="modalFormulario" action="{{ route('alumnos.guardar') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="no_registro" class="form-label">No Registro <span class="text-danger">*</span></label>
                            <input type="number" name="no_registro" class="form-control" id="no_registro" placeholder="No Registro" required>
                        </div>
                        <div class="mb-3">
                            <label for="clave_unica" class="form-label">Clave Única <span class="text-danger">*</span></label>
                            <input type="text" name="clave_unica" class="form-control" id="clave_unica" placeholder="Clave Única" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido_paterno" class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
                            <input type="text" name="apellido_paterno" class="form-control" id="apellido_paterno" placeholder="Apellido Paterno" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido_materno" class="form-label">Apellido Materno</label>
                            <input type="text" name="apellido_materno" class="form-control" id="apellido_materno" placeholder="Apellido Materno">
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo <span class="text-danger">*</span></label>
                            <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="clave_carrera" class="form-label">Clave Carrera <span class="text-danger">*</span></label>
                            <input type="text" name="clave_carrera" class="form-control" id="clave_carrera" placeholder="Clave Carrera" required>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="number" name="telefono" class="form-control" id="telefono" placeholder="Teléfono">
                        </div>
                        <div class="mb-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" class="form-control" id="fecha_ingreso">
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
    const inputs = [
        document.getElementById("input1"),
        document.getElementById("input2"),
        document.getElementById("input3"),
        document.getElementById("input4"),
        document.getElementById("input5")
    ]; // Todos los inputs

    // Función para comprobar si algún campo del formulario tiene contenido
    function checkInputs() {
        let isAnyInputFilled = inputs.some(input => input.value.trim() !== ""); // Verificar si algún input está lleno
        buscarButton.disabled = !isAnyInputFilled; // Habilitar/deshabilitar botón "Buscar"
    }

    // Escuchar el input de todos los inputs
    inputs.forEach(input => {
        input.addEventListener("input", checkInputs);
    });

    // Inicialmente, deshabilitar el botón "Buscar"
    buscarButton.disabled = true;
});
</script>
@endsection
