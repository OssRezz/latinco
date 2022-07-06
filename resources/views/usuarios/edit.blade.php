@extends('layouts.layout')
@section('title', 'Usuario')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-danger" href="{{ route('admin.usuario.index') }}">
            <i class="fas fa-caret-square-left"></i> Atrás
        </a>
    </div>
</div>

<div class="col-12 col-lg-5 mb-3">
    <div class="card shadow-sm">
        <div class="card-header text-white fs-5">
            <i class="fas fa-user-edit"></i> 
            Editar información de usuario
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.usuario.update', $usuario['id']) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $usuario['id'] }}">

                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="state" id="state"  checked>
                    <label class="form-check-label" for="state">Estado</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Nombres" name="nombres"  value="{{ $usuario['nombres'] }}" {{ $errors->has('nombres') ? 'is-invalid' : '' }} />
                    <label>Nombres <b class="text-latinco">*</b></label>
                    @if ($errors->has('nombres'))
                        <small class="text-danger">{{ $errors->first('nombres') }}</small>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Apellidos" name="apellidos"  value="{{ $usuario['apellidos'] }}" {{ $errors->has('apellidos') ? 'is-invalid' : '' }} />
                    <label>Apellidos <b class="text-latinco">*</b></label>
                    @if ($errors->has('apellidos'))
                        <small class="text-danger">{{ $errors->first('apellidos') }}</small>
                    @endif
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Email" name="email"  value="{{ $usuario['email'] }}" {{ $errors->has('email') ? 'is-invalid' : '' }} />
                    <label>Email <b class="text-latinco">*</b></label>
                    @if ($errors->has('email'))
                       <small class="text-danger">{{ $errors->first('email') }}</small>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <select name="rol_id" id="" class="form-select">                        
                        @foreach($roles as $rol)
                                <option value="{{$rol->id}}">{{$rol['rol']}}</option>
                        @endforeach
                    </select>
                    <label>Rol <b class="text-latinco">*</b></label>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">
                        Actualizar usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
