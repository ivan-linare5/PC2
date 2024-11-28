@extends('layouts.Principal')

@section('contenido')

<div class="container mt-2" id="caja">
    <h2 class="text-center">CATÁLOGO FACULTADES</h2>

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

    <!-- Tabla de facultades -->
    @if(isset($facultades) && $facultades->count())
        <div class="d-flex justify-content-center">
            <table class="table table-striped" style="width: 75%;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Facultad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facultades as $facultad)
                        <tr>
                            <td>{{ $facultad->clave_facultad }}</td>
                            <td>{{ $facultad->nombre_facultad }}</td>
                            <td>
                                <a href="{{ route('facultades.edit', $facultad->clave_facultad) }}" class="btn btn-warning">Modificar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No hay facultades disponibles.</p>
    @endif

    <!-- Botón para abrir el modal de agregar facultad -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">
        Agregar Nueva Facultad
    </button>

    <!-- Modal para agregar nueva facultad -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Nueva Facultad</h5>
                </div>
                <div class="modal-body">
                    <form id="modalFormulario" action="{{ route('facultades.guardar') }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="clave_facultad" class="form-label">Clave Facultad <span class="text-danger">*</span></label>
                            <input type="text" name="clave_facultad" class="form-control" id="clave_facultad" placeholder="Clave Facultad" maxlength="11" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre_facultad" class="form-label">Nombre de Facultad <span class="text-danger">*</span></label>
                            <input type="text" name="nombre_facultad" class="form-control" id="nombre_facultad" placeholder="Nombre de Facultad" required>
                        </div>

                        <button type="submit" class="btn btn-success">Guardar Cambios</button>
                        <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Validación de Clave Facultad en el Modal -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const claveFacultadInput = document.getElementById('clave_facultad');

    claveFacultadInput.addEventListener('input', function (e) {
        let value = e.target.value;
        e.target.value = value.replace(/[^0-9]/g, '').substring(0, 11);
    });
});
</script>

@endsection
