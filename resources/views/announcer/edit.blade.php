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
                        <h3 class="mb-0">{{ __('Editar Locutor') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    @csrf

                    <h6 class="heading-small text-muted mb-4">{{ __('Información del locutor') }}</h6>

                    <div class="pl-lg-4" id="formEdit">
                        <form id="formMainPhotoAnnouncer" method="POST" action="{{ url('/store-main-photo-announcer')}}" enctype="multipart/form-data">
                            @csrf
                            <label class="form-control-label" for="name">{{ __('Nombre') }}</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('Nombre') }}" value="{{$response['name']}}" required autofocus>
                            <br>
                            <label class="form-control-label" for="lastname">{{ __('Apellido') }}</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="{{ __('Apellido') }}" value="{{$response['last_name']}}" required autofocus>
                            <br>
                            <label class="form-control-label" for="description">{{ __('Descripción') }}</label>
                            <input type="text" name="description" id="description" class="form-control" placeholder="{{ __('Descripción') }}" value="{{$response['description']}}" required autofocus>
                            <br>

                            <label class="form-control-label" for="url_image">{{ __('Foto principal') }}</label>
                            <div style="width: 200px; display: block; margin-left: auto; margin-right: auto;">
                                @if($response['new_url_image'] != "")
                                <img src="{{asset($response['new_url_image'])}}" alt="" class="center">
                                <input type="file" id="mainPhotoAnnouncer" name="mainPhotoAnnouncer" data-button="" accept="image/jpeg, image/png, image/gif,">
                                <button type="button" id="closeMainPhotoAnnouncer" class="btn btn-danger my-4">{{ __('RESTABLECER FOTO') }}</button>
                                @else
                                <img src="{{asset($response['url_image'])}}" alt="" class="center">
                                <input type="file" id="mainPhotoAnnouncer" name="mainPhotoAnnouncer" data-button="" accept="image/jpeg, image/png, image/gif,">
                                @endif()
                            </div>

                        </form>

                        <!-- Formulario para actualizar foto -->
                        <div class="text-center">
                            <form id="formEditAnnouncer" method="POST" action="{{ url('/update-announcer')}}" enctype="multipart/form-data">
                                @csrf
                                <input style="display: none;" type="hidden" name="creation_date" value="{{$response['creation_date']}}">
                                <input style="display: none;" type="hidden" name="description" value="{{$response['description']}}">
                                <input style="display: none;" type="hidden" name="name" value="{{$response['name']}}">
                                <input style="display: none;" type="hidden" name="lastname" value="{{$response['last_name']}}">
                                <input style="display: none;" type="hidden" name="state" value="{{$response['state']}}">
                                <input style="display: none;" type="hidden" name="update_date" value="{{$response['update_date']}}">
                                <input style="display: none;" type="hidden" id="url_image_edit" name="url_image" value="{{$response['url_image']}}">
                                <input style="display: none;" type="hidden" name="_id_announcer" value="{{$response['_id']}}">
                                <button type="button" id="guardarEditLocutor" class="btn btn-success my-4">{{ __('GUARDAR') }}</button>
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
<script type="text/javascript" src="{{ asset('assets/js/announcer/edit.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>