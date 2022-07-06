@extends('layouts.layout')
@section('title', 'Inicio')
@section('content')
    <div class="col d-flex justify-content-center">

    </div>

    <div class="row">
        <div class="col-12 col-md-4">
            <div class="card d-flex justify-content-center shadow-sm">
                <div class="card-header bg-latinco text-white text-center">
                     <h5><i class="fas fa-minus"></i> {{ $user->rol['rol']}} <i class="fas fa-minus"></i></h5> 
                </div>
                <div class="card-body d-flex justify-content-center">
                    <div class=" d-flex align-items-center justify-content-center border-latinco" style="width: 100px;height:100px">
                        <i class="fas fa-user-tie fa-5x mb-2 text-latinco"></i>
                        {{-- <i class="bi bi-person-bounding-box fa-5x"></i> --}}
                    </div>
                </div>
                <ul class="list-group list-group-flush text-center ">
                    <li class="list-group-item text-latinco">{{ $user['nombres'] }} {{ $user['apellidos'] }}</li>
                    <li class="list-group-item text-latinco">{{ $user['email'] }}</li>
                </ul>
            </div>
        </div>

    </div>

@endsection
