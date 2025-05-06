@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1> USUARIOS Y ROLES </h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <p> {{ $user->name }}</p>
    </div>
    <div class="card-body">
        <h5>Lista de PERMISOS</h5>

        {{ html()->modelForm($user, 'PUT', route('asignar.update', $user))->open() }}

        @foreach ($roles as $role)
            <div>
                <label>
                    {{ html()->checkbox('roles[]', $user->hasRole($role->id) ? true : false)
            ->value($role->id)
            ->class('mr-1') }}
                    {{ $role->name }}
                </label>
            </div>
        @endforeach

        {{ html()->submit('Asignar Roles')->class('btn btn-primary mt-3') }}

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