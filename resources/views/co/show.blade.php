@extends('layouts.layout')
@section('title', 'CO')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-danger" href="{{ route('admin.co.index') }}">
            <i class="fas fa-caret-square-left"></i> Atrás
        </a>
    </div>
</div>

<div class="row">

    <div class="col-12 col-lg-7 mb-3">
        <div class="card shadow-sm">
            <div class="card-header text-rosado"><i class="fas fa-info-circle text-rosado"></i> <b>Información del centro de operaciones</b></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <td>{{ $co['id'] }}</td>

                            </tr>
                            <tr>
                                <th>Centro de operaciones</th>
                                <td>{{ $co['nombre'] }}</td>
                            </tr>
                            <tr>
                                <th>Código</th>
                                <td>{{ $co['codigo'] }}</td>
                            </tr>
                            <tr>
                                <th>Compañia</th>
                                <td>{{ $co->compania['nombre'] }}</td>
                            </tr>
                            <tr>
                                <th>Fecha de creación</th>
                                <td>{{ date('j F, Y - h:m A', strtotime($co['created_at'])) }}</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
