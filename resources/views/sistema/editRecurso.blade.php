@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>EDITAR RECURSO</h1>
@stop

@section('content')
<p>Aqui puede editar los datos de su recurso</p>

<form action="{{ route('recurso.update', $recurso) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="card">
        <div class="card-body">
            {{-- With prepend slot --}}
            <x-adminlte-input type="string" name="nombre" label="Nombre del recurso" label-class="text-lightblue"
                value="{{ $recurso->nombre }}">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-passport text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            {{-- With prepend slot, lg size, and label --}}
            <x-adminlte-select name="TipoRecurso" label="Elija el tipo de recurso" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fa-duotone fa-solid fa-book text-lightblue"></i>
                    </div>
                </x-slot>
                <option value="Libro" {{ $recurso->{"tipo de recurso"} == 'Libro' ? 'selected' : '' }}>Libro</option>
                <option value="Software" {{ $recurso->{"tipo de recurso"} == 'Software' ? 'selected' : '' }}>Software
                </option>
                <option value="Aula virtual" {{ $recurso->{"tipo de recurso"} == 'Aula virtual' ? 'selected' : '' }}>Aula
                    virtual</option>
                <option value="Articulo" {{ $recurso->{"tipo de recurso"} == 'Articulo' ? 'selected' : '' }}>Articulo
                </option>
            </x-adminlte-select>
        </div>
    </div>
    {{-- With prepend slot, sm size, and label --}}
    <x-adminlte-textarea name="descripcion" label="Description" rows=5 label-class="text-lightblue" igroup-size="sm">
        <x-slot name="prependSlot">
            <div class="input-group-text bg-dark">
                <i class="fas fa-lg fa-file-alt text-lightblue"></i>
            </div>
        </x-slot>
        {{ $recurso->{"descipcion"} }}
    </x-adminlte-textarea>
    {{-- With prepend slot, lg size, and label --}}
    <x-adminlte-select name="Formato" label="Elija el formato de recurso" label-class="text-lightblue">
        <x-slot name="prependSlot" value="{{$recurso->formato }}">
            <div class="input-group-text ">
                <i class="fa fa-window-restore text-lightblue"></i>
            </div>
        </x-slot>
        <option value="Digital"> Digital </option>
        <option value="Fisico"> Fisico </option>
        <option value="Mixto"> Mixto </option>
    </x-adminlte-select>
    {{-- With prepend slot, sm size, and label --}}
    <x-adminlte-textarea name="ubicaicon" label="Ubicacion" rows=5 label-class="text-lightblue" igroup-size="sm">
        <x-slot name="prependSlot">
            <div class="input-group-text bg-dark">
                <i class="fas fa-map-marker-alt text-lightblue"></i>
            </div>
        </x-slot>
        {{ $recurso->ubicacion }}
    </x-adminlte-textarea>
    {{-- With prepend slot --}}
    <x-adminlte-input type="date" name="fechapublicacion" label="Fecha de publicación del recurso"
        label-class="text-lightblue"
        value="{{ \Carbon\Carbon::parse($recurso->{'fecha de publicacion'})->format('Y-m-d') }}">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-calendar text-lightblue"></i>
            </div>
        </x-slot>
    </x-adminlte-input>
    {{-- With prepend slot, lg size, and label --}}
    <x-adminlte-select name="Estado" label="Estado de recurso" label-class="text-lightblue">
        <x-slot name="prependSlot" value="{{ $recurso->estado }}">
            <div class="input-group-text ">
                <i class="fa fa-window-restore text-lightblue"></i>
            </div>
        </x-slot>
        <option value="Activo"> Activo </option>
        <option value="Reservado"> Reservado </option>
    </x-adminlte-select>

    {{-- With prepend slot --}}
    <x-adminlte-input type="string" name="Encargado" label="Encargado" label-class="text-lightblue"
        value="{{ $recurso->responsable }}">
        <x-slot name="prependSlot">
            <div class="input-group-text">
                <i class="fas fa-hands text-lightblue"></i>
            </div>
        </x-slot>
    </x-adminlte-input>

    <x-adminlte-button class="btn-flat" type="submit" label="ACTUALIZAR" theme="success" icon="fas fa-lg fa-save" />
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
@if (session("message"))
    <script>
        $(document).ready(function () {
            let message = @json(session('message')); // Esto asegura que el mensaje se pase correctamente al JS
            Swal.fire({
                'title': 'Resultado',
                'text': message,
                'icon': 'success',
            });
        });
    </script>
@endif
@stop