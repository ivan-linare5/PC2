<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Administrativo</title>
    <!-- CDN iconos -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!--CND de jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Archivo CSS -->   
    <link rel="stylesheet" href="{{ asset('css/style_principal.css') }}">
    <!-- Enlace al archivo JavaScript -->
    <script src="{{ asset('Javascript/scripts.js') }}"></script>

    <style>
        
        body{
            width: 100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            border: 0.5px solid black;
            padding: 2px;
            text-align: center;
            font-size: 9px;
            font-family:Arial, Helvetica, sans-serif;
        }
        

        .inline {
        display: inline;
    
        }

        td {
            font-size: 11px;
            font-family: Arial, Helvetica, sans-serif;
        
        }
        .border-numeros{
            border: 0.5px solid black;
        }

        .flex-container {
        display: flex;
        align-items: center;
        margin-left: 135px; 
        margin-top: 0px;
        margin-bottom: 0px; 
        position: relative;bottom: 70px;
        }

        .flex-container2 {
        display: flex;
        align-items: center;
        margin-left: 0px; 
        margin-top: 0px;
        margin-bottom: 0px; 
        position: relative;bottom: 70px;
        }

        .flex-container3 {
        display: flex;
        align-items: center;
        margin-left: 0px; 
        margin-top: 0px;
        margin-bottom: 0px;
        position: relative; bottom: 80px; 
        }

        
        .imagen1{
            position: absolute;
            bottom: 2600px;
            left: 1700px;
            width: 200px; 
            height: auto;  
        }

        .imagen2{
            position: absolute;
            bottom: 2650px;
            left: 0px;
            width: 100px; 
            height: auto;  
        }

        .imagen-fondo {
        position: fixed;
        bottom: 55px;
        right: 34;
        width: 100%;
        height: 100%;
        z-index: -1; 
    }
        .imagen-logo{
        position: fixed;
        top: 0px;
        left:460;
        width: 100%;
        height: 100%;
        z-index: -1; 
        }

        .dias {
            width: 0px; 
            position: relative;left: 550px;
            position: relative;bottom: 120px;
        }

        .dias th {
         border: 0.5px solid black;
        }

        .dias td {
         border: 0.5px solid black;
            text-align: center; 
            vertical-align: middle;
            width: 30px; 
        }

        tr:nth-child(even) .columna-con-fondo {
         background-color: #e1e0e0;
         
        }

        tr:nth-child(odd) .columna-con-fondo {
        background-color: white;
            }

    </style>
    
</head>

<body>
    
<div style="position: relative;left:30px;">
    <div style="position: relative;bottom:30px;">
        <h1 style="text-align: center; font-size:16px; font-family:Arial, Helvetica, sans-serif; font-weight:bold">UNIVERSIDAD AUTONOMA DE SAN LUIS POTOSÍ</h1>
        <h1 style="text-align: center; font-size:16px;font-family:Arial, Helvetica, sans-serif; position: relative;bottom:10px;">FACULTAD DE INGENIERÍA</h1>
    </div>

    <div style="position: relative;bottom:40px;">
    <p  style="text-align: center; font-size:10px;font-family:Arial, Helvetica, sans-serif; position: relative;bottom:20px;">Av. Manuel Nava 8, Zona Universitaria C.P. 78290, San Luis Potosí, S.L.P., México</p>
    <p  style="text-align: center; font-size:10px;font-family:Arial, Helvetica, sans-serif; position: relative;bottom:30px;">Tels. (444) 826 23 30 al 39 Fax (444) 826 23 36 http://ingenieria.uaslp.mx</p>
    <h1 style="text-align: center; font-size:16px;font-family:Arial, Helvetica, sans-serif; position: relative;bottom:30px;">LISTADO PARA ASISTENCIA</h1>
    </div>

    <div class="flex-container">
    <h2 class="inline" style="font-size:11px; font-family:Arial, Helvetica, sans-serif;">GRUPO:</h2>
    <p class="inline"  style="position:relative;right:3px; margin-right: 10px; font-size:11px; font-family:Arial, Helvetica, sans-serif;">{{ $horario->numero_grupo }}</p>
    <h2 class="inline" style="margin-right: 0px; font-size:11px; font-family:Arial, Helvetica, sans-serif;">MATERIA:</h2>
    <p class="inline"  style="font-size:11px; font-family:Arial, Helvetica, sans-serif;"> {{ strtoupper($horario->materia->nombre_materia) }}</p>
    </div>

    <div class="flex-container">
        <h2 class="inline" style="margin-right: 0px;font-size:11px; font-family:Arial, Helvetica, sans-serif;">PROFESOR:</h2>
        <p class="inline"  style="font-size:11px; font-family:Arial, Helvetica, sans-serif;">{{ strtoupper($horario->profesor->primer_apellido) }} {{ strtoupper($horario->profesor->segundo_apellido) }} {{ strtoupper($horario->profesor->nombre_profesor) }}</p>
    </div>

    <div class="flex-container">
        <h2 class="inline" style="font-size:11px; font-family:Arial, Helvetica, sans-serif;">CICLO:</h2>
        <p class="inline" style="position:relative;right:3px;font-size:11px; font-family:Arial, Helvetica, sans-serif;">{{ strtoupper($horario->configuracion->ciclo_escolar) }}</p>
        <h2 class="inline" style="margin-right: 0px;font-size:11px; font-family:Arial, Helvetica, sans-serif;">SALON:</h2>
        <p class="inline" style="margin-right: 45px; font-size:11px; font-family:Arial, Helvetica, sans-serif;">{{ strtoupper($salon->id_salon) }}</p>
        <h2 class="inline" style="font-size:11px; font-family:Arial, Helvetica, sans-serif;">TIPO:</h2>
        <p class="inline" style="font-size:11px; font-family:Arial, Helvetica, sans-serif;position: relative;right:4px;">
            @if (strtoupper($horario->tipo_materia) === 'T')
                TEORÍA
            @elseif (strtoupper($horario->tipo_materia) === 'L')
                LABORATORIO
            @endif
        </p>
    </div>

    <div class="flex-container2">
        <h2 class="inline" style="margin-right: 93px;font-size:11px; font-family:Arial, Helvetica, sans-serif; position: relative;right:30px;">FECHA</h2>
        <h2 class="inline" style="font-size:11px; font-family:Arial, Helvetica, sans-serif;">MATERIA CON LABORATORIO:</h2>
        <p class="inline" style="margin-right: 18px;font-size:11px; font-family:Arial, Helvetica, sans-serif;position: relative;right:4px;">
            @if (strtoupper($horario->materia->lleva_laboratorio) === '0')
            SI
        @elseif (strtoupper($horario->materia->lleva_laboratorio) === '1')
            NO
        @endif 
        </p>

        <h2 class="inline" style="margin-right: 0PX;font-size:11px; font-family:Arial, Helvetica, sans-serif;" >EXAMENES PARCIALES:</h2>
        <p class="inline" style="font-size:11px; font-family:Arial, Helvetica, sans-serif;">4</p>
    </div>

