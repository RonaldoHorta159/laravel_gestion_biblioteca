@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Administtracion de Usuarios</h1>
@stop

@section('content')
<p></p>
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
                'Email',
                ['label' => 'Rol', 'no-export' => true, 'width' => 10],
                ['label' => 'Acciones', 'no-export' => true, 'width' => 10],
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
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge badge-primary">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td><a href="{{ route('asignar.edit', $user) }}" class="btn btn-xs btn-default text-primary mx-1 shadow"
                            title="Edit">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </a>
                        <form style="display: inline;" action="{{ route('asignar.destroy', $user) }}" method="post"
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