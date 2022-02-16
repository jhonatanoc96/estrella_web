@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Hola') . ' '. Session::get('nombre'),
'description' => __('Aquí puedes modificar los datos de las empresas que has creado.'),
'class' => 'col-lg-7'
])
<link rel="stylesheet" href="{{ asset('assets/css/usuarios/usuarios.css') }}">

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Editar Campaña') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    @csrf

                    <h6 class="heading-small text-muted mb-4">{{ __('Información de la campaña') }}</h6>

                    <div class="pl-lg-4" id="formEdit">
                        <input type="hidden" id="_id_empresa_selected" value="{{$response['empresa']['_id']}}" required>
                        <label class="form-control-label" for="nombreEdit">{{ __('Nombre') }}</label>
                        <input type="text" name="nombre" id="nombreEdit" class="form-control" placeholder="{{ __('Nombre') }}" value="{{$response['nombre']}}" required autofocus>
                        <br>
                        <label class="form-control-label" for="descripcionEdit">{{ __('Descripción') }}</label>
                        <input type="text" name="descripcion" id="descripcionEdit" class="form-control" placeholder="{{ __('Descripcion') }}" value="{{$response['descripcion']}}" required autofocus>
                        <br>
                        <label class="form-control-label">{{ __('Empresa') }}</label>
                        <select id="select-empresas-edit" class="form-control">
                            <option value="">Seleccione una empresa</option>
                        </select>
                        <br>

                        <div class="text-center">
                            <button id="guardarEditCampana" class="btn btn-success my-4">{{ __('GUARDAR') }}</button>
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
<script type="text/javascript" src="{{ asset('assets/js/campanas/edit.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>