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
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 8em;">
                    <div class="col">
                        <i class="fas fa-coins fa-3x text-latinco"></i>
                    </div>
                    <div class="col">
                        <div class="col-12 text-end">
                            <h3><b>{{ number_format($totalRecuperado) }}</b></h3>
                        </div>
                        <div class="col-12 text-end">
                            <small><b class="text-latinco">Dinero recuperado</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-lg-6 col-xl-6 col-xxl-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 8em;">
                    <div class="col">
                        <i class="fas fa-coins fa-3x text-latinco"></i>
                    </div>
                    <div class="col">
                        <div class="col-12 text-end">
                            <h3><b>{{ number_format($totalPorRecuperar) }}</b></h3>
                        </div>
                        <div class="col-12 text-end">
                            <small><b class="text-latinco">Total por recuperar</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-lg-6 col-xl-6 col-xxl-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 8em;">
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
                            <small><b class="text-latinco">Total recuperado EPS</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-lg-6 col-xl-6 col-xxl-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center justify-content-center" style="height: 8em;">
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
                            <small><b class="text-latinco">Total recuperado ARL</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div class="card shadow-sm">
                <div class="card-body chart  d-flex justify-content-center">
                    <canvas id="myChart2" height="400px"></canvas>
                </div>
                <div class="card-footer bg-white"><b>Dinero recuperado y por recuperar</b></div>
            </div>
        </div>
        <div class="col-12 col-xl-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body chart d-flex justify-content-center">
                    <canvas id="myChart" class="d-flex justify-content-center"></canvas>
                </div>
                <div class="card-footer bg-white"><b>Valor a recuperar por entidad</b> </div>
            </div>
        </div>

        <div class="col-12 col-xl-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body chart d-flex justify-content-center">
                    <canvas id="chartCo" class="d-flex justify-content-center"></canvas>
                </div>
                <div class="card-footer bg-white"><b>Incapacidades por centro de operaciones</b> </div>
            </div>
        </div>
        <div class="col-12  col-xl-4 mb-4">
            <div class="card bg-secondary text-white shadow-sm">
                <a onclick="tutela(this);">
                    <div class="card-body">
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col d-flex justify-content-center">
                                <i class="fas fa-gavel fa-3x"></i>
                            </div>
                            <div class="col ">
                                <div class="col-12 text-center py-0">
                                    <h3 class="my-0"><b>{{ $acumuladoTutelas }}</b></h3>
                                </div>
                                <div class="col-12 text-center py-0">
                                    <small>Tutelas</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12  col-xl-4 mb-4">
            <div class="card bg-secondary text-white shadow-sm">
                <a onclick="prorroga(this);">
                    <div class="card-body">
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col d-flex justify-content-center">
                                <i class="fas fa-envelope-open-text fa-3x"></i>
                            </div>
                            <div class="col ">
                                <div class="col-12 text-center py-0">
                                    <h3 class="my-0"><b>{{ $acumuladoProrrogas }}</b></h3>
                                </div>
                                <div class="col-12 text-center py-0">
                                    <small>Prorrogas</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-12  col-xl-4 mb-4">
            <div class="card bg-secondary text-white shadow-sm">
                <a onclick="prorroga(this);">
                    <div class="card-body">
                        <div class="row d-flex align-items-center justify-content-center">
                            <div class="col d-flex justify-content-center">
                                <i class="fas fa-money-check-alt fa-3x"></i>
                            </div>
                            <div class="col ">
                                <div class="col-12 text-center py-0">
                                    <h3 class="my-0"><b>{{ $acumuladoProrrogas }}</b></h3>
                                </div>
                                <div class="col-12 text-center py-0">
                                    <small>Fondo de pensiones</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <script src="{{ asset('assets/js/incapacidad/reportes/reportes.js') }}"></script>

@endsection
