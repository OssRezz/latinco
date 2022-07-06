@extends('layouts.layout')
@section('title', 'Usuario')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.usuario.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-lg-7 mb-3">
            <div class="card shadow-sm">
                <div class="card-header text-white fs-5">
                    <i class="fas fa-info-circle text-white "></i> 
                    Información del usuario
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover text-latinco" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th>Nombre completo</th>
                                    <td>{{ $usuario['nombres'] }} {{ $usuario['apellidos'] }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $usuario['email'] }}</td>
                                </tr>
                                <tr>
                                    <th>Rol</th>
                                    <td>{{ $usuario->rol['rol'] }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de creación</th>
                                    <td>{{ date('j F, Y - h:m A', strtotime($usuario['created_at'])) }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
