@extends('layouts.layout')
@section('title', 'Usuarios')
@section('content')

    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-danger" href="{{ route('admin.usuario.index') }}">
                <i class="fas fa-caret-square-left"></i> Atrás
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-header text-rosado"><i class="fas fa-user text-rosado"></i> <b>Formulario de usuarios</b>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.usuario.store') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Nombres" name="nombres" {{ $errors->has('nombres') ? 'is-invalid' : '' }} />
                            <label>Nombre <b class="text-rosado">*</b></label>
                            @if ($errors->has('nombres'))
                                <small class="text-danger">{{ $errors->first('nombres') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Apellidos" name="apellidos" {{ $errors->has('apellidos') ? 'is-invalid' : '' }} />
                            <label>Apellidos <b class="text-rosado">*</b></label>
                            @if ($errors->has('apellidos'))
                                <small class="text-danger">{{ $errors->first('apellidos') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" {{ $errors->has('email') ? 'is-invalid' : '' }}  />
                            <label>Email <b class="text-rosado">*</b></label>
                            @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" {{ $errors->has('password') ? 'is-invalid' : '' }}/>
                            <label>Password <b class="text-rosado">*</b></label>
                            @if ($errors->has('password'))
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            @endif
                        </div>  

                        <div class="form-floating mb-3">
                            <select name="rol_id" id="" class="form-select">
                                @foreach ($roles as $rol)
                                    <option value="{{ $rol->id }}">{{ $rol->rol }}</option>
                                @endforeach
                            </select>
                            <label>Rol <b class="text-rosado">*</b></label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-outline-danger colorRed" id="btn-add-class">
                                Ingresar usuario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
