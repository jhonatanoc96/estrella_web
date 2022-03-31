@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
@include('users.partials.header', [
'title' => __('Hola') . ' '. Session::get('name'),
'description' => __('Aquí puedes modificar los datos de los eventos que has creado.'),
'class' => 'col-lg-7'
])
<style>
    .images {
        display: flex;
        flex-wrap: wrap;
        margin: 0 50px;
        padding: 30px;
    }

    .photo {
        width: 150px;
        padding-right: 10px;
        padding-top: 10px;
        /* padding: 0 10px; */
        height: auto;
    }

    .photo img {
        width: 100%;
        height: 100%;
    }

    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 100%;
    }
</style>

<link rel="stylesheet" href="{{ asset('assets/css/usuarios/usuarios.css') }}">
<script>
    var message = <?= json_encode($response) ?>;
    console.log("MESSAGE ", message);
</script>

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">{{ __('Editar Evento') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    @csrf

                    <h6 class="heading-small text-muted mb-4">{{ __('Información del evento') }}</h6>

                    <div class="pl-lg-4" id="formEdit">
                        <form id="formMainPhoto" method="POST" action="{{ url('/store-main-photo')}}" enctype="multipart/form-data">
                            @csrf
                            <label class="form-control-label" for="name">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Nombre') }}" value="{{$response['name']}}" required autofocus>
                            <br>
                            <label class="form-control-label" for="description">{{ __('Descripción') }}</label>
                            <input type="text" name="description" id="description" class="form-control" placeholder="{{ __('Descripción') }}" value="{{$response['description']}}" required autofocus>
                            <br>
                            <div class="row">
                                <div class="col-3 custom-control custom-checkbox">
                                    <input type="checkbox" name="daysEdit" class="custom-control-input" id="Lunes">
                                    <label class="custom-control-label" for="Lunes">Lunes</label>
                                </div>
                                <div class="col-3 custom-control custom-checkbox">
                                    <input type="checkbox" name="daysEdit" class="custom-control-input" id="Martes">
                                    <label class="custom-control-label" for="Martes">Martes</label>
                                </div>
                                <div class="col-3 custom-control custom-checkbox">
                                    <input type="checkbox" name="daysEdit" class="custom-control-input" id="Miercoles">
                                    <label class="custom-control-label" for="Miercoles">Miércoles</label>
                                </div>
                                <div class="col-3 custom-control custom-checkbox">
                                    <input type="checkbox" name="daysEdit" class="custom-control-input" id="Jueves">
                                    <label class="custom-control-label" for="Jueves">Jueves</label>
                                </div>
                                <div class="col-3 custom-control custom-checkbox">
                                    <input type="checkbox" name="daysEdit" class="custom-control-input" id="Viernes">
                                    <label class="custom-control-label" for="Viernes">Viernes</label>
                                </div>
                                <div class="col-3 custom-control custom-checkbox">
                                    <input type="checkbox" name="daysEdit" class="custom-control-input" id="Sabado">
                                    <label class="custom-control-label" for="Sabado">Sábado</label>
                                </div>
                                <div class="col-3 custom-control custom-checkbox">
                                    <input type="checkbox" name="daysEdit" class="custom-control-input" id="Domingo">
                                    <label class="custom-control-label" for="Domingo">Domingo</label>
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col-md-6 mb-2">
                                    <label>Hora inicial</label>
                                    <input type="time" id="input_starttime_edit" class="form-control" required value="{{$response['start_time']}}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Hora final</label>
                                    <input type="time" id="input_endtime_edit" class="form-control" required value="{{$response['end_time']}}">
                                </div>
                            </div>

                            <label class="form-control-label" for="url_image">{{ __('Foto principal') }}</label>
                            <div style="width: 200px; display: block; margin-left: auto; margin-right: auto;">
                                @if($response['new_url_image'] != "")
                                <img src="{{asset($response['new_url_image'])}}" alt="" class="center">
                                @else
                                <img src="{{asset($response['url_image'])}}" alt="" class="center">
                                @endif()
                                <input type="file" id="mainPhoto" name="mainPhoto" data-button="" accept="image/jpeg, image/png, image/gif,">
                                <button type="button" id="closeMainPhoto" class="btn btn-danger my-4">{{ __('RESTABLECER FOTO') }}</button>
                            </div>

                        </form>

                        <!-- Formulario para actualizar foto -->
                        <div class="text-center">
                            <form id="formEditEvent" method="POST" action="{{ url('/update-event')}}" enctype="multipart/form-data">
                                @csrf
                                <input style="display: none;" type="hidden" name="creation_date" value="{{$response['creation_date']}}">
                                <input style="display: none;" type="hidden" name="description" value="{{$response['description']}}">
                                <input style="display: none;" type="hidden" name="end_time" value="{{$response['end_time']}}">
                                <input style="display: none;" type="hidden" name="name" value="{{$response['name']}}">
                                <input style="display: none;" type="hidden" name="start_time" value="{{$response['start_time']}}">
                                <input style="display: none;" type="hidden" name="state" value="{{$response['state']}}">
                                <input style="display: none;" type="hidden" name="update_date" value="{{$response['update_date']}}">
                                <input style="display: none;" type="hidden" id="url_image_edit" name="url_image" value="{{$response['url_image']}}">
                                <input style="display: none;" type="hidden" name="_id_event" value="{{$response['_id']}}">
                                <button type="button" id="guardarEditEvento" class="btn btn-success my-4">{{ __('GUARDAR') }}</button>
                            </form>
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
<script type="text/javascript" src="{{ asset('assets/js/radio/edit.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>