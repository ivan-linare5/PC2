@extends('layouts.Principal')

@section('contenido')
<h1 style="text-align: center;">Lista de Asistencia</h1>


<p>Profesor: {{ strtoupper($horario->profesor->nombre_profesor) }} {{ strtoupper($horario->profesor->primer_apellido) }} {{ strtoupper($horario->profesor->segundo_apellido) }}</p>
<p>Materia: {{ strtoupper($horario->materia->nombre_materia) }}</p>
<p>Grupo: {{ strtoupper($horario->numero_grupo)}}</p>
<p>Salon: {{ strtoupper($salon->id_salon) }}</p>


<div class="table-responsive"> 
    <table class="table table-striped">
        <thead>
            <tr>
                <th>CVE. UASLP</th>
                <th>NOMBRE DEL ALUMNO</th>
                <th>1</th>
                <th>2</th>
                <th>3</th>
                <th>4</th>
                <th>5</th>
                <th>6</th>
                <th>7</th>
                <th>8</th>
                <th>9</th>
                <th>10</th>
                <th>11</th>
                <th>12</th>
                <th>13</th>
                <th>14</th>
                <th>15</th>
                <th>16</th>
                <th>17</th>
                <th>18</th>
                <th>19</th>
                <th>20</th>
                <th>21</th>
                <th>22</th>
                <th>23</th>
                <th>24</th>
                <th>25</th>
                <th>26</th>
                <th>27</th>
                <th>28</th>
                <th>29</th>
                <th>30</th>
                <th>31</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($horario->inscripcion as $inscripcion) 
                @foreach ($inscripcion->alumnos as $alumno) 
                    <tr>
                        <td>{{ $alumno->clave_Unica }}</td> 
                        <td>{{ $alumno->nombre_alumno }} {{ $alumno->primer_apellido }} {{ $alumno->segundo_apellido }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</div> 

<a href="{{ route('listas.exportarPDF', ['clave_horario' => $horario->clave_horario]) }}" target="_blank" class="btn btn-danger">Exportar a PDF</a>
<a href="{{ route('exportarExcel', ['clave_horario' => $horario->clave_horario]) }}" class="btn btn-success">Exportar a Excel</a>
<a href="{{ route('listas.index') }}" class="btn btn-secondary mb-3" style="position: relative; top:9px;">Regresar</a>



@endsection
