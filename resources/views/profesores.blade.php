@extends('layouts.Principal')

@section('contenido')

<!-- contenido a cargar -->
<div class="container mt-2" id="caja">
    <h2 class="text-center">CATALOGO PROFESORES</h2>

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

    <div class="d-flex gap-4 mb-3">
        <button type="button" class="btn btn-primary" onclick="Buscar()" id="busca" >Buscar</button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">Agregar Nuevo</button>
    </div>


    <form id="datos">
        <div class="mb-4">
            <input type="text" class="form-control" id="input1" placeholder="RPE">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" id="input2" placeholder="NOMBRE">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" id="input3" placeholder="APELLIDO PATERNO">
        </div>
        <div class="mb-4">
            <input type="text" class="form-control" id="input4" placeholder="APELLIDO MATERNO">
        </div>
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

                    <!-- Teléfonos de Emergencia -->
                    <div class="mb-3">
                        <label for="telefonosEmergencia" class="form-label">Teléfonos de Emergencia <span class="text-danger">*</span></label>
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
@endsection|