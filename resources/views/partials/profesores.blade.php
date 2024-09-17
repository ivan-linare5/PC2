<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores</title>
    <!--CND de jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Archivo CSS -->   
    <link rel="stylesheet" href="{{ asset('css/profesores.css') }}">     
     <!-- Incluye el JavaScript de Bootstrap -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
     <!--CND iconos-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-2" id="caja">
        <h2 class="text-center">CATALOGO PROFESORES</h2><br><br>
        <div class="d-flex gap-4 mb-3">
            <button type="button" class="btn btn-primary" onclick="Buscar()" id="busca" disabled>Buscar</button>
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

        <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormLabel">Nuevo Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body">
                <form id="modalFormulario">
                    <div class="mb-3">
                        <label for="rpe" class="form-label">RPE</label>
                        <input type="text" class="form-control" id="rpe" placeholder="RPE">
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellidoPaterno" placeholder="Apellido Paterno">
                    </div>
                    <div class="mb-3">
                        <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidoMaterno" placeholder="Apellido Materno">
                    </div>
                    <div class="mb-3">
                        <label for="profesion" class="form-label">Profesión</label>
                        <input type="text" class="form-control" id="profesion" placeholder="Profesión">
                    </div>
                    <div class="mb-3">
                        <label for="numeroHoras" class="form-label">Número de Horas</label>
                        <input type="number" class="form-control" id="numeroHoras" placeholder="Número de Horas" min="0" step="1">
                    </div>
                    <div class="mb-3" id="horasDefinitivas">
                        <label for="horasDefinitivas" class="form-label">Horas Definitivas</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Horas Inicio">
                            <input type="text" class="form-control" placeholder="Horas Final">
                        </div>
                        <button class="btn btn-outline-secondary btn-add-more" type="button" id="addHoras">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label for="tituloProfesional" class="form-label">Título Profesional</label>
                        <input type="file" class="form-control" id="tituloProfesional" accept=".pdf">
                    </div>
                    <div class="mb-3">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="file" class="form-control" id="cedula" accept=".pdf">
                    </div>
                    <div class="mb-3" id="telefonosEmergencia">
                        <label for="telefonosEmergencia" class="form-label">Teléfonos de Emergencia con Descripción</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Teléfono de Emergencia">
                            <input type="text" class="form-control" placeholder="Descripción">
                        </div>
                        <button class="btn btn-outline-secondary btn-add-more" type="button" id="addTelefonos">
                            <i class="bi bi-plus"></i> 
                        </button>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>


    </div> <!--div del contenedor principal-->

    
</body>
</html>