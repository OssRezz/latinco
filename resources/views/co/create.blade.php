@extends('layouts.layout')
@section('title', 'CO')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-danger" href="{{ route('admin.co.index') }}">
            <i class="fas fa-caret-square-left"></i> Atrás
        </a>
    </div>
</div>

<div class="col-12 col-lg-5 mb-3">
    <div class="card shadow-sm">
        <div class="card-header text-white fs-5">
            <i class="fas fa-dot-circle text-white"></i>
            Agregar centro de operaciones
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.co.store') }}">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Nombre" name="nombre"  value="{{ old('nombre', '')}}" />
                    <label for="profesor">Nombre <b class="text-latinco">*</b></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Código" name="codigo"  value="{{ old('codigo', '')}}" />
                    <label for="profesor">Código <b class="text-latinco">*</b></label>
                </div>
                <div class="form-floating mb-3">
                    <select name="compania_id" id="" class="form-select">

                        
                        @foreach($companias as $compania)
                                <option value="{{$compania->id}}">{{$compania->nombre}}</option>
                        @endforeach
                    </select>
                    <label for="profesor">Compañía <b class="text-latinco">*</b></label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">
                        Agregar CO
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
