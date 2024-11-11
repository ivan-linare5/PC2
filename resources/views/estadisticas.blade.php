@extends('layouts.Principal')

@section('contenido')
<style>
    table.table-bordered th {
        text-align: center;
    }
</style>

<div class="container">

 
 <form action="{{ route('estadisticas.index') }}" method="GET" id="filtroForm">
    <div class="row g-1  ">
        <h1 style="text-align: center">Estadísticas</h1>

        <!-- Select para el semestre -->
        <div class="col-12 col-sm-12 col-md-12 col-lg-3  ">
            <select name="semestre" class="form-select" id="semestre" aria-label="Selecciona un semestre">
                <option value="" selected disabled>Selecciona un semestre</option>
                @foreach($configuraciones as $configuracion)
                    <option value="{{ $configuracion->ciclo_escolar }}">
                        {{ $configuracion->ciclo_escolar }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Select para la materia -->
        <div class="col-12 col-sm-12 col-md-12 col-lg-3">
            <select name="materia" class="form-select" id="materia" aria-label="Selecciona una materia">
                <option value="" selected disabled>Selecciona una materia</option>
                @foreach($materias as $materia)
                    <option value="{{ $materia->nombre_materia }}">
                        {{ $materia->nombre_materia }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Buscador -->
        <div class="d-flex ms-auto col-12 col-sm-12 col-md-12 col-lg-6">
            <input type="text" name="RPE_Profesor" class="form-control me-2" id="RPE_Profesor" placeholder="RPE del Profesor">
            <button type="button" id="buscarBtn" class="btn btn-primary">Buscar</button>

            <!-- Botón de Reiniciar -->
            <button type="button" id="reiniciarBtn" class="btn btn-secondary  ms-1">Reiniciar</button>
        </div>
    </div>
</form>

    <br><br>
    <div class="table-responsive" id="tablaResultados">
        @include('table', ['horarios' => $horarios])
    </div>
</div>

<script>
   $(document).ready(function() {

    function realizarBusqueda() {
        var semestre = $('#semestre').val();
        var materia = $('#materia').val();
        var RPE_Profesor = $('#RPE_Profesor').val();

        $.ajax({
            url: '{{ route('estadisticas.index') }}',
            type: 'GET',
            data: {
                semestre: semestre,
                materia: materia,
                RPE_Profesor: RPE_Profesor
            },
            success: function(response) {
                $('#tablaResultados').html(response.html);
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud AJAX:", error);
            }
        });
    }

    $('#semestre, #materia, #RPE_Profesor').change(realizarBusqueda);

    $('#buscarBtn').click(realizarBusqueda);

    $('#reiniciarBtn').click(function() {
        $('#semestre').val('');
        $('#materia').val('');
        $('#RPE_Profesor').val('');
        realizarBusqueda(); 
    });
});

</script>

@endsection