</div>

    <div class="flex-container3">
        <p style="font-size:11px; font-family:Arial, Helvetica, sans-serif;">{{ $fechaHoraActual }}</p>
    </div>
    

    <div class="imagen-fondo">                         <!--1100-->
        <img src="{{ public_path('img/Fondo.jpg') }}" alt="Descripción de la imagen" class="img-fluid" width="200" height="1100" >
    </div>
    <div class="imagen-logo">
        <img src="{{ public_path('img/facultad.jpg') }}" alt="Descripción de la imagen" class="img-fluid" width="90" height="auto" >
    </div>


<table class="dias">
    <thead>
        <tr>
            <th>LUN</th>
            <th>MAR</th>
            <th>MIER</th>
            <th>JUE</th>
            <th>VIE</th>
            <th>SAB</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>8</td>
            <td>8</td>
            <td>8</td>
            <td>8</td>
            <td>8</td>
            <td></td>
        </tr>
    </tbody>
</table>


<!--<table class="table table-striped" style="position: absolute;bottom:780px;">-->

<table class="table table-striped" style="position: relative;bottom:115px;">
    <thead>
        <tr>
            <th>NUM</th>
            <th>CVE. UASLP</th>
            <th >NOMBRE DEL ALUMNO </th>
            <th style="font-weight: normal;font-size:8px;width:6px;">1</th>
            <th style="font-weight: normal;font-size:8px;width:6px;">2</th>
            <th style="font-weight: normal;font-size:8px;width:6px;">3</th>
            <th style="font-weight: normal;font-size:8px;width:6px;">4</th>
            <th style="font-weight: normal;font-size:8px;width:6px;">5</th>
            <th style="font-weight: normal;font-size:8px;width:6px;">6</th>
            <th style="font-weight: normal;font-size:8px;width:6px;">7</th>
            <th style="font-weight: normal;font-size:8px;width:6px;">8</th>
            <th style="font-weight: normal;font-size:8px;width:6px;">9</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">10</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">11</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">12</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">13</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">14</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">15</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">16</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">17</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">18</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">19</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">20</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">21</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">22</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">23</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">24</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">25</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">26</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">27</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">28</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">29</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">30</th>
            <th style="font-weight: normal;font-size:8px;width:6px;padding: 0.5px;">31</th>
        </tr>
    </thead>
    <tbody>
        @php
            $cont = 1; 
          @endphp
        @foreach ($horario->inscripcion as $inscripcion)
          @foreach ($inscripcion->alumnos as $index => $alumno)
            <tr>
                <td style="text-align: center">{{$cont}}</td>
                <td style="text-align: center">0{{ $alumno->clave_Unica }}</td>
                <td class="columna-con-fondo">{{ strtoupper($alumno->primer_apellido) }} {{ strtoupper($alumno->segundo_apellido) }} {{ strtoupper($alumno->nombre_alumno) }}</td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
                <td class="border-numeros columna-con-fondo"></td>
            </tr>
            @php
            $cont++; 
          @endphp
        @endforeach
    @endforeach
    </tbody> 
</table>
<hr style="border: none; height: 0.5px; background-color: black;width:725px; position: relative;bottom:123.5px;">


<div style="position: relative;bottom:30px;">
<hr style="border: none; height: 0.5px; background-color: black;width:180px;">
<p style="font-size:10px; font-family:Arial, Helvetica, sans-serif;text-align:center; position: relative;bottom:10px; ">FIRMA</p>
<p style="font-family: Arial, Helvetica, sans-serif;font-weight:bold;font-size:10px;text-align:center; position: relative;bottom:18px;">{{strtoupper($horario->profesor->primer_apellido)}} {{strtoupper($horario->profesor->segundo_apellido)}} {{strtoupper($horario->profesor->nombre_profesor)}}</p>
</div>

</body>
</html>
