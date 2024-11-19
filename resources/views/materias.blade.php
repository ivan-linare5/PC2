@extends('layouts.Principal')

@section('contenido')

<!-- contenido a cargar -->
<div class="container mt-2" id="caja">
    <h2 class="text-center">CATÁLOGO DE MATERIAS</h2>

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

    <!-- Formulario para buscar materias -->
    <form id="datos" action="{{ route('materia.buscar') }}" method="GET">
        @csrf
        @method('GET')
        <div class="mb-4">
            <label for="clave_materia" class="form-label">Clave de la Materia</label>
            <input type="text" class="form-control" name="clave_materia" id="clave_materia" placeholder="Clave de la Materia">
        </div>
        <div class="mb-4">
            <label for="nombre_materia" class="form-label">Nombre de la Materia</label>
            <input type="text" class="form-control" name="nombre_materia" id="nombre_materia" placeholder="Nombre de la Materia">
        </div>
        <button type="submit" class="btn btn-primary" id="busca" disabled>Buscar</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">Agregar Nuevo</button>
    </form>

    <!-- Modal para agregar nueva materia -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Nuevo Registro de Materia</h5>
                </div>
                <div class="modal-body">
                    <form id="modalFormulario" action="{{ route('materia.guardar') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="clave_materia" class="form-label">Clave de la Materia <span class="text-danger">*</span></label>
                            <input type="text" name="clave_materia" class="form-control" id="clave_materia" placeholder="Clave de la Materia" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombre_materia" class="form-label">Nombre de la Materia <span class="text-danger">*</span></label>
                            <input type="text" name="nombre_materia" class="form-control" id="nombre_materia" placeholder="Nombre de la Materia" required>
                        </div>
                        <div class="mb-3">
                            <label for="lleva_laboratorio" class="form-label">Lleva Laboratorio <span class="text-danger">*</span></label>
                            <select name="lleva_laboratorio" class="form-control" id="lleva_laboratorio" required>
                                <option value="" selected disabled>Selecciona una opción</option>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        @foreach ($facultades as $facultad)
                            <div class="mb-3">
                                <label for="clave_{{$facultad->nombre_facultad}}" class="form-label">Clave {{$facultad->nombre_facultad}}</label>
                                <input type="text" name="facultades[{{$facultad->clave_facultad}}][clave]" class="form-control" id="clave_{{$facultad->nombre_facultad}}" placeholder="Clave {{$facultad->nombre_facultad}}">
                            </div>
                            <div class="mb-3">
                                <label for="creditos_{{$facultad->nombre_facultad}}" class="form-label">Créditos {{$facultad->nombre_facultad}}</label>
                                <input type="number" name="facultades[{{$facultad->clave_facultad}}][creditos]" class="form-control" id="creditos_{{$facultad->nombre_facultad}}" placeholder="Créditos {{$facultad->nombre_facultad}}">
                            </div>
                            <!-- Input oculto para la clave de facultad, incluido en el arreglo de facultades -->
                            <input type="hidden" name="facultades[{{$facultad->clave_facultad}}][clave_facultad]" value="{{$facultad->clave_facultad}}">
                        @endforeach                      

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
    const claveMateriaInput = document.getElementById("clave_materia"); // Input de Clave de Materia
    const nombreMateriaInput = document.getElementById("nombre_materia"); // Input de Nombre de Materia

    // Función para comprobar si los campos tienen contenido
    function checkInputs() {
        const isClaveFilled = claveMateriaInput.value.trim() !== "";
        const isNombreFilled = nombreMateriaInput.value.trim() !== "";
        buscarButton.disabled = !(isClaveFilled || isNombreFilled); // Habilitar botón Buscar si uno de los campos tiene contenido
    }

    // Escuchar los cambios en los inputs
    claveMateriaInput.addEventListener("input", checkInputs);
    nombreMateriaInput.addEventListener("input", checkInputs);

    // Inicialmente, deshabilitar el botón Buscar
    buscarButton.disabled = true;
});
</script>

@endsection
