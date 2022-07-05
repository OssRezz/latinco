@extends('layouts.layout')
@section('title', 'Incapacidades')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><i class="fas fa-list text-vinotinto"></i> <b>Lista incapacidades</b></div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover table-sm" style="width:100%"
                            id="tablaIncapacidad">
                            <thead>
                                <tr>
                                    <th class="bg-info text-white"><b>Empleado</b></th>
                                    <th class="text-center bg-info text-white"><b>Cedula</b></th>
                                    <th class="text-center bg-info text-white"><b>Fecha Inicio</b></th>
                                    <th class="text-center bg-info text-white"><b>Fecha Fin</b></th>
                                    <th class="text-center bg-info text-white"><b>Total Dias</b></th>
                                    <th class="text-center bg-info text-white"><b>Prorroga</b></th>
                                    <th class="text-center bg-info text-white"><b>Observacion</b></th>
                                    <th class="text-center bg-info text-white"><b>Estado</b></th>
                                    <th class="text-center bg-info text-white"><b>Accion</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listaIncapacidades as $item)
                                    @php
                                        $fechaIncapacidad = new DateTime(date('Y-m-d', strtotime($item->fechaInicio)));
                                        $fechaActual = new DateTime(date('Y-m-d'));
                                        $intvl = $fechaActual->diff($fechaIncapacidad);
                                        if ($intvl->days < 90 && $item->estado_id == 1) {
                                            $backgroundColor = '';
                                            $textColor = '';
                                        } elseif ($intvl->days < 120 && $item->estado_id == 1) {
                                            $backgroundColor = 'bg-warning';
                                            $textColor = 'text-white';
                                        } else {
                                            $backgroundColor = 'bg-danger';
                                            $textColor = 'text-white';
                                        }
                                        
                                    @endphp
                                    <tr class="<?php echo $backgroundColor; ?> <?php echo $textColor; ?> ">
                                        <td>{{ $item->nombre }}</td>
                                        <td class="text-center">{{ $item->cedula }}</td>
                                        <td class="text-center">{{ $item->fechaInicio }}</td>
                                        <td class="text-center">{{ $item->fechaFin }}</td>
                                        <td class="text-center">{{ $item->totalDias }}</td>
                                        <td class="text-center">{{ $item->prorroga }}</td>
                                        <td class="text-center">
                                            <span
                                                class="badge bg-white text-dark border border-info">{{ $item->observacion }}</span>
                                        </td>

                                        <td class="text-center">
                                            <span
                                                class="badge bg-white text-dark border border-info">{{ $item->estado }}</span>
                                        </td>
                                        <td class="text-center">
                                            <?php if($item->transcrita == "No"){ ?>
                                            <button class="btn btn-danger btn-sm" value="{{ $item->id }}"
                                                onclick="modalTranscribir(this)">
                                                <i class="fas fa-h-square"></i>
                                            </button>
                                            <?php } ?>
                                            <button class="btn btn-danger btn-sm" hidden>
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm" value="{{ $item->id }}"
                                                onclick="modalEditar(this)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-danger btn-sm" value="{{ $item->id }}"
                                                onclick="elimiarIncapacidad(this)">
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
        </div>
    </div>
    <script src="{{ asset('assets/js/incapacidad/tableIncapacidad.js') }}"></script>
    <script src="{{ asset('assets/js/incapacidad/incapacidades.js') }}"></script>
@endsection
