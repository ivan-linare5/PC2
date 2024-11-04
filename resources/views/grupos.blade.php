@extends('layouts.Principal')

@section('contenido')
<div class="container mt-2" id="caja">
    <h2 class="text-center">CATÁLOGO DE GRUPOS</h2><br><br>
    
    <div class="mb-3">
        <label for="courseSelect" class="form-label">Seleccionar una materia</label>
        <select class="form-select" id="courseSelect">
            @foreach($materias as $materia)
                <option value="{{ $materia->clave_materia }}">{{ $materia->clave_materia }} - {{ $materia->nombre_materia }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="border p-3 mb-3">
        <h4 id="materia-details-title"></h4>
        <div class="row">
            <div class="col-md-3">
                <p><strong>Horas clase:</strong> <span id="horas-clase"></span></p>
            </div>
            <div class="col-md-3">
                <p><strong>Horas laboratorio:</strong> <span id="horas-laboratorio"></span></p>
            </div>
            <div class="col-md-3">
                <p><strong>Créditos:</strong> <span id="creditos"></span></p>
            </div>
            <div class="col-md-3">
                <p><strong>Laboratorio:</strong> <span id="laboratorio"></span></p>
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
            <tbody id="grupos-table-body">
                @foreach($horarios as $horario)
                <tr>
                    <td>{{ $horario->clave_horario }}</td>
                    <td>{{ $horario->lun_Ini }}-{{ $horario->lun_Fin }}</td>
                    <td>{{ $horario->mar_Ini }}-{{ $horario->mar_Fin }}</td>
                    <td>{{ $horario->mie_Ini }}-{{ $horario->mie_Fin }}</td>
                    <td>{{ $horario->jue_Ini }}-{{ $horario->jue_Fin }}</td>
                    <td>{{ $horario->vie_Ini }}-{{ $horario->vie_Fin }}</td>
                    <td>{{ $horario->sab_Ini }}-{{ $horario->sab_Fin }}</td>
                    <td>{{ $horario->salon ? $horario->salon->id_salon : 'Sin salón' }}</td>
                    <td>
                        @if($horario->horarioCupo->isNotEmpty())
                            @foreach($horario->horarioCupo as $cupo)
                                {{ $cupo->cupo }}
                                @if (!$loop->last) | @endif <!-- Separador entre los cupos -->
                            @endforeach
                        @else
                            No hay cupos disponibles
                        @endif
                    </td>
                    <td>{{ $horario->profesor ? $horario->profesor->nombre_profesor . ' ' . $horario->profesor->primer_apellido . ' ' . ($horario->profesor->segundo_apellido ?? '') : 'Sin profesor' }}</td>
                    <td>
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
                        <button class="btn btn-sm btn-danger">Eliminar</button>
                    </td>
                </tr>
                @endforeach
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
                            @foreach($profesores as $profesor)
                                <option value="{{ $profesor->RPE_Profesor }}">{{ $profesor->RPE_Profesor }} - {{ $profesor->nombre_profesor }} {{ $profesor->primer_apellido }}</option>
                            @endforeach
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
