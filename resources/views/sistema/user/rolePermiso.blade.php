@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>ROLES Y PERMISOS</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <p> {{ $role->name }}</p>
    </div>
    <div class="card-body">
        <h5>Lista de PERMISOS</h5>

        {{ html()->modelForm($role, 'PUT', route('roles.update', $role))->open() }}

        @foreach ($permisos as $permiso)
            <div>
                <label>
                    {{ html()->checkbox('permisos[]', $role->hasPermissionTo($permiso->id) ? true : false)
            ->value($permiso->id)
            ->class('mr-1') }}
                    {{ $permiso->name }}
                </label>
            </div>
        @endforeach

        {{ html()->submit('Asignar Permisos')->class('btn btn-primary mt-3') }}

        {{ html()->closeModelForm() }}

    </div>
</div>
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{--
<link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop