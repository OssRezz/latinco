@extends('layouts.layout')
@section('title', 'CO')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.co.create') }}">
                <i class="fas fa-plus-square"></i> Agregar centro de operaciones
            </a>
        </div>
    </div>

    <div class="row">



        <div class="col-12 col-lg-7 mb-3">
            <div class="card shadow-sm">
                <div class="card-header text-rosado"><i class="fas fa-list text-rosado"></i> <b>Lista de centro de
                        operaciones</b></div>
                <div class="card-body">
                    @if ($cos->isEmpty())
                        <p class="text-center">No hay operaciones registradas actualmente. </p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>centro de operaciones</th>
                                        <th>Código</th>
                                        <th>Compañia</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($cos as $co)
                                        <tr>
                                            <td>{{ $co->id }}</td>
                                            <td>{{ $co->nombre }}</td>
                                            <td>{{ $co->codigo }}</td>
                                            <td>{{ $co->compania->nombre }}</td>
                                            <td class="text-center">

                                                <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                    href="{{ route('admin.co.show', $co->id) }}">
                                                    <i class="fas fa-eye" style="pointer-events: none"></i>
                                                </a>
                                                <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                    href="{{ route('admin.co.edit', $co->id) }}">
                                                    <i class="fas fa-edit" style="pointer-events: none"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
