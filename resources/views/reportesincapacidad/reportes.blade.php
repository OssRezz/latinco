@extends('layouts.layout')
@section('title', 'Reportes')
@section('content')
    <div class="row d-flex justify-content-around">
        <div class="col-12 col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-header text-white">Entidad que mas debe</div>
                <div class="card-body text-center">
                    <h1><b>$102,000,000</b></h1>
                    <br>
                    <h3>Sura</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-header text-white">Entidad mas recaudada</div>
                <div class="card-body text-center">
                    <h1><b>$102,000,000</b></h1>
                    <br>
                    <h3>Colsanitas</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-header text-white">Entidad con mayor incapacidad</div>
                <div class="card-body text-center">
                    <h1><b>Coomeva</b></h1>
                    <br>
                    <h3 class="text-white">EPS</h3>
                </div>
            </div>
        </div>
    </div>
@endsection
