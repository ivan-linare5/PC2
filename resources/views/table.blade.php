<table class="table table-bordered" id="tablaResultados">
    <thead>
        <tr>
            <th>Ciclo Escolar</th>
            <th>Materia</th>
            <th>Horas</th>
            <th>Profesor</th>
            <th>Total Alumnos</th>
            <th>Total Aprobados</th>
            <th>Porcentaje de Aprobados</th>
        </tr>
    </thead>
    <tbody>
        @forelse($horarios as $horario)
            <tr>
                <td>{{ $horario->ConfiguracionSemestre->ciclo_escolar }}</td>
                <td>{{ $horario->materia->nombre_materia }}</td>
                <td>{{ $horario->lun_Ini}}-{{ $horario->lun_Fin}}</td>
                <td>{{ $horario->profesor->primer_apellido}} {{ $horario->profesor->segundo_apellido}} {{ $horario->profesor->nombre_profesor}}</td>
                <td>{{ $horario->total_alumnos }}</td>
                <td>{{ $horario->total_aprobados }}</td>
                <td>{{ number_format($horario->porcentaje_aprobados, 2) }}%</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align: center">No hay resultados para la búsqueda.</td>
            </tr>
        @endforelse
    </tbody>
</table>


