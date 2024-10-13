@extends('layouts.Principal')

@section('contenido')

<div class="container mt-2" id="caja">
        <h2 class="text-center">CATÁLOGO DE ALUMNOS</h2><br><br>
        <div class="d-flex gap-4 mb-3">
            <button type="button" class="btn btn-primary" onclick="Buscar()">Buscar</button>
            <button type="button" class="btn btn-primary">Agregar Nuevo</button>
        </div>
        <form>
            <div class="mb-4">
                <input type="text" class="form-control" id="input1" placeholder="No Registro" disabled>
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input2" placeholder="Clave Unica">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input3" placeholder="Nombre del Alumno">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input3" placeholder="Apellido Paterno">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input3" placeholder="Apellido Materno">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input4" placeholder="Correo">
            </div>
            <div class="mb-4">
                <input type="text" class="form-control" id="input5" placeholder="Clave Carrera">
            </div>
            <div class="mb-4">
                <input type="number" class="form-control" id="input5" placeholder="Telefono">
            </div>
            <div class="mb-4">
                <input type="date" class="form-control" id="input5" placeholder="Fecha de Ingreso">
            </div>

        </form>
    </div>
@endsection