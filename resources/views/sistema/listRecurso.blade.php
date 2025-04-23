@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>VISTA DE TODOS LOS RECURSOS</h1>
@stop

@section('content')
<p>Lista de todos los RECURSOS</p>

<div class="row">
    @foreach($recursos as $recurso)
        <div class="col-md-4">
            <div class="card">
                <!-- Imagen en la parte superior de la tarjeta -->
                <img src="{{ asset('images/default_image.jpg') }}" alt="Imagen del recurso" class="card-img-top"
                    style="height: 200px; object-fit: cover;">

                <div class="card-header bg-primary">
                    <h4 class="card-title">{{ $recurso->nombre }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Descripción:</strong> {{ $recurso->descipcion }}</p>
                    <p><strong>Formato:</strong> {{ $recurso->formato }}</p>
                    <p><strong>Estado:</strong> {{ $recurso->estado == 1 ? 'Activo' : 'Inactivo' }}</p>
                    <p><strong>Encargado:</strong> {{ $recurso->responsable }}</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('recurso.edit', $recurso->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ route('recurso.destroy', $recurso->id) }}" class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Estás seguro de eliminar este recurso?')">Eliminar</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@stop

@section('css')
{{-- Puedes agregar más estilos personalizados aquí --}}
@stop

@section('js')
<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop