@extends('layouts.Principal')

@section('contenido')
<div class="container mt-2" id="caja">
    <h2 class="text-center">CATÁLOGO DE GRUPOS</h2><br><br>
    
    <div class="mb-3">
        <label for="courseSelect" class="form-label">Seleccionar una materia</label>
        <select class="form-select" id="courseSelect">
            <option selected>2053 - ADMINISTRACION DE PROYECTOS I - ÁREA DE CIENCIAS DE LA COMPUTACIÓN</option>
        </select>
    </div>
    
    <div class="border p-3 mb-3">
        <h4>2053 - ADMINISTRACION DE PROYECTOS I</h4>
        <div class="row">
            <div class="col-md-3">
                <p><strong>Horas clase:</strong> 4</p>
            </div>
            <div class="col-md-3">
                <p><strong>Horas laboratorio:</strong> 0</p>
            </div>
            <div class="col-md-3">
                <p><strong>Créditos:</strong> 8</p>
            </div>
            <div class="col-md-3">
                <p><strong>Laboratorio:</strong> No</p>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sábado</th>
                    <th>Salón</th>
                    <th>Cupo</th>
                    <th>Nombre del profesor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2053.01</td>
                    <td>13-14</td>
                    <td>13-14</td>
                    <td>13-14</td>
                    <td>--</td>
                    <td>--</td>
                    <td>--</td>
                    <td>F-16</td>
                    <td>28 / 28</td>
                    <td>RAMOS BLANCO ALBERTO</td>
                    <td>
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>2053.02</td>
                    <td>8-9</td>
                    <td>8-9</td>
                    <td>8-9</td>
                    <td>--</td>
                    <td>--</td>
                    <td>--</td>
                    <td>F-05</td>
                    <td>28 / 28</td>
                    <td>RODRIGUEZ FLORES HUGO ARMANDO</td>
                    <td>
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="d-flex gap-4 mt-3">
        <button type="button" class="btn btn-primary" onclick="Buscar()">Buscar</button>
        <button type="button" class="btn btn-primary">Agregar Nuevo</button>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">EDITAR GRUPO DE TEORÍA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="grupo" class="form-label">Grupo</label>
                            <input type="text" class="form-control" id="grupo" value="2">
                        </div>
                        <div class="col-md-3">
                            <label for="salon" class="form-label">Salón</label>
                            <input type="text" class="form-control" id="salon" value="F-16">
                        </div>
                        <div class="col-md-3">
                            <label for="checador" class="form-label">Checador</label>
                            <input type="text" class="form-control" id="checador" value="Checador">
                        </div>
                        <div class="col-md-3">
                            <label for="cupo" class="form-label">Cupo</label>
                            <input type="text" class="form-control" id="cupo" value="15">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Horario</label>
                        <div class="row">
                            @foreach(['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $day)
                                <div class="col-md-2">
                                    <label>{{ $day }}</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Inicio" aria-label="{{ $day }} Inicio">
                                        <input type="text" class="form-control" placeholder="Fin" aria-label="{{ $day }} Fin">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="profesor" class="form-label">Profesor</label>
                        <select class="form-select" id="profesor">
                            <option selected>10285 - RAMOS BLANCO ALBERTO</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Inscribir el laboratorio con la misma clave (laboratorio obligatorio)</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="laboratorio" id="labSi" value="Si">
                            <label class="form-check-label" for="labSi">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="laboratorio" id="labNo" value="No" checked>
                            <label class="form-check-label" for="labNo">No</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
