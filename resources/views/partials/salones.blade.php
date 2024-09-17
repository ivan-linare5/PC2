

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salones</title>
    <!--BOOTSTRAP-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Archivo CSS -->   
    <link rel="stylesheet" href="{{ asset('css/salones.css') }}">     
    <!-- Incluye el JavaScript de Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <!-- Enlace al archivo JavaScript -->
    <script src="{{ asset('Javascript/salones.js') }}"></script>
</head>

<body>
    <div class="container mt-2" id="caja">
        <h2 class="text-center">CATÁLOGO DE SALONES</h2><br><br>
        <div class="d-flex gap-4 mb-3">
            <button type="button" class="btn btn-primary" onclick="Buscar()">Buscar</button>
            <button type="button" class="btn btn-primary">Agregar Nuevo</button>
        </div>
        <form>
            <div class="mb-4">
                <input type="text" class="form-control" id="input1" placeholder="No Registro" disabled>
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input2" placeholder="Número de Salón">
            </div>
            <div class="mb-4">
                <input type="number" class="form-control" id="input3" placeholder="Capacidad">
            </div>
            <div class="mb-4">
                <select class="form-control" id="input4">
                    <option value="Salón">Salón</option>
                    <option value="Laboratorio">Laboratorio</option>
                </select>
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input5" placeholder="Ubicación">
            </div>
            <div class="mb-4">
                <select class="form-control" id="input6">
                    <option value="PB">PB</option>
                    <option value="Piso 1">Piso 1</option>
                    <option value="Piso 2">Piso 2</option>
                    <option value="Piso 3">Piso 3</option>
                </select>
            </div>
            <div class="mb-4">
                <select class="form-control" id="input7">
                    <option value="Sí">Sí</option>
                    <option value="No">No</option>
                </select>
            </div>
        </form>
    </div>
</body>
</html>
