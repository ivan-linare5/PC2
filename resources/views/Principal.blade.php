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
    <link rel="stylesheet" href="{{ asset('css/profesores.css') }}"> 
    <!-- Enlace al archivo JavaScript -->
    <script src="{{ asset('Javascript/scripts.js') }}"></script>
    <script src="{{ asset('Javascript/profesores.js') }}"></script>
</head>

<body>
    <!--BOOTSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <!--ENCABEZADO-->
    <div class="container-fluid">
        <div class="row no-gutters align-items-center">
            <div class="col-lg-7 d-flex align-items-center" id="blue">
                <img src="{{ asset('img/UASLP Logo.png') }}" alt="Logo 1" class="logo">
                <img src="{{ asset('img/DFM Logo.png') }}" alt="Logo 2" class="logo">
            </div>
            <div class="col-lg-5 d-flex justify-content-center align-items-center" id="red">
                <h1 class="title text-center"><b>PORTAL</b> <br> ADMINISTRATIVO</h1>
            </div>
        </div>
    </div>

    <!--TABLA CON LOS DATOS DEL USUARIO-->
    <div class="container-fluid mt-4">
        <table class="tabla1">
            <tbody>
                <tr>
                    <td class="col1">RPE</td>
                    <td class="col2"></td>
                </tr>
                <tr>
                    <td class="col1">NOMBRE</td>
                    <td class="col2"></td>
                </tr>
                <tr>
                    <td class="col1">FECHA</td>
                    <td class="col2" id="date"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Menú -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- Menú de navegación -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="catalogDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catálogos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="catalogDropdown">
                        <li><a class="dropdown-item" href="#" onclick="cargarContenido('/profesores')">Profesores</a></li>
                        <li><a class="dropdown-item" href="#" onclick="cargarContenido('/alumnos')">Alumnos</a></li>
                        <li><a class="dropdown-item" href="#" onclick="cargarContenido('/materias')">Materias</a></li>
                        <li><a class="dropdown-item" href="#" onclick="cargarContenido('/salones')">Salones</a></li>
                        <li><a class="dropdown-item" href="#" onclick="cargarContenido('/grupos')">Grupos</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="cargarContenido('/listaGrupos')">Listas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Estadisticas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Horario</a>
                </li>
            </ul>
            <!-- Menú para cerrar sesión -->
            <div class="d-flex">
                <button class="btn btn-outline-danger">Cerrar sesión</button>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO DINÁMICO -->
    <div class="container content mt-4">
        @yield('contenido')
    </div>


</body>
</html>
