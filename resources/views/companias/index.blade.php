@extends('layouts.layout')
@section('title', 'Companía')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.compania.create') }}">
                <i class="fas fa-plus-square"></i> Agregar compañía
            </a>
        </div>
    </div>

    <div class="row">

        <div class="col-12 col-lg-7 mb-3">
            <div class="card shadow-sm">
                <div class="card-header text-white fs-5">
                    <i class="fas fa-list text-white"></i> 
                    Lista de compañías
                </div>
                <div class="card-body">
                    @if ($companias->isEmpty())
                        <p class="text-center">No hay compañias registradas actualmente. </p>
                    @else
                        <div class="table-responsive">


                            <table class="table table-bordered nowrap table-hover" style="width: 100%" id="tablaClase">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Compañía</th>
                                        <th>Tipo</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($companias as $compania)
                                        <tr>
                                            <td>{{ $compania->id }}</td>
                                            <td>{{ $compania->nombre }}</td>
                                            <td>
                                                @if ($compania->tipo_compania == 1)
                                                    Master
                                                @else
                                                    Estandar
                                                @endif
                                            </td>
                                            <td class="text-center">

                                                <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                    href="{{ route('admin.compania.show', $compania->id) }}">
                                                    <i class="fas fa-eye" style="pointer-events: none"></i>
                                                </a>
                                                <a class="btn btn-outline-danger btn-table border-0 btn-sm"
                                                    href="{{ route('admin.compania.edit', $compania->id) }}">
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
