@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Hola') . ' '. Session::get('nombre'),
'description' => __('Aquí puedes crear nuevos usuarios, sean administradores o invitados.'),
'class' => 'col-lg-7'
])
<link rel="stylesheet" href="{{ asset('assets/css/usuarios/usuarios.css') }}">

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Crear usuario') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    @csrf

                    <h6 class="heading-small text-muted mb-4">{{ __('Información del usuario') }}</h6>

                    <div class="pl-lg-4" id="formCreate">
                        <label class="form-control-label" for="correoCreate">{{ __('Correo') }}</label>
                        <input type="email" name="correo" id="correoCreate" class="form-control" placeholder="{{ __('Correo electrónico') }}" required autofocus>
                        <br>
                        <label class="form-control-label" for="nombreCreate">{{ __('Nombre') }}</label>
                        <input type="text" name="nombre" id="nombreCreate" class="form-control" placeholder="{{ __('Nombre') }}" required autofocus>
                        <br>
                        <label class="form-control-label" for="apellidoCreate">{{ __('Apellido') }}</label>
                        <input type="text" name="name" id="apellidoCreate" class="form-control" placeholder="{{ __('Apellido') }}" required autofocus>
                        <br>
                        <label class="form-control-label">Tipo de usuario</label>
                        <select id="select-tipo-usuario" class="form-control">
                            <option value="" selected>Seleccione un tipo de usuario</option>
                        </select>
                        <br>
                        <div class="form-group">
                            <label class="form-control-label" for="passwordCreate">{{ __('Contraseña') }}</label>
                            <input type="password" name="passwordCreate" id="passwordCreate" class="form-control" placeholder="{{ __('Contraseña') }}" value="" required>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="confirmPasswordCreate">{{ __('Confirmar contraseña') }}</label>
                            <input type="password" name="confirmPasswordCreate" id="confirmPasswordCreate" class="form-control" placeholder="{{ __('Confirmar contraseña') }}" value="" required>
                        </div>

                        <div class="text-center">
                            <button id="guardarCreate" class="btn btn-success my-4">{{ __('GUARDAR') }}</button>
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
<script type="text/javascript" src="{{ asset('assets/js/usuarios/crear_usuario.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>