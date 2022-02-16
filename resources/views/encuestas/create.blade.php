@extends('layouts.app', ['title' => __('Campañas')])

@section('content')
@include('users.partials.header', [
'title' => __('Hola') . ' '. Session::get('nombre'),
'description' => __('Aquí puedes crear nuevas encuestas, a las cuales se les podrán asignar nuevas preguntas.'),
'class' => 'col-lg-7'
])
<link rel="stylesheet" href="{{ asset('assets/css/usuarios/usuarios.css') }}">

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Crear encuesta') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    @csrf

                    <h6 class="heading-small text-muted mb-4">{{ __('Información de la encuesta') }}</h6>

                    <div class="pl-lg-4" id="formCreate">
                        <label class="form-control-label" for="descripcionCreate">{{ __('Descripción') }}</label>
                        <input type="text" name="descripcion" id="descripcionCreate" class="form-control" placeholder="{{ __('Descripción') }}" required autofocus>
                        <br>
                        <label class="form-control-label">{{ __('Campaña') }}</label>
                        <select id="select-campanas-create" class="form-control">
                            <option value="" selected>Seleccione una campaña</option>
                        </select>
                        <br>
                        <input type="hidden" id="_id_usuario" value="{{ old('_id', Session::get('_id')) }}">

                        <div class="text-center">
                            <button id="guardarCreateEncuesta" class="btn btn-success my-4">{{ __('GUARDAR') }}</button>
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
<script type="text/javascript" src="{{ asset('assets/js/encuestas/create.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>