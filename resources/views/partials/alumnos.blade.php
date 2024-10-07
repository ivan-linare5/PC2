<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos</title>
    <!-- CDN de jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Archivo CSS -->
    <link rel="stylesheet" href="{{ asset('css/alumnos.css') }}">
    <!-- Incluye el JavaScript de Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- CDN iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container mt-2" id="caja">
        <h2 class="text-center">CATALOGO ALUMNOS</h2><br><br>
        <div class="d-flex gap-4 mb-3">
            <button type="button" class="btn btn-primary" onclick="Buscar()" id="busca" disabled>Buscar</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAlumno">Agregar Nuevo</button>
        </div>

        <form id="alumnoForm">
            <div class="mb-4">
                <input type="text" class="form-control" id="input1" placeholder="No Registro">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input2" placeholder="Clave Única">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input3" placeholder="Nombre del Alumno">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input4" placeholder="Apellido Paterno">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input5" placeholder="Apellido Materno">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input6" placeholder="Correo">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input7" placeholder="Clave Carrera">
            </div>
            <div class="mb-4">
                <input type="number" class="form-control" id="input8" placeholder="Teléfono">
            </div>
            <div class="mb-4">
                <input type="date" class="form-control" id="input9" placeholder="Fecha de Ingreso">
            </div>
        </form>

        <div class="modal fade" id="modalAlumno" tabindex="-1" aria-labelledby="modalAlumnoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAlumnoLabel">Nuevo Registro de Alumno</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <form id="modalFormularioAlumno">
                            <div class="mb-3">
                                <label for="noRegistro" class="form-label">No Registro</label>
                                <input type="text" class="form-control" id="noRegistro" placeholder="No Registro">
                            </div>
                            <div class="mb-3">
                                <label for="claveUnica" class="form-label">Clave Única</label>
                                <input type="text" class="form-control" id="claveUnica" placeholder="Clave Única">
                            </div>
                            <div class="mb-3">
                                <label for="nombreAlumno" class="form-label">Nombre del Alumno</label>
                                <input type="text" class="form-control" id="nombreAlumno" placeholder="Nombre del Alumno">
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
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" placeholder="Correo">
                            </div>
                            <div class="mb-3">
                                <label for="claveCarrera" class="form-label">Clave Carrera</label>
                                <input type="text" class="form-control" id="claveCarrera" placeholder="Clave Carrera">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="number" class="form-control" id="telefono" placeholder="Teléfono">
                            </div>
                            <div class="mb-3">
                                <label for="fechaIngreso" class="form-label">Fecha de Ingreso</label>
                                <input type="date" class="form-control" id="fechaIngreso" placeholder="Fecha de Ingreso">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- div del contenedor principal -->
</body>
</html>
