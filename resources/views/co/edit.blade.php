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
                <i class="fas fa-pen-square text-white"></i> 
                Editar Centro de operaciones
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.co.update', $co['id']) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $co['id'] }}">

                    
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Nombre" name="nombre"
                            value="{{ $co['nombre'] }}" />
                        <label for="profesor">Nombre <b class="text-rosado">*</b></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Código" name="codigo"
                            value="{{ $co['codigo'] }}" />
                        <label for="profesor">Código <b class="text-rosado">*</b></label>
                    </div>


                    <div class="form-floating mb-3">
                        <select name="compania_id" id="" class="form-select">
                            <option value="{{ $co['compania_id'] }}">{{ $co->compania['nombre'] }}</option>

                            @foreach ($companias as $compania)
                                @if($compania['id'] != $co['compania_id'])
                                <option value="{{ $compania['id'] }}">{{ $compania['nombre'] }}</option>
                                @endif
                            @endforeach

                        </select>
                        <label for="profesor">Compañía <b class="text-rosado">*</b></label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">Actualizar
                            Centro de operaciones</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
