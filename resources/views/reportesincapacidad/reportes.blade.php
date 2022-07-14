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
        <div class="col-12 col-xl-6 mb-4">
            <div class="card">
                <div class="card-body chart  d-flex justify-content-center">
                    <canvas id="myChart2"></canvas>
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
        <div class="col-12 col-lg-6 col-xl-6 mb-4">
            <div class="card">
                <div class="card-footer bg-white border border-bottom border-top-0"><i
                        class="fas fa-download text-latinco"></i> <b>Descargar reportes</b></div>
                <div class="card-body">
                    <form action="">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control">
                                    <label for="fecha">Fecha inicio<b class="text-danger">*</b></label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-3">
                                <div class="form-floating">
                                    <input type="date" class="form-control">
                                    <label for="fecha">Fecha fin<b class="text-danger">*</b></label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating">
                                    <select name="" id="" class="form-select">
                                        <option value="">asd</option>
                                        <option value="">asd</option>
                                    </select>
                                    <label for="">Reportes</label>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-danger">Descargar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-xl-6 mb-4">
            <div class="card">
                <div class="card-footer bg-white border border-bottom border-top-0"><i
                        class="fas fa-exclamation-triangle text-latinco"></i> <b>Alertas</b></div>
                <div class="card-body" style="height: 13.6em;">
                    <div class="row d-flex justify-content-center text-center mt-xl-4">
                        <div class="col border-end">
                            <h1><b>{{ $acumuladoTutelas }}</b></h1>
                            <h3>Tutelas</h3>
                            <br>
                            <div class="d-grid">
                                <button class="btn btn-warning" onclick="tutela(this);">Ver alerta</button>
                            </div>
                        </div>
                        <div class="col">
                            <h1>{{ $acumuladoProrrogas }}</h1>
                            <h3>Prorroga</h3>
                            <br>
                            <div class="d-grid">
                                <button class="btn btn-danger" onclick="prorroga(this);">Ver alerta</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('assets/js/incapacidad/reportes/reportes.js') }}"></script>

@endsection
