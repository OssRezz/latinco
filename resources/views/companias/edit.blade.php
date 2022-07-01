@extends('layouts.layout')
@section('title', 'Compania')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.compania.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>

    <div class="col-12 col-lg-5 mb-3">
        <div class="card shadow-sm">
            <div class="card-header text-rosado"><i class="fas fa-pen-square text-rosado"></i> <b>Editar compañia</b>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.compania.update',$compania['id']) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$compania['id']}}">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="{{$compania['nombre']}}" />
                        <label for="profesor">Nombre <b class="text-rosado">*</b></label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="tipo_compania" id="" class="form-select">

                            @if ($compania->tipo_compania == 1)
                                <option value="1">Master</option>
                                <option value="2">Estandar</option>
                                    @else
                                <option value="2">Estandar</option>
                                <option value="1">Master</option>
                            @endif
                            
                            
                        </select>
                        <label for="profesor">Tipo de Compañía <b class="text-rosado">*</b></label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">Actualizar
                            compañía</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection