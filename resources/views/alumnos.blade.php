@extends('layouts.Principal')

@section('contenido')

<!-- contenido a cargar -->
<div class="container mt-2" id="caja">
    <h2 class="text-center">CATÁLOGO DE ALUMNOS</h2>

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


    <form id="datos" action="{{ route('alumno.buscar') }}" method="GET">
    @csrf
    @method('GET')
        <div class="mb-4">
            <input type="number" class="form-control" name="clave_Unica" id="input1" placeholder="CLAVE UNICA">
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
        <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalForm">Agregar Nuevo</button>-->
    </form>
    <!-- Botones para nuevos formularios -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevosAlumnos">Registrar Nuevos Alumnos</button>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConsultarAlumno">Registrar Alumno</button>

    <!-- Modal para Registrar Nuevos Alumnos -->
    <div class="modal fade" id="modalNuevosAlumnos" tabindex="-1" aria-labelledby="modalNuevosAlumnosLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNuevosAlumnosLabel">Registrar Nuevos Alumnos</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('alumno.registrarNuevos') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="ciclo" class="form-label">Ciclo Escolar</label>
                            <select id="ciclo" name="ciclo" class="form-control" required>
                                <option value="" disabled selected>Selecciona un ciclo escolar</option>
                                @foreach ($configuracion_semestre as $config)
                                    <option value="{{ $config->ciclo_escolar }}">{{ $config->ciclo_escolar }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="semestre" class="form-label">Semestre</label>
                            <select id="semestre" name="semestre" class="form-control" required>
                                <option value="" disabled selected>Selecciona un semestre</option>
                                @foreach ($configuracion_semestre as $config)
                                    <option value="{{ $config->tipo_semestre }}">{{ $config->tipo_semestre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Registrar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Consultar Alumno -->
    <div class="modal fade" id="modalConsultarAlumno" tabindex="-1" aria-labelledby="modalConsultarAlumnoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConsultarAlumnoLabel">Consultar Alumno</h5>
                </div>
                <div class="modal-body">
                    <form action="{{ route('alumno.consultar') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="clave_unica" class="form-label">Clave Única</label>
                            <input type="number" name="clave_unica" class="form-control" placeholder="Clave Única del Alumno" required>
                        </div>
                        <div class="mb-3">
                            <label for="ciclo" class="form-label">Ciclo Escolar</label>
                            <select id="ciclo" name="ciclo" class="form-control" required>
                                <option value="" disabled selected>Selecciona un ciclo escolar</option>
                                @foreach ($configuracion_semestre as $config)
                                    <option value="{{ $config->ciclo_escolar }}">{{ $config->ciclo_escolar }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="semestre" class="form-label">Semestre</label>
                            <select id="semestre" name="semestre" class="form-control" required>
                                <option value="" disabled selected>Selecciona un semestre</option>
                                @foreach ($configuracion_semestre as $config)
                                    <option value="{{ $config->tipo_semestre }}">{{ $config->tipo_semestre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Consultar</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Modal -->
    <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Nuevo Registro</h5>
                </div>
                <div class="modal-body">
                    <form id="modalFormulario" action="{{ route('alumno.guardar') }}" method="POST">
                    @csrf
                    @method('POST')

                    <div class="mb-3">
                        <label for="clave_Unica" class="form-label">Clave Unica <span class="text-danger">*</span></label>
                        <input type="number" name="clave_Unica" class="form-control" id="rpe" placeholder="clave_Unica" required>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_alumno" class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="nombre_alumno" class="form-control" id="nombre_alumno" placeholder="Nombre" required>
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
                    <label for="clave_carrera" class="form-label">Clave Carrera <span class="text-danger">*</span></label>
                    <select name="clave_carrera" class="form-select" id="clave_carrera" required>
                        <option value="">-- Selecciona una carrera --</option>
                        <option value="1">1 - Ingeniería Agroindustrial</option>
                        <option value="2">2 - Ingeniería Ambiental</option>
                        <option value="3">3 - Ingeniería Civil</option>
                        <option value="4">4 - Ingeniería en Computación</option>
                        <option value="5">5 - Ingeniería en Electricidad y Automatización</option>
                        <option value="6">6 - Ingeniería en Geología</option>
                        <option value="7">7 - Ingeniería en Sistemas Inteligentes</option>
                        <option value="8">8 - Ingeniería en Topografía y Construcción</option>
                        <option value="9">9 - Ingeniería Mecánica</option>
                        <option value="10">10 - Ingeniería Mecánica Administrativa</option>
                        <option value="11">11 - Ingeniería Mecánica Eléctrica</option>
                        <option value="12">12 - Ingeniería Mecatrónica</option>
                        <option value="13">13 - Ingeniería Metalúrgica y de Materiales</option>
                        <option value="14">14 - Químico Farmacobiólogo</option>
                        <option value="15">15 - Licenciatura en Química</option>
                        <option value="16">16 - Ingeniería Química</option>
                        <option value="17">17 - Ingeniería en Alimentos</option>
                        <option value="18">18 - Ingeniería de Bioprocesos</option>
                    </select>
                </div>

                    <div class="mb-3">
                     <label for="fecha_ingreso" class="form-label">Fecha Ingreso <span class="text-danger">*</span></label>
                    <input type="date" name="fecha_ingreso" class="form-control" id="fecha_ingreso" required>
                    </div>


                    <!-- Teléfonos de Emergencia -->
                    <div class="mb-3">
                        <label for="telefonosAlumnos" class="form-label">Teléfonos Alumno <span class="text-danger">*</span></label>
                        <div id="telefonos-container">
                            <div class="input-group mb-3">
                                <input type="text" name="telefonos[0][telefono]" class="form-control" placeholder="Teléfono" minlength="10" maxlength="10" pattern="\d{10}" title="Debe tener exactamente 10 dígitos" required>
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
    const buscarButton = document.getElementById("busca"); 
    const claveunicaInput = document.getElementById("input1"); 
    const otherInputs = [document.getElementById("input2"), document.getElementById("input3"), document.getElementById("input4")]; // Otros inputs

    // Función para comprobar si algún campo del formulario tiene contenido
    function checkInputs() {
        let isAnyInputFilled = false;

        if (claveunicaInput.value.trim() !== "") {
            isAnyInputFilled = true;
            otherInputs.forEach(input => input.disabled = true); 
        } else {
            otherInputs.forEach(input => input.disabled = false); 
            isAnyInputFilled = otherInputs.some(input => input.value.trim() !== ""); // Verificar si otros inputs tienen contenido
        }

        buscarButton.disabled = !isAnyInputFilled; // Habilitar/deshabilitar botón "Buscar"
    }

    // Deshabilitar RPE si se escribe en otros inputs
    otherInputs.forEach(input => {
        input.addEventListener("input", function () {
            if (input.value.trim() !== "") {
                claveunicaInput.disabled = true; 
            } else if (otherInputs.every(input => input.value.trim() === "")) {
                claveunicaInput.disabled = false; 
            }
            checkInputs();
        });
    });

    claveunicaInput.addEventListener("input", checkInputs);

    // Inicialmente, deshabilitar el botón "Buscar"
    buscarButton.disabled = true;
});
</script>
@endsection