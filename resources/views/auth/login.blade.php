@extends('layouts.app', ['class' => 'bg-default'])

@section('content')
@include('layouts.headers.guest')

<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary shadow border-0">
    
                <div class="card-body px-lg-5 py-lg-5">
          
                    @csrf

                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input id="emailLogin" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Correo electrónico') }}" type="email" name="email" value="{{ old('email') }}" value="admin@argon.com" required autofocus>
                        </div>
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input id="passwordLogin" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Contraseña') }}" type="password" required>
                        </div>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
 
                    <div class="text-center">
                        <!-- <button id="guardar" type="submit" class="btn btn-primary my-4">{{ __('Sign in') }}</button> -->
                        <button id="guardar" class="btn btn-primary my-4">{{ __('INICIAR SESIÓN') }}</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="{{asset('assets/js/FileSaver.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/login/login.js') }}"></script>