@extends('layouts.Principal')

@section('contenido')
<form id="search-form" class="d-flex">
            <input type="text" id="query" name="query" placeholder="Clave del grupo" class="form-control me-2">
            <button type="submit" class="btn btn-primary">Buscar</button>
</form>
@endsection