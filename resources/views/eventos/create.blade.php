<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Estrella</title>
    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Extra details for Live View on GitHub Pages -->

    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/usuarios/usuarios.css') }}">

</head>

<body class="{{ $class ?? '' }}">
    @if(Session::get('token'))
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @include('layouts.navbars.sidebar')
    @endif

    <div class="main-content">
        @include('layouts.navbars.navbar')

        <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" crossorigin="anonymous">

        <!-- Format Images loader CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/jquery.imagesloader.css') }}">


        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>

        <style>
            body {
                background: #fafafa;
            }

            .container {
                margin: 150px auto;
            }
        </style>

        <div class="container-fluid mt--7">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">{{ __('Crear evento') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('Información del evento') }}</h6>

                            <div class="pl-lg-4" id="formCreate">
                                <!-- <form id="frm" class="needs-validation" novalidate="" action="#" enctype="multipart/form-data"> -->
                                <form id="frm" method="POST" class="needs-validation" novalidate="" action="{{ url('/store-files')}}" enctype="multipart/form-data">
                                    <label class="form-control-label" for="nameCreate">{{ __('Nombre') }}</label>
                                    <input type="text" name="name" id="nameCreate" class="form-control" placeholder="{{ __('Nombre') }}" required autofocus>
                                    <br>
                                    <label class="form-control-label" for="descriptionCreate">{{ __('Descripción') }}</label>
                                    <input type="text" name="description" id="descriptionCreate" class="form-control" placeholder="{{ __('Descripción') }}" required autofocus>
                                    <br>
                                    <label class="form-control-label" for="daysCreate">{{ __('Días') }}</label>
                                    <!-- Default checked -->
                                    <div class="row">
                                        <div class="col-3 custom-control custom-checkbox">
                                            <input type="checkbox" name="days" class="custom-control-input" id="Lunes">
                                            <label class="custom-control-label" for="Lunes">Lunes</label>
                                        </div>
                                        <div class="col-3 custom-control custom-checkbox">
                                            <input type="checkbox" name="days" class="custom-control-input" id="Martes">
                                            <label class="custom-control-label" for="Martes">Martes</label>
                                        </div>
                                        <div class="col-3 custom-control custom-checkbox">
                                            <input type="checkbox" name="days" class="custom-control-input" id="Miercoles">
                                            <label class="custom-control-label" for="Miercoles">Miércoles</label>
                                        </div>
                                        <div class="col-3 custom-control custom-checkbox">
                                            <input type="checkbox" name="days" class="custom-control-input" id="Jueves">
                                            <label class="custom-control-label" for="Jueves">Jueves</label>
                                        </div>
                                        <div class="col-3 custom-control custom-checkbox">
                                            <input type="checkbox" name="days" class="custom-control-input" id="Viernes">
                                            <label class="custom-control-label" for="Viernes">Viernes</label>
                                        </div>
                                        <div class="col-3 custom-control custom-checkbox">
                                            <input type="checkbox" name="days" class="custom-control-input" id="Sabado">
                                            <label class="custom-control-label" for="Sabado">Sábado</label>
                                        </div>
                                        <div class="col-3 custom-control custom-checkbox">
                                            <input type="checkbox" name="days" class="custom-control-input" id="Domingo">
                                            <label class="custom-control-label" for="Domingo">Domingo</label>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-2">
                                            <label>Hora inicial</label>
                                            <input type="time" id="input_starttime" class="form-control" required>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label>Hora final</label>
                                            <input type="time" id="input_endtime" class="form-control" required>
                                        </div>
                                    </div>

                                    @csrf
                                    <!--Image Upload-->
                                    <div class="row mt-3 mb-2">

                                        <div class="col-12 pr-0 text-left">
                                            <label for="Images" class="col-form-label text-nowrap"><strong>Cargar imágenes</strong></label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="input-group">
                                            <!--Hidden file input for images-->
                                            <input type="file" id="files" name="files[]" data-button="" multiple accept="image/jpeg, image/png, image/gif,">
                                            <!-- <input id="files" type="file" name="files[]" data-button="" multiple accept="image/jpeg, image/png, image/gif,"> -->
                                        </div>
                                    </div>
                                </form>

                                <!-- <input id="files" type="file" name="files" multiple style="display:block;"> -->
                                <div class="row mt-2">
                                    <div class="col-md-4 offset-md-8 text-center mb-4">
                                        <button id="btnSubmit" class="btn btn-block btn-outline-success float-right" data-toggle="tooltip" data-trigger="manual" data-placement="top" data-title="Continue">
                                            Crear evento<span id="btnContinueIcon" class="fa fa-chevron-circle-right ml-2"></span><span id="btnContinueLoading" class="fa fa-spin fa-spinner ml-2" style="display:none"></span>
                                        </button>
                                        <!-- <button type="submit" class="btn btn-block btn-outline-success float-right" data-toggle="tooltip" data-trigger="manual" data-placement="top" data-title="Continue">
                                                                                Crear evento<span id="btnContinueIcon" class="fa fa-chevron-circle-right ml-2"></span><span id="btnContinueLoading" class="fa fa-spin fa-spinner ml-2" style="display:none"></span>
                                                                            </button> -->
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>

        <script type="text/javascript" src="{{ asset('assets/js/eventos/create.js') }}"></script>

    </div>

    @if(!Session::get('token'))
    @include('layouts.footers.guest')
    @endif

    @stack('js')

</body>

</html>



<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<!-- Font awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js" crossorigin="anonymous"></script>

<!-- Images loader -->
<script src="{{ asset('assets/js/jquery.imagesloader-1.0.1.js') }}"></script>