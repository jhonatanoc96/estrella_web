@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Hola') . ' '. Session::get('nombre'),
'description' => __('Aquí puedes modificar tus datos personales, al igual que tu contraseña.'),
'class' => 'col-lg-7'
])
<link rel="stylesheet" href="{{ asset('assets/css/usuarios/usuarios.css') }}">

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Editar Perfil') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    @csrf

                    <h6 class="heading-small text-muted mb-4">{{ __('Información del usuario') }}</h6>

                    <div class="pl-lg-4" id="formEdit">
                        <label class="form-control-label" for="nombreEdit">{{ __('Nombre') }}</label>
                        <input type="text" name="name" id="nombreEdit" class="form-control" placeholder="{{ __('Nombre') }}" value="{{ old('name', Session::get('name')) }}" required autofocus>
                        <br>
                        <label class="form-control-label" for="apellidoEdit">{{ __('Apellido') }}</label>
                        <input type="text" name="last_name" id="apellidoEdit" class="form-control" placeholder="{{ __('Apellido') }}" value="{{ old('last_name', Session::get('last_name')) }}" required autofocus>
                        <br>
                        <label class="form-control-label" for="estadoEdit">{{ __('Estado') }}</label>
                        <br>
                        <!-- <input type="checkbox" name="estado" id="estadoEdit" class="form-control" value="{{ old('estado', Session::get('estado')) }}" required> -->
                        <label class="switch">
                            <input type="checkbox" id="estadoEdit">
                            <span class="slider round"></span>
                        </label>
                        <input type="hidden" name="uid" id="_idEdit" value="{{ old('uid', Session::get('uid')) }}" required>
                        <input type="hidden" name="token" id="tokenEdit" value="{{ old('token', Session::get('token')) }}" required>
                        <input type="hidden" name="email" id="correoEdit" value="{{ old('email', Session::get('email')) }}" required>
                        <input type="hidden" name="state" id="estadoActual" value="{{ old('state', Session::get('state')) }}" required>
                        <input type="hidden" name="phone_number" id="phoneEdit" value="{{ old('phone_number', Session::get('phone_number')) }}" required>
                        <input type="hidden" name="id_user_type" id="id_user_typeEdit" value="{{ old('id_user_type', Session::get('id_user_type')) }}" required>
                        <!-- Tipo de usuario -->

                        <div class="text-center">
                            <button id="guardarEdit" class="btn btn-success my-4">{{ __('GUARDAR') }}</button>
                        </div>
                    </div>
                    <hr class="my-4" />
                    @csrf

                    <h6 class="heading-small text-muted mb-4">{{ __('Contraseña') }}</h6>

                    <div class="pl-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="passwordEdit">{{ __('Nueva contraseña') }}</label>
                            <input type="password" name="passwordEdit" id="passwordEdit" class="form-control" placeholder="{{ __('Nueva contraseña') }}" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="confirmPasswordEdit">{{ __('Confirmar nueva contraseña') }}</label>
                            <input type="password" name="confirmPasswordEdit" id="confirmPasswordEdit" class="form-control" placeholder="{{ __('Confirmar nueva contraseña') }}" value="" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" id="changePassword" class="btn btn-success mt-4">{{ __('Cambiar contraseña') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footers.auth')
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/usuarios/usuarios.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>