@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>VISTA DE TODOS LOS RECURSOS</h1>
@stop

@section('content')
<p>Lista de todos los RECURSOS</p>

{{-- Setup data for datatables --}}
<div class="card">
    @Can('Crear recurso')
        <div class="card-head">
            <button class="btn btn-primary float-right mt-2 mr-2" data-bs-toggle="modal"
                data-bs-target="#ModalRecurso">Agregar Recurso</button>
        </div>
    @endcan
    <div class="card-body">
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
            @php
                $heads = [
                    'ID',
                    'Nombre',
                    ['label' => 'Estado', 'width' => 40],
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
                @foreach($recursos as $recurso)
                    <tr>
                        <td>{{ $recurso->id }}</td>
                        <td>{{ $recurso->nombre }}</td>
                        <td>
                            <span>
                                {{ $recurso->estado == 1 ? 'Activo' : 'Reservado' }}
                            </span>
                        </td>
                        <td><a href="{{ route('recurso.edit', $recurso) }}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                            @Can('Eliminar recurso')
                                <form style="display: inline;" action="{{ route('recurso.destroy', $recurso) }}" method="post"
                                    class="formEliminar">
                                    @csrf
                                    @method('delete')
                                    {!! $btnDelete !!}
                                </form>
                            @endcan


                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>

    </div>

    <!-- The Modal -->
    <div class="modal" id="ModalRecurso">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <form action="{{ route('recurso.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="modal-header" style="background-color: blueviolet;">
                            <h4 class="modal-title">Agregar Recurso</h4>
                            <button type="button" class="fa fa-window-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="box-body">
                                {{-- With prepend slot --}}
                                <x-adminlte-input type="string" name="nombre" label="Nombre del recurso"
                                    placeholder="Ingrese el nombre del recurso" label-class="text-lightblue"
                                    value="{{ old('nombre') }}">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text">
                                            <i class="fas fa-passport text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                {{-- With prepend slot, lg size, and label --}}
                                <x-adminlte-select name="TipoRecurso" label="Elija el tipo de recurso"
                                    label-class="text-lightblue">
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
                                <x-adminlte-textarea name="descripcion" label="Descripcion" rows=5
                                    label-class="text-lightblue" igroup-size="sm" placeholder="Ingrese la descripcion">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-dark">
                                            <i class="fas fa-lg fa-file-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-textarea>
                                {{-- With prepend slot, lg size, and label --}}
                                <x-adminlte-select name="Formato" label="Elija el formato de recurso"
                                    label-class="text-lightblue">
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
                                <x-adminlte-textarea name="Ubicacion" label="Ubicacion" rows=5
                                    label-class="text-lightblue" igroup-size="sm"
                                    placeholder="Ingrese la Ubicacion del recurso">
                                    <x-slot name="prependSlot">
                                        <div class="input-group-text bg-dark">
                                            <i class="fas fa-map-marker-alt text-lightblue"></i>
                                        </div>
                                    </x-slot>
                                </x-adminlte-textarea>
                                {{-- With prepend slot --}}
                                <x-adminlte-input type="date" name="fechapublicacion"
                                    label="Fecha de publicacion del recurso"
                                    placeholder="Ingrese la fecha de publicacion del recurso"
                                    label-class="text-lightblue" value="{{ old('fechapublicacion') }}">
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
                                <button type="button" class="btn btn-danger" style="margin-left: 290px;"
                                    data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>


                </form>


            </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    @stop