@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>ADMINISTRACION DE RECURSOS</h1>
@stop

@section('content')
<p>Aqui puede agregar los nuevos recursos para los estudiantes de la universidad continental</p>

<form action="{{ route('recurso.store') }}" method="POST">
    @csrf
    <div class="card">
        @php
            if (session()) {
                if (session('message') == 'ok') {
                    echo '
                                                             <x-adminlte-alert class="bg-teal text-uppercase" icon="fa fa-lg fa-thumbs-up" title="Done" dismissable>
                                                             REGISTRO GUARDADO CORRECTAMENTE!
                                                             </x-adminlte-alert>';
                }
            }
        @endphp
        {{-- With icon --}}
        <div class="card-body">

            {{-- With prepend slot --}}
            <x-adminlte-input type="string" name="nombre" label="Nombre del recurso"
                placeholder="Ingrese el nombre del recurso" label-class="text-lightblue" value="{{ old('nombre') }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-passport text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            {{-- With prepend slot, lg size, and label --}}
            <x-adminlte-select name="TipoRecurso" label="Elija el tipo de recurso" label-class="text-lightblue">
                <x-slot name="prependSlot" value="{{ old(key: 'TipoRecurso') }}">
                    <div class="input-group-text ">
                        <i class="fa-duotone fa solid fa-book text-lightblue"></i>
                    </div>
                </x-slot>
                <option value="Libro"> Libro </option>
                <option value="Software"> Software </option>
                <option value="Aula virtual"> Aula virtual </option>
                <option value="Articulo"> Articulo </option>
            </x-adminlte-select>
            {{-- With prepend slot, sm size, and label --}}
            <x-adminlte-textarea name="descripcion" label="Descripcion" rows=5 label-class="text-lightblue"
                igroup-size="sm" placeholder="Ingrese la descripcion">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-dark">
                        <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-textarea>
            {{-- With prepend slot, lg size, and label --}}
            <x-adminlte-select name="Formato" label="Elija el formato de recurso" label-class="text-lightblue">
                <x-slot name="prependSlot" value="{{ old(key: 'Formato') }}">
                    <div class="input-group-text ">
                        <i class="fa fa-window-restore text-lightblue"></i>
                    </div>
                </x-slot>
                <option value="Digital"> Digital </option>
                <option value="Fisico"> Fisico </option>
                <option value="Mixto"> Mixto </option>
            </x-adminlte-select>
            {{-- With prepend slot, sm size, and label --}}
            <x-adminlte-textarea name="Ubicacion" label="Ubicacion" rows=5 label-class="text-lightblue" igroup-size="sm"
                placeholder="Ingrese la Ubicacion del recurso">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-dark">
                        <i class="fas fa-map-marker-alt text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-textarea>
            {{-- With prepend slot --}}
            <x-adminlte-input type="date" name="fechapublicacion" label="Fecha de publicacion del recurso"
                placeholder="Ingrese la fecha de publicacion del recurso" label-class="text-lightblue"
                value="{{ old('fechapublicacion') }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-calendar text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            {{-- With prepend slot, lg size, and label --}}
            <x-adminlte-select name="Estado" label="Estado de recurso" label-class="text-lightblue">
                <x-slot name="prependSlot" value="{{ old(key: 'Estado') }}">
                    <div class="input-group-text ">
                        <i class="fa fa-window-restore text-lightblue"></i>
                    </div>
                </x-slot>
                <option value="Activo"> Activo </option>
                <option value="Reservado"> Reservado </option>
            </x-adminlte-select>

            {{-- With prepend slot --}}
            <x-adminlte-input type="string" name="Encargado" label="Encargado"
                placeholder="Persona o area encargada del recurso" label-class="text-lightblue"
                value="{{ old('Encargado') }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-hands text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-button class="btn-flat" type="submit" label="Guardar" theme="success"
                icon="fas fa-lg fa-save" />
        </div>
    </div>
</form>


@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop