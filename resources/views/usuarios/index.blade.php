@extends('layouts.layout')
@section('title', 'Usuarios')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.usuario.create') }}">
                <i class="fas fa-plus-square"></i> Agregar Usuario
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-7 mb-3">
            <div class="card shadow-sm">
                <div class="card-header text-rosado"><i class="fas fa-list text-rosado"></i> <b>Lista de usuarios</b></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th>Nombre completo</th>
                                    <th>email</th>
                                    <th>Rol</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($usuarios as $usuario)
                                    <tr>

                                        <td>{{ $usuario->nombres }} {{ $usuario->apellidos }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>{{ $usuario->rol['rol'] }}</td>

                                        <td class="text-center">

                                            <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                href="{{ route('admin.usuario.show', $usuario->id) }}">
                                                <i class="fas fa-eye" style="pointer-events: none"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                href="{{ route('admin.usuario.edit', $usuario->id) }}">
                                                <i class="fas fa-edit" style="pointer-events: none"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
