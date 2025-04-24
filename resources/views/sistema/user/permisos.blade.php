@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>VISTA DE TODOS LOS RECURSOS</h1>
@stop

@section('content')
<p>Lista de todos los RECURSOS</p>
<div class="card">
    <div class="card-header">
        <x-adminlte-button label="Nuevo" theme="primary" icon="fas fa-key" class="float-right" data-toggle="modal"
            data-target="#modalPurple" />
    </div>
    <div class="card-body">
        {{-- Setup data for datatables --}}
        @php
            $heads = [
                'ID',
                'Nombre',
                ['label' => 'Actions', 'no-export' => true, 'width' => 10]
            ];

            $btnEdit = '';
            $btnDelete = '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                                                                                                                                 <i class="fa fa-lg fa-fw fa-trash"></i>
                                                                                                                                                 </button>';
            $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                                                                                                                                                 <i class="fa fa-lg fa-fw fa-eye"></i>
                                                                                                                                                 </button>';

            $config = [
                'language' => [
                    'url' => '//cdn.datatables.net/plug-ins/1.13.6/i18n/es_ES.json'
                ]
            ];
        @endphp
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config">
            @foreach($permisos as $permiso)
                <tr>
                    <td>{{ $permiso->id }}</td>
                    <td>{{ $permiso->name }}</td>
                    <td><a href="{{ route('permisos.edit', $permiso) }}"
                            class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                        <form style="display: inline;" action="{{ route('permisos.destroy', $permiso) }}" method="post"
                            class="formEliminar">
                            @csrf
                            @method('delete')
                            {!! $btnDelete !!}
                        </form>

                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</div>

{{-- Themed --}}
<x-adminlte-modal id="modalPurple" title="Agregar permiso" theme="purple" icon="fas fa-bolt" size='lg'
    disable-animations>
    <form action="{{ route('permisos.store') }}" method="post">
        @csrf
        {{-- With label, invalid feedback disabled, and form group class --}}
        <div class="row">
            <x-adminlte-input name="nombre" label="Nombre" placeholder="Ingrese el permiso" fgroup-class="col-md-6"
                disable-feedback />
        </div>
        <x-adminlte-button type="submit" class="btn-flat" type="submit" label="Submit" theme="success"
            icon="fas fa-lg fa-save" />
    </form>
</x-adminlte-modal>


@stop

@section('css')
{{-- Puedes agregar más estilos personalizados aquí --}}
@stop

@section('js')


<script>
    $(document).ready(function () {
        $('.formEliminar').submit(function (e) {
            e.preventDefault();
            var form = this; // Guardamos el contexto

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Vas a eliminar un registro, ¡no podrás recuperarlo!",
                icon: "warning", // El tipo correcto para advertencia es 'warning'
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Usamos la variable form
                }
            });
        });
    });
</script>
@stop