@extends('layouts.layout')
@section('title', 'Soap Test')
@section('content')
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-md-12 col-lg-5 col-xl-4 col-xxl-3 border-end mb-3">
            <div class="card">
                <div class="card-header"><i class="fas fa-filter text-white"></i> <b class="text-white">Operaciones
                        soportadas</b>
                </div>
                <div class="card-body">
                    <div class="col mb-3">
                        <div class="col d-flex  align-items-center mx-3">
                            <button class="btn btn-outline-danger rounded-circle border-0 btn-lg px-2"
                                onclick="modalConexion()" id="btnConexion"><i class="fas fa-wifi fa-2x" id="conexionIcon"
                                    style="pointer-events: none;"></i></button>
                            <b class="mx-2">Probar conexion</b>
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="col d-flex  align-items-center mx-3">
                            <button class="btn btn-outline-danger rounded-circle border-0 btn-lg px-2"
                                onclick="modalConsulta()" id="consulta"><i class="fas fa-circle fa-2x text-latinco"
                                    id="consultaIcon" style="pointer-events: none;"></i></button>
                            <b class="mx-3">Probar consulta</b>
                        </div>
                    </div>
                    <div class="col">
                        <div class="col d-flex  align-items-center mx-3">
                            <button class="btn btn-outline-danger rounded-circle border-0 btn-lg px-2"
                                onclick="modalSchema()" id="consultaSchema"><i class="fas fa-circle fa-2x text-latinco"
                                    id="schemaIcon" style="pointer-events: none;"></i></button>
                            <b class="mx-3">Probar Schema</b>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12  col-lg-7 col-xl-8 col-xxl-9">
            <div class="card">
                <div class="card-header"><i class="far fa-comment-alt text-white"></i> <b class="text-white">Respuesta
                        peticion
                        soap</b></div>
                <div class="card-body" id="response"></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/soap/soap.js') }}"></script>

@endsection
