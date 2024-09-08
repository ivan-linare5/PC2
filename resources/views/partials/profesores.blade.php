<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores</title>
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Archivo CSS -->   
    <link rel="stylesheet" href="{{ asset('css/profesores.css') }}">     
     <!-- Incluye el JavaScript de Bootstrap -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Enlace al archivo JavaScript -->
    <script src="{{ asset('Javascript/profesores.js') }}"></script>

</head>

<body>
   
    <div class="container mt-2" id="caja">
        <h2 class="text-center">CATALOGO PROFESORES</h2><br><br>
        <div class="d-flex gap-4 mb-3">
            <button type="button" class="btn btn-primary" onclick="Buscar()">Buscar</button>
            <button type="button" class="btn btn-primary">Agregar Nuevo</button>
        </div>
        <form>
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
    </div>

    
</body>
</html>
