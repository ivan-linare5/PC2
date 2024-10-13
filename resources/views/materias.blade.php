@extends('layouts.Principal')

@section('contenido')
<div class="container mt-2" id="caja">
        <h2 class="text-center">CATÁLOGO DE MATERIAS</h2><br><br>
        <div class="d-flex gap-4 mb-3">
            <button type="button" class="btn btn-primary" onclick="Buscar()">Buscar</button>
            <button type="button" class="btn btn-primary">Agregar Nuevo</button>
        </div>
        <form>
            <div class="mb-4">
                <input type="text" class="form-control" id="input1" placeholder="No Registro" disabled>
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input2" placeholder="Clave Registro">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input3" placeholder="Nombre Materia">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input4" placeholder="Clave DFM">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input5" placeholder="Clave Ingeniería">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input6" placeholder="Clave Químicas">
            </div>
            <div class="mb-4">
                <select class="form-control" id="input7">
                    <option value="Sí">Sí</option>
                    <option value="No">No</option>
                </select>
            </div>
        </form>
    </div>
@endsection