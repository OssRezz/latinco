@extends('layouts.layout')
@section('title', 'Conceptos')
@section('content')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.conceptos.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>

    <div class="col-12 col-lg-5 mb-3">
        <div class="card shadow-sm">
            <div class="card-header text-white fs-5">
                <i class="fas fa-dot-circle text-white"></i>
                Agregar concepto
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.conceptos.store') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Codigo" name="codigo"
                            value="{{ old('nombre', '') }}" />
                        <label for="profesor">Codigo <b class="text-latinco">*</b></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" placeholder="Descripcion" name="descripcion"
                            value="{{ old('codigo', '') }}" />
                        <label for="profesor">Descripcion <b class="text-latinco">*</b></label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="compania_id" id="" class="form-select">
                            <option value="">CONCEPTO HHL</option>
                        </select>
                        <label for="profesor">Naturaleza <b class="text-latinco">*</b></label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">
                            Agregar concepto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
