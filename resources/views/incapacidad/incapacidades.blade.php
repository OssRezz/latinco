@extends('layouts.layout')
@section('title', 'Plantilla')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered nowrap table-hover table-sm" style="width:100%" id="tablaIncapacidad">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th class="text-center">Cedula</th>
                            <th class="text-center">Fecha Inico</th>
                            <th class="text-center">Fecha Fin</th>
                            <th class="text-center">Total Dias</th>
                            <th class="text-center">Observacion</th>
                            <th class="text-center">Transcrita</th>
                            <th class="text-center">Estado</th>
                            <th class="text-center">Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listaIncapacidades as $item)
                            <tr>
                                <td>{{ $item->nombre }}</td>
                                <td class="text-center">{{ $item->cedula }}</td>
                                <td class="text-center">{{ $item->fechaInicio }}</td>
                                <td class="text-center">{{ $item->fechaFin }}</td>
                                <td class="text-center">{{ $item->totalDias }}</td>
                                <td class="text-center">
                                    <?php
                                    if ($item->observacion === 1) {
                                        $observacion = 'Radicada';
                                    }
                                    ?>
                                    <span class="badge bg-dark">{{ $observacion }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-dark">{{ $item->transcrita }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-dark">{{ $item->estado }}</span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-h-square"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/incapacidad/tableIncapacidad.js') }}"></script>
@endsection
