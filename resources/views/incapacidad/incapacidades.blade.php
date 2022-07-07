@extends('layouts.layout')
@section('title', 'Incapacidades')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white fs-5">
                    <i class="fas fa-list text-white"></i>
                    Lista incapacidades
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered nowrap table-hover table-sm" style="width:100%"
                            id="tablaIncapacidad">
                            <thead>
                                <tr class="bg-latinco">
                                    <th class="text-white fw-light"><b>Empleado</b></th>
                                    <th class="text-center text-white fw-light"><b>Cedula</b></th>
                                    <th class="text-center text-white fw-light"><b>EPS</b></th>
                                    <th class="text-center text-white fw-light"><b>Fecha Inicio</b></th>
                                    <th class="text-center text-white fw-light"><b>Fecha Fin</b></th>
                                    <th class="text-center text-white fw-light"><b>Total Dias</b></th>
                                    <th class="text-center text-white fw-light"><b>Prorroga</b></th>
                                    <th class="text-center text-white fw-light"><b>Observacion</b></th>
                                    <th class="text-center text-white fw-light"><b>Estado</b></th>
                                    <th class="text-center text-white fw-light"><b>Accion</b></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listaIncapacidades as $item)
                                    @php
                                        $fechaIncapacidad = new DateTime(date('Y-m-d', strtotime($item->fechaInicio)));
                                        $fechaActual = new DateTime(date('Y-m-d'));
                                        $intvl = $fechaActual->diff($fechaIncapacidad);
                                        $backgroundColor = '';
                                        if ($item->acumulado_prorroga >= 120) {
                                            $backgroundColor = 'bg-rojo';
                                        } elseif ($intvl->days < 90 && $item->estado_id == 1) {
                                            $backgroundColor = '';
                                        } elseif ($intvl->days < 120 && $item->estado_id == 1) {
                                            $backgroundColor = 'bg-amarillo';
                                        }
                                        
                                        if ($item->estado_id == 1) {
                                            $color = 'bg-latinco';
                                        } elseif ($item->estado_id == 4) {
                                            $color = 'bg-info';
                                        } elseif ($item->estado_id == 7) {
                                            $color = 'bg-success';
                                        } elseif ($item->estado_id == 8) {
                                            $color = 'bg-info';
                                        } elseif ($item->estado_id == 9) {
                                            $color = 'bg-info';
                                        } else {
                                            $color = 'bg-warning';
                                        }
                                    @endphp
                                    <tr class="<?php echo $backgroundColor; ?>">
                                        <td>{{ $item->nombre }}</td>
                                        <td class="text-center">{{ $item->cedula }}</td>
                                        <td class="text-center">{{ $item->eps }}</td>
                                        <td class="text-center">{{ $item->fechaInicio }}</td>
                                        <td class="text-center">{{ $item->fechaFin }}</td>
                                        <td class="text-center">{{ $item->totalDias }}</td>
                                        <td class="text-center">{{ $item->prorroga }}</td>
                                        <td class="text-center">
                                            <span
                                                class="badge bg-white text-dark border border-info border-2">{{ $item->observacion }}</span>
                                        </td>

                                        <td class="text-center">
                                            <span class="badge <?php echo $color; ?>">{{ $item->estado }}</span>
                                        </td>
                                        <td class="text-center">
                                            <?php if($item->transcrita == "No"){ ?>
                                            <button class="btn btn-danger btn-sm" value="{{ $item->id }}"
                                                onclick="modalTranscribir(this)">
                                                <i class="fas fa-dollar-sign"></i>
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
