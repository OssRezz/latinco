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
                    <div class="spinner">
                        <div class="double-bounce1"></div>
                        <div class="double-bounce2"></div>
                    </div>
                    <div class="table-responsive" style="display: none;" id="tableDiv">
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
                            <tbody id="tableBody">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/incapacidad/incapacidades.js') }}"></script>
@endsection
