@extends('layouts.app', ['title' => __('Campañas')])

@section('content')
@include('users.partials.header', [
'title' => __('Hola') . ' '. Session::get('nombre'),
'description' => __('Aquí puedes crear nuevas opciones de respuesta para la pregunta seleccionada.'),
'class' => 'col-lg-7'
])
<link rel="stylesheet" href="{{ asset('assets/css/usuarios/usuarios.css') }}">

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Crear opción de respuesta') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    @csrf

                    <h6 class="heading-small text-muted mb-4">{{ __('Información de la opción de respuesta') }}</h6>

                    <div class="pl-lg-4" id="formCreate">
                        <label class="form-control-label" for="respuestaCreate">{{ __('Respuesta') }}</label>
                        <input type="text" name="respuestaCreate" id="respuestaCreate" class="form-control" placeholder="{{ __('Respuesta') }}" required autofocus>
                        <br>
                        <input type="hidden" id="_id_usuario" value="{{ old('_id', Session::get('_id')) }}">

                        <div class="text-center">
                            <button id="guardarCreateOpcionRespuesta" class="btn btn-success my-4">{{ __('GUARDAR') }}</button>
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
<script type="text/javascript" src="{{ asset('assets/js/encuestas/pregunta.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>