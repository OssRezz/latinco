@extends('layouts.layout')
@section('cdn')
    {{-- chat-js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
@endsection
@section('title', 'Reportes')
@section('content')
    <div class="row d-flex justify-content-around">
        <div class="col-12  col-lg-6 col-xl-6 col-xxl-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-center px-4" style="height: 7em;">
                    <div class="col">
                        <i class="fas fa-coins fa-3x text-latinco"></i>
                    </div>
                    <div class="col">
                        <div class="col-12 text-end">
                            <h3><b>{{ number_format($totalRecuperado) }}</b></h3>
                        </div>
                        <div class="col-12 text-end">
                            <small><b>Dinero recuperado</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-lg-6 col-xl-6 col-xxl-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-center px-4" style="height: 7em;">
                    <div class="col">
                        <i class="fas fa-coins fa-3x text-latinco"></i>
                    </div>
                    <div class="col">
                        <div class="col-12 text-end">
                            <h3><b>{{ number_format($totalPorRecuperar) }}</b></h3>
                        </div>
                        <div class="col-12 text-end">
                            <small><b>Total por recuperar</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-lg-6 col-xl-6 col-xxl-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-center px-4" style="height: 7em;">
                    <div class="col">
                        <i class="fas fa-medkit fa-3x text-latinco"></i>
                    </div>
                    <div class="col">
                        <div class="col-12 text-end">
                            <h3><b>
                                    {{ number_format($recuperadoPorEPS[0]['total']) ? number_format($recuperadoPorEPS[0]['total']) : 0 }}</b>
                            </h3>
                        </div>
                        <div class="col-12 text-end">
                            <small><b>Total recuperado EPS</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-lg-6 col-xl-6 col-xxl-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-center px-4" style="height: 7em;">
                    <div class="col">
                        <i class="fas fa-shield-alt fa-3x text-latinco"></i>
                    </div>
                    <div class="col">
                        <div class="col-12 text-end">
                            <h3><b>
                                    {{ number_format($totalPorRecuperadoARL[0]['total']) ? number_format($totalPorRecuperadoARL[0]['total']) : 0 }}</b>
                            </h3>
                        </div>
                        <div class="col-12 text-end">
                            <small><b>Total recuperado ARL</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-xl-4 mb-4">
            <div class="card hand  shadow-sm">
                <a onclick="tutela(this);">
                    <div class="card-body  d-flex align-items-center justify-content-around" style="height: 7em;">
                        <div class="col d-flex justify-content-center">
                            <i class="fas fa-gavel fa-3x text-latinco"></i>
                        </div>
                        <div class="col ">
                            <div class="col-12 text-center py-0">
                                <h3 class="my-0"><b>{{ $acumuladoTutelas }}</b></h3>
                            </div>
                            <div class="col-12 text-center py-0">
                                <small><b>Tutelas</b> </small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 col-xl-4 mb-4">
            <div class="card hand shadow-sm">
                <a onclick="prorroga(this);">
                    <div class="card-body d-flex align-items-center justify-content-around" style="height: 7em;">
                        <div class="col text-center">
                            <i class="fas fa-envelope-open-text fa-3x text-latinco"></i>
                        </div>
                        <div class="col text-center">
                            <div class="col-12 text-center py-0">
                                <h3 class="my-0"><b>{{ $acumuladoProrrogas }}</b></h3>
                            </div>
                            <div class="col-12 text-center py-0">
                                <small><b>Prorrogas</b> </small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12  col-xl-4 mb-4">
            <div class="card hand  shadow-sm">
                <a onclick="pensiones(this);">
                    <div class="card-body  d-flex align-items-center justify-content-around" style="height: 7em;">
                        <div class="col d-flex justify-content-center">
                            <i class="fas fa-money-check-alt fa-3x text-latinco"></i>
                        </div>
                        <div class="col ">
                            <div class="col-12 text-center py-0">
                                <h3 class="my-0"><b>{{ $acumuladoPensiones }}</b></h3>
                            </div>
                            <div class="col-12 text-center py-0">
                                <small><b>Fondo de pensiones</b></small>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body chart  d-flex justify-content-center">
                    <canvas id="myChart2" class="d-flex justify-content-center"></canvas>
                </div>
                <div class="card-footer bg-light"><i class="fa-solid fa-chart-line text-latinco"></i> <b> Dinero recuperado
                        y por recuperar</b></div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body chart d-flex justify-content-center">
                    <canvas id="myChart" class="d-flex justify-content-center"></canvas>
                </div>
                <div class="card-footer bg-light"><i class="fa-solid fa-flag-checkered text-latinco"></i><b> Valor a
                        recuperar
                        por entidad</b> </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body chart d-flex justify-content-center">
                    <canvas id="chartCo" class="d-flex justify-content-center"></canvas>
                </div>
                <div class="card-footer bg-light"><i class="fa-solid fa-flag-checkered text-latinco"></i> <b> Incapacidades
                        por
                        centro de operaciones</b> </div>
            </div>
        </div>

        <div class="col-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-footer bg-light border-bottom">
                    <i class="fa-solid fa-file-excel text-latinco"></i> <b> Descargar reportes</b>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/reportesincapacidad/export') }}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="form-floating">
                                    <input type="date" name="fechaInicio" id="fechaInicio" class="form-control"
                                        placeholder="fecha de inicio">
                                    <label for="">Fecha Inicio</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-floating">
                                    <input type="date" name="fechaFin" id="fechaFin" class="form-control"
                                        placeholder="fecha de inicio">
                                    <label for="">Fecha Inicio</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3">
                                <div class="form-floating">
                                    <select name="compania" id="reporteSelect" class="form-select">
                                        <option value="" disabled selected>Seleccione una opcion</option>
                                        @foreach ($compania as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
                                    </select>
                                    <label for="">Compañía</label>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 d-flex align-items-center">
                                <div class="col">
                                    <div class="d-grid">
                                        <button class="btn btn-danger" id="btn-descargar">Descargar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('assets/js/incapacidad/reportes/reportes.js') }}"></script>

@endsection
