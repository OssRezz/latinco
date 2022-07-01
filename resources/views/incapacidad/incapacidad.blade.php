@extends('layouts.layout')
@section('title', 'Incapacidades')
@section('content')
    <div class="row d-flex align-items-center justify-content-center mb-4">
        <div class="col-12 col-lg-2 m-5 ">
            <div class="col d-flex  justify-content-center">
                <img src="{{ asset('assets/images/trabajador.png') }}" alt=""
                    class="bg-white rounded-pill mb-1 shadow-sm" height="230px">
            </div>
            <div class="col d-flex  justify-content-center">
                <span class="badge bg-dark" id="cargo"></span>
            </div>
        </div>
        <div class="col px-4">
            <div class="card border-0 bg-light">
                <div class="card-body bg-light">
                    <div class="row d-flex justify-content-start">
                        <div class="col-12 col-lg-6">
                            <ul class="list-group list-group-flush bg-light">
                                <li class="list-group-item  bg-light d-flex justify-content-start">
                                    <b class="text-vinotinto">Nombre: </b>
                                    <div id="nombre" class="mx-1"></div>
                                </li>
                                <li class="list-group-item  bg-light d-flex justify-content-start">
                                    <b class="text-vinotinto">Empresa: </b>
                                    <div id="empresa" class="mx-1"></div>
                                </li>
                                <li class="list-group-item  bg-light d-flex justify-content-start">
                                    <b class="text-vinotinto">Centro Operacion: </b>
                                    <div id="centroOperacion" class="mx-1"></div>
                                </li>
                                <li class="list-group-item  bg-light d-flex justify-content-start border-bottom">
                                    <b class="text-vinotinto">Eps: </b>
                                    <div id="eps" class="mx-1"></div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-6">
                            <ul class="list-group list-group-flush bg-light d-flex justify-content-start">
                                <li class="list-group-item  bg-light d-flex justify-content-start">
                                    <b class="text-vinotinto">Cedula: </b>
                                    <div id="cedula" class="mx-1"></div>

                                </li>
                                <li class="list-group-item  bg-light d-flex justify-content-start">
                                    <b class="text-vinotinto">Fecha ingreso: </b>
                                    <div id="fecha" class="mx-1"></div>
                                </li>
                                <li class="list-group-item  bg-light d-flex justify-content-start">
                                    <b class="text-vinotinto">ID Co: </b>
                                    <div id="co" class="mx-1"></div>
                                </li>
                                <li class="list-group-item  bg-light d-flex justify-content-start border-bottom">
                                    <b class="text-vinotinto">Salario: </b>
                                    <div id="salario" class="mx-1"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col">
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <form id="frm-incapacidad">
                            <div class="row g-3">
                                <div class="col-12 col-lg-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" placeholder="Cedula" name="cedula"
                                            id="cedulaInput">
                                        <label for="">Cedula <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-floating">
                                        <select name="tipoIncapacidad" class="form-select">
                                            @foreach ($listaTipoIncapacidad as $item)
                                                <option value="{{ $item->id }}">{{ $item->tipo }}</option>
                                            @endforeach
                                        </select>
                                        <label for="">Tipo de incapacidad <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-floating">
                                        <select name="medios" class="form-select">
                                            <option value="Eps" selected>Eps</option>
                                            <option value="Sura">Sura</option>
                                            <option value="Paterniad/Maternidad">Paterniad/Maternidad</option>
                                        </select>
                                        <label for="">Medios <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-floating">
                                        <select name="prorroga" class="form-select">
                                            <option value="No" selected>No</option>
                                            <option value="Si">Si</option>
                                        </select>
                                        <label for="">Prorroga <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-floating">
                                        <input type="date" id="fechaInicio" name="fechaInicio" class="form-control">
                                        <label for="">Fecha de inicio <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-floating">
                                        <input type="date" id="fechaFinal" name="fechaFinal" class="form-control">
                                        <label for="">Fecha final <b class="text-danger">*</b></label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-4 ">
                                    <ul class="list-group list-group-flush ">
                                        <li class="list-group-item d-flex justify-content-center bg-light">
                                            <b class="text-vinotinto">Total dias:</b>
                                            <span class="badge bg-dark mx-1 d-flex align-items-center"
                                                id="totalDias">N/A</span>
                                            {{-- <div class="mx-1" id="totalDias">0</div> --}}
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-12 col-lg-4 ">
                                    <ul class="list-group list-group-flush ">
                                        <li class="list-group-item d-flex justify-content-center bg-light">
                                            <b class="text-vinotinto">Dias empresa:</b>
                                            <span class="badge bg-dark mx-1 d-flex align-items-center"
                                                id="diasEmpresa">N/A</span>

                                            {{-- <div class="mx-1" id="diasEmpresa">0</div> --}}
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-12 col-lg-4 mb-3">
                                    <ul class="list-group list-group-flush ">
                                        <li class="list-group-item d-flex justify-content-center bg-light">
                                            <b class="text-vinotinto">Dias eps:</b>
                                            <span class="badge bg-dark mx-1 d-flex align-items-center"
                                                id="diasEps">N/A</span>

                                            {{-- <div class="mx-1" id="diasEps">0</div> --}}
                                        </li>
                                    </ul>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-danger" disabled id="btn-ingresar-incapacidad">Ingresar
                                        incapacidad</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/incapacidad/incapacidad.js') }}"></script>
@endsection
