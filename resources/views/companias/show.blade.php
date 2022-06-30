@extends('layouts.layout')
@section('title', 'Co')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.compania.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-lg-7 mb-3">
            <div class="card shadow-sm">
                <div class="card-header text-rosado"><i class="fas fa-info-circle text-rosado"></i> <b>Información de la
                        Compañía</b></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $compania['id'] }}</td>

                                </tr>
                                <tr>
                                    <th>Compañía</th>
                                    <td>{{ $compania['nombre'] }}</td>
                                </tr>
                                <tr>
                                    <th>Tipo</th>
                                    <td>{{ $compania['tipo_compania'] }}</td>
                                </tr>
                                <tr>
                                    <th>Fecha de creación</th>
                                    <td>{{ date('j F, Y - h:m A', strtotime($compania['created_at'])) }}</td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @endsection
