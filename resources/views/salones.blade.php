@extends('layouts.Principal')

@section('contenido')

<!-- contenido a cargar -->
<div class="container mt-2" id="caja">
    <h2 class="text-center">CATÁLOGO DE SALONES</h2>

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

    <!-- Formulario para buscar salones -->
    <form id="datos" action="{{ route('salon.buscar') }}" method="GET">
        @csrf
        @method('GET')
        <div class="mb-4">
            <label for="id_salon" class="form-label">Número de Salón</label>
            <input type="text" class="form-control" name="id_salon" id="id_salon" placeholder="Número de Salón">
        </div>
        <button type="submit" class="btn btn-primary" id="busca" disabled>Buscar</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">Agregar Nuevo</button>
    </form>

    <!-- Modal para agregar nuevo salón -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Nuevo Registro de Salón</h5>
                </div>
                <div class="modal-body">
                    <form id="modalFormulario" action="{{ route('salon.guardar') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="numSalon" class="form-label">Número de Salón <span class="text-danger">*</span></label>
                            <input type="text" name="id_salon" class="form-control" id="numSalon" placeholder="Número de Salón" required>
                        </div>
                        <div class="mb-3">
                            <label for="capacidad" class="form-label">Capacidad <span class="text-danger">*</span></label>
                            <input type="number" name="capacidad" class="form-control" id="capacidad" placeholder="Capacidad" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo de Salón <span class="text-danger">*</span></label>
                            <select name="tipo" class="form-control" id="tipo" required>
                                <option value="Salón">Salón</option>
                                <option value="Laboratorio">Laboratorio</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación <span class="text-danger">*</span></label>
                            <input type="text" name="ubicacion" class="form-control" id="ubicacion" placeholder="Ubicación" required>
                        </div>
                        <div class="mb-3">
                            <label for="nivel" class="form-label">Nivel <span class="text-danger">*</span></label>
                            <select name="nivel" class="form-control" id="nivel" required>
                                <option value="PB">PB</option>
                                <option value="Piso 1">Piso 1</option>
                                <option value="Piso 2">Piso 2</option>
                                <option value="Piso 3">Piso 3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="disponibilidad" class="form-label">Disponibilidad <span class="text-danger">*</span></label>
                            <select name="disponibilidad" class="form-control" id="disponibilidad" required>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
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
    const salonInput = document.getElementById("id_salon"); // Input del Número de Salón

    // Función para comprobar si el campo del formulario tiene contenido
    function checkInput() {
        buscarButton.disabled = salonInput.value.trim() === ""; // Habilitar/deshabilitar botón "Buscar"
    }

    // Escuchar el input del Número de Salón
    salonInput.addEventListener("input", checkInput);

    // Inicialmente, deshabilitar el botón "Buscar"
    buscarButton.disabled = true;
});
</script>

@endsection
