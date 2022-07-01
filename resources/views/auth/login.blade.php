@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="" style="width: 40rem">
            <div class="card border-0 shadow-sm">

                <div class="card-body d-flex justify-content-center">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" width="180" height="180" class="mt-3" />
                </div>

                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email" {{ $errors->has('email') ? 'is-invalid' : '' }}  />
                            <label>Email <b class="text-rosado">*</b></label>
                            @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password" {{ $errors->has('password') ? 'is-invalid' : '' }} />
                            <label>Password <b class="text-rosado">*</b></label>
                            @if ($errors->has('password'))
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            @endif
                        </div> 

                        {{-- <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row mb-0">
                            <div class="  d-grid">
                                <button type="submit" class="btn btn-danger btn-table border-0 btn-lg">
                                    {{ __('Login') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>                            
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
