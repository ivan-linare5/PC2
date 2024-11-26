@extends('layouts.Principal')

@section('contenido')
<div class="container mt-2" id="caja">
    <h2 class="text-center">CATÁLOGO DE GRUPOS</h2><br><br>
    
    <div class="mb-3">
        <label for="courseSelect" class="form-label">Seleccionar una materia</label>
        <select class="form-select" id="courseSelect">
            <option value="">-- Selecciona una materia --</option>
            @foreach($materias as $materia)
                <option value="{{ $materia->clave_materia }}">{{ $materia->clave_materia }} - {{ $materia->nombre_materia }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Clave/Gpo</th>
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
                <tr data-materia="{{ $horario->clave_materia }}"
                    data-horario-id="{{ $horario->clave_horario }}"
                    data-profesor-id="{{ $horario->RPE_profesor }}"
                    data-salon-id="{{ $horario->ID_salon }}"
                    data-grupo="{{ $horario->numero_grupo }}"
                    data-cupo="{{ $horario->horarioCupo->first()->cupo ?? '' }}"
                    data-lun-ini="{{ $horario->lun_Ini }}"
                    data-lun-fin="{{ $horario->lun_Fin }}"
                    data-mar-ini="{{ $horario->mar_Ini }}"
                    data-mar-fin="{{ $horario->mar_Fin }}"
                    data-mie-ini="{{ $horario->mie_Ini }}"
                    data-mie-fin="{{ $horario->mie_Fin }}"
                    data-jue-ini="{{ $horario->jue_Ini }}"
                    data-jue-fin="{{ $horario->jue_Fin }}"
                    data-vie-ini="{{ $horario->vie_Ini }}"
                    data-vie-fin="{{ $horario->vie_Fin }}"
                    data-sab-ini="{{ $horario->sab_Ini }}"
                    data-sab-fin="{{ $horario->sab_Fin }}">
                    <td>{{ $horario->clave_materia }}{{ $horario->numero_grupo }}</td>
                    <td>{{ $horario->lun_Ini }}-{{ $horario->lun_Fin }}</td>
                    <td>{{ $horario->mar_Ini }}-{{ $horario->mar_Fin }}</td>
                    <td>{{ $horario->mie_Ini }}-{{ $horario->mie_Fin }}</td>
                    <td>{{ $horario->jue_Ini }}-{{ $horario->jue_Fin }}</td>
                    <td>{{ $horario->vie_Ini }}-{{ $horario->vie_Fin }}</td>
                    <td>{{ $horario->sab_Ini }}-{{ $horario->sab_Fin }}</td>
                    <td>{{ $horario->salon ? $horario->salon->id_salon : 'Sin salón' }}</td>
                    <td>{{ $horario->salon ? $horario->salon->capacidad : 'Capacidad no disponible' }}</td>
                    <td>{{ $horario->profesor ? $horario->profesor->nombre_profesor . ' ' . $horario->profesor->primer_apellido . ' ' . ($horario->profesor->segundo_apellido ?? '') : 'Sin profesor' }}</td>
                    <td>
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex gap-4 mt-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Agregar Nuevo</button>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Grupo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('grupos.update') }}">
                @csrf
                <input type="hidden" name="horario_id" id="horarioId">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="profesorSelect" class="form-label">Seleccionar Profesor</label>
                        <select class="form-select" id="profesorSelect" name="profesor_id">
                            <option value="">-- Selecciona un profesor --</option>
                            @foreach($profesores as $profesor)
                                <option value="{{ $profesor->RPE_Profesor }}">{{ $profesor->nombre_profesor }} {{ $profesor->primer_apellido }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="salonSelect" class="form-label">Seleccionar Salón</label>
                        <select class="form-select" id="salonSelect" name="salon_id">
                            <option value="">-- Selecciona un salón --</option>
                            @foreach($salones as $salon)
                                <option value="{{ $salon->id_salon }}">{{ $salon->id_salon }} - Capacidad: {{ $salon->capacidad }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="grupoInput" class="form-label">Grupo</label>
                        <input type="number" class="form-control" id="grupoInput" name="grupo" required>
                    </div>
                    <div class="row">
                        @foreach(['lun', 'mar', 'mie', 'jue', 'vie', 'sab'] as $dia)
                            <div class="col-md-6 mb-3">
                                <label for="{{ $dia }}Ini" class="form-label">Hora Inicio {{ ucfirst($dia) }}</label>
                                <input type="number" class="form-control" id="{{ $dia }}Ini" name="{{ $dia }}_Ini" min="0" max="23">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="{{ $dia }}Fin" class="form-label">Hora Fin {{ ucfirst($dia) }}</label>
                                <input type="number" class="form-control" id="{{ $dia }}Fin" name="{{ $dia }}_Fin" min="0" max="23">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Agregar Nuevo Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Agregar Nuevo Grupo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('grupos.store') }}">
                @csrf
                <div class="modal-body">
                    <!-- Clave Materia selection -->
                    <div class="mb-3">
                        <label for="claveMateria" class="form-label">Seleccionar Materia</label>
                        <select class="form-select" id="claveMateria" name="clave_materia" required>
                            <option value="">-- Selecciona una materia --</option>
                            @foreach($materias as $materia)
                                <option value="{{ $materia->clave_materia }}">{{ $materia->clave_materia }} - {{ $materia->nombre_materia }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- RPE Registro (Manual Input) -->
                    <div class="mb-3">
                        <label for="RPERegistro" class="form-label">RPE Registro</label>
                        <input type="number" class="form-control" id="RPERegistro" name="RPE_registro" required>
                    </div>

                    <!-- RPE Profesor selection -->
                    <div class="mb-3">
                        <label for="RPEProfesor" class="form-label">Seleccionar Profesor</label>
                        <select class="form-select" id="RPEProfesor" name="RPE_profesor" required>
                            <option value="">-- Selecciona un profesor --</option>
                            @foreach($profesores as $profesor)
                                <option value="{{ $profesor->RPE_Profesor }}">{{ $profesor->nombre_profesor }} {{ $profesor->primer_apellido }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- ID Salon selection -->
                    <div class="mb-3">
                        <label for="IDSalon" class="form-label">Seleccionar Salón</label>
                        <select class="form-select" id="IDSalon" name="ID_salon" required>
                            <option value="">-- Selecciona un salón --</option>
                            @foreach($salones as $salon)
                                <option value="{{ $salon->id_salon }}">{{ $salon->id_salon }} - Capacidad: {{ $salon->capacidad }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Configuración Semestre (Manual Input) -->
                    <div class="mb-3">
                        <label for="ConfiguracionSemestre" class="form-label">Configuración Semestre</label>
                        <input type="number" class="form-control" id="ConfiguracionSemestre" name="id_configuracionsemestre" required>
                    </div>

                    <!-- Grupo -->
                    <div class="mb-3">
                        <label for="grupoInput" class="form-label">Grupo</label>
                        <input type="number" class="form-control" id="grupoInput" name="numero_grupo" required>
                    </div>
                    <!-- Tipo Materia -->
                    <div class="mb-3">
                    <label for="tipoMateria" class="form-label">Tipo de Materia</label>
                    <select class="form-select" id="tipoMateria" name="tipo_materia" required>
                        <option value="" disabled selected>-- Selecciona un tipo --</option>
                        <option value="T">T - Teórica</option>
                        <option value="L">L - Laboratorio</option>
                    </select>
                    </div>


                    <!-- Horas para cada día -->
                    <div class="row">
                        @foreach(['lun', 'mar', 'mie', 'jue', 'vie', 'sab'] as $dia)
                            <div class="col-md-6 mb-3">
                                <label for="{{ $dia }}Ini" class="form-label">Hora Inicio {{ ucfirst($dia) }}</label>
                                <input type="number" class="form-control" id="{{ $dia }}Ini" name="{{ $dia }}_Ini" min="0" max="23">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="{{ $dia }}Fin" class="form-label">Hora Fin {{ ucfirst($dia) }}</label>
                                <input type="number" class="form-control" id="{{ $dia }}Fin" name="{{ $dia }}_Fin" min="0" max="23">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar Grupo</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    // Filtrado por materia
    document.getElementById('courseSelect').addEventListener('change', function() {
        const selectedValue = this.value;
        const rows = document.querySelectorAll('#grupos-table-body tr');
        
        rows.forEach(function(row) {
            if (selectedValue === "" || row.getAttribute('data-materia') === selectedValue) {
                row.style.display = ''; // Mostrar fila
            } else {
                row.style.display = 'none'; // Ocultar fila
            }
        });
    });

    // Asignar datos al modal al hacer clic en "Editar"
    document.querySelectorAll('.btn-success').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');

            document.getElementById('horarioId').value = row.getAttribute('data-horario-id');
            document.getElementById('profesorSelect').value = row.getAttribute('data-profesor-id') || '';
            document.getElementById('salonSelect').value = row.getAttribute('data-salon-id') || '';
            document.getElementById('grupoInput').value = row.getAttribute('data-grupo') || '';

            const days = ['lun', 'mar', 'mie', 'jue', 'vie', 'sab'];
            days.forEach(day => {
                document.getElementById(`${day}Ini`).value = row.getAttribute(`data-${day}-ini`) || '';
                document.getElementById(`${day}Fin`).value = row.getAttribute(`data-${day}-fin`) || '';
            });
        });
    });
</script>
@endsection
