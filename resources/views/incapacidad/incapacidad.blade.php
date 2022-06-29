@extends('layouts.layout')
@section('title', 'Incapacidad')
@section('content')
    <div class="row">
        <div class="row d-flex align-items-center mb-4">
            <div class="col-12 col-lg-4 d-flex justify-content-center">
                <div class="">
                    <img src="{{ asset('assets/images/trabajador.png') }}" alt="" class="mb-1" height="300px">
                    <br>
                    <div class="text-center">
                        <h5 class="text-vinotinto"><em><b>Operador puente grua B</b></em></h5>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 bg-light">
                    <div class="card-body bg-light">
                        <div class="row d-flex justify-content-start">
                            <div class="col-12 col-lg-6">
                                <ul class="list-group list-group-flush bg-light">
                                    <li class="list-group-item  bg-light d-flex justify-content-start">
                                        <b class="text-vinotinto">Nombre: </b>
                                        <div id="nombre" class="mx-1">ORREGO POSADA DIANA MARCELA</div>
                                    </li>
                                    <li class="list-group-item  bg-light d-flex justify-content-start">
                                        <b class="text-vinotinto">Empresa: </b>
                                        <div id="empresa" class="mx-1">LATINCO</div>
                                    </li>
                                    <li class="list-group-item  bg-light d-flex justify-content-start">
                                        <b class="text-vinotinto">Centro Operacion: </b>
                                        <div id="centroOperacion" class="mx-1">OFICINA CENTRAL</div>
                                    </li>
                                    <li class="list-group-item  bg-light d-flex justify-content-start">
                                        <b class="text-vinotinto">Eps: </b>
                                        <div id="eps" class="mx-1">SURA</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12 col-lg-5">
                                <ul class="list-group list-group-flush bg-light d-flex justify-content-start">
                                    <li class="list-group-item  bg-light d-flex justify-content-start">
                                        <b class="text-vinotinto">Cedula: </b>
                                        <div id="cedula" class="mx-1">1039446594</div>

                                    </li>
                                    <li class="list-group-item  bg-light d-flex justify-content-start">
                                        <b class="text-vinotinto">Fecha ingreso: </b>
                                        <div id="fecha" class="mx-1">31/12/1899</div>
                                    </li>
                                    <li class="list-group-item  bg-light d-flex justify-content-start">
                                        <b class="text-vinotinto">ID Co: </b>
                                        <div id="co" class="mx-1">001</div>
                                    </li>
                                    <li class="list-group-item  bg-light d-flex justify-content-start">
                                        <b class="text-vinotinto">Salario: </b>
                                        <div id="salario" class="mx-1">1000000</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-11">
                <div class="card bg-light border-0">
                    <div class="card-body">
                        <form action="">
                            <div class="row g-3">
                                <div class="col-12 col-lg-6">
                                    <div class="form-floating">
                                        <input type="number" class="form-control" placeholder="Cedula">
                                        <label for="">Cedula</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-floating">
                                        <select name="" id="" class="form-select">
                                            <option value="">Enfermedad general</option>
                                            <option value="">Accidente de trabajo</option>
                                            <option value="">Maternidad</option>
                                            <option value="">Paternidad</option>
                                        </select>
                                        <label for="">Tipo de incapacidad</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select name="" id="" class="form-select">
                                            <option value="">Si</option>
                                            <option value="">No</option>
                                        </select>
                                        <label for="">Prorroga</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="form-floating">
                                        <input type="date" id="fechaInicio" class="form-control">
                                        <label for="">Fecha de inicio</label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-floating">
                                        <input type="date" id="fechaFinal" class="form-control">
                                        <label for="">Fecha final</label>
                                    </div>
                                </div>
                                {{-- <div class="col-12 col-lg-6">
                                    <div class="form-floating">
                                        <input type="number" id="TotalDias" class="form-control">
                                        <label for="">Total de dias</label>
                                    </div>
                                </div> --}}

                                <div class="col-12 col-lg-4 ">
                                    <ul class="list-group list-group-flush ">
                                        <li class="list-group-item d-flex justify-content-center bg-light">
                                            <b class="text-vinotinto">Total dias:</b>
                                            <span class="badge bg-dark mx-1 d-flex align-items-center" id="totalDias">N/A</span>
                                            {{-- <div class="mx-1" id="totalDias">0</div> --}}
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-12 col-lg-4 ">
                                    <ul class="list-group list-group-flush ">
                                        <li class="list-group-item d-flex justify-content-center bg-light">
                                            <b class="text-vinotinto">Dias empresa:</b>
                                            <span class="badge bg-dark mx-1 d-flex align-items-center" id="diasEmpresa">N/A</span>

                                            {{-- <div class="mx-1" id="diasEmpresa">0</div> --}}
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-12 col-lg-4 mb-3">
                                    <ul class="list-group list-group-flush ">
                                        <li class="list-group-item d-flex justify-content-center bg-light">
                                            <b class="text-vinotinto">Dias eps:</b>
                                            <span class="badge bg-dark mx-1 d-flex align-items-center" id="diasEps">N/A</span>

                                            {{-- <div class="mx-1" id="diasEps">0</div> --}}
                                        </li>
                                    </ul>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-danger">Ingresar incapacidad</button>
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
