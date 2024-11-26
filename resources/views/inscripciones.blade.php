@extends('layouts.Principal')

@section('contenido')
<div class="container mt-2">
    <h2 id="text-center" style="text-align: center;">Inscripciónes</h2> <br> <!-- Título principal con estilo azul -->

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
     
    <!-- Formulario para Inscripción Semestral -->
    <form id="formSemestre" method="POST" action="{{ route('inscripcion.semestre') }}">
        @csrf
        <h3 >Inscripción Semestral</h3> <br>
        
        <!-- Menú desplegable para Ciclo -->
        <label for="cicloSemestre">Ciclo:</label>
        <select id="cicloSemestre" name="ciclo" class="form-control" required>
            <option value="" disabled selected>Selecciona un ciclo escolar</option>
            @foreach ($configuracion_semestre as $config)
                <option value="{{ $config->ciclo_escolar }}">{{ $config->ciclo_escolar }}</option>
            @endforeach
        </select>
    
        <!-- Menú desplegable para Semestre -->
        <label for="semestre">Semestre:</label>
        <select id="semestre" name="semestre" class="form-control" required>
            <option value="" disabled selected>Selecciona un semestre</option>
            @foreach ($configuracion_semestre as $config)
                <option value="{{ $config->tipo_semestre }}">{{ $config->tipo_semestre }}</option>
            @endforeach
        </select>
        
        <!-- Campo oculto para JSON -->
        <input type="hidden" id="payloadSemestre" name="payload" value=''><br>
    
        <button type="submit" class="btn btn-primary">Solicitar Inscripciónes</button>
    </form>
    
    <br>
    
    <!-- Formulario para Inscripción de Alumno -->
    <form id="formAlumno" method="POST" action="{{ route('inscripcion.alumno') }}">
        @csrf
        <h3 >Inscripción Alumno</h3> <br>
    
        <!-- Campo para Clave Única -->
        <label for="claveUnica">Clave Única:</label>
        <input type="text" id="claveUnica" name="clave_unica" class="form-control" placeholder="Ingrese clave única" required>
    
        <!-- Menú desplegable para Ciclo -->
        <label for="cicloAlumno">Ciclo:</label>
        <select id="cicloAlumno" name="ciclo" class="form-control" required>
            <option value="" disabled selected>Selecciona un ciclo escolar</option>
            @foreach ($configuracion_semestre as $config)
                <option value="{{ $config->ciclo_escolar }}">{{ $config->ciclo_escolar }}</option>
            @endforeach
        </select>
    
        <!-- Menú desplegable para Semestre -->
        <label for="semestreAlumno">Semestre:</label>
        <select id="semestreAlumno" name="semestre" class="form-control" required>
            <option value="" disabled selected>Selecciona un semestre</option>
            @foreach ($configuracion_semestre as $config)
                <option value="{{ $config->tipo_semestre }}">{{ $config->tipo_semestre }}</option>
            @endforeach
        </select>
    
        <!-- Campo oculto para JSON -->
        <input type="hidden" id="payloadAlumno" name="payload" value=''> <br>
    
        <button type="submit" class="btn btn-primary">Solicitar Inscripción del Alumno</button>
    </form>
</div>

<script>
    // Crear JSON dinámico para el formulario de semestre
    document.getElementById('formSemestre').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevenir el envío inmediato

        // Capturar valores de los selects
        const ciclo = document.getElementById('cicloSemestre').value;
        const semestre = document.getElementById('semestre').value;

        // Construir el JSON
        const payload = {
            key: "1", 
            ciclo: ciclo,
            semestre: semestre
        };

        // Asignar el JSON al campo oculto
        document.getElementById('payloadSemestre').value = JSON.stringify(payload);

        // Enviar el formulario
        this.submit();
    });

    // Crear JSON dinámico para el formulario de alumno
    document.getElementById('formAlumno').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevenir el envío inmediato

        // Capturar valores de los inputs y selects
        const claveUnica = document.getElementById('claveUnica').value;
        const ciclo = document.getElementById('cicloAlumno').value;
        const semestre = document.getElementById('semestreAlumno').value;

        // Construir el JSON
        const payload = {
            key: "1", // Cambiar este valor si es necesario
            clave_unica: claveUnica,
            ciclo: ciclo,
            semestre: semestre
        };

        // Asignar el JSON al campo oculto
        document.getElementById('payloadAlumno').value = JSON.stringify(payload);

        // Enviar el formulario
        this.submit();
    });
</script>
@endsection
