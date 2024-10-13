@extends('layouts.Principal')

@section('contenido')
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
@endsection