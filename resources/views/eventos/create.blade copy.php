@extends('layouts.app', ['title' => __('Empresas')])

@section('content')
@include('users.partials.header', [
'title' => __('Hola') . ' '. Session::get('nombre'),
'description' => __('Aquí puedes crear nuevos eventos, especificando en qué horarios estará disponible.'),
'class' => 'col-lg-7'
])
<link rel="stylesheet" href="{{ asset('assets/css/usuarios/usuarios.css') }}">
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" crossorigin="anonymous">

<!-- Format Images loader CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/jquery.imagesloader.css') }}">

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>

<!-- Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<!-- Font awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js" crossorigin="anonymous"></script>

<!-- Images loader -->
<script src="{{ asset('assets/js/jquery.imagesloader-1.0.1.js') }}"></script>
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

                        <form id="frm" method="post" class="needs-validation" novalidate="">

                            <!--Image Upload-->
                            <div class="row mt-3 mb-2">

                                <div class="col-12 pr-0 text-left">
                                    <label for="Images" class="col-form-label text-nowrap"><strong>Cargar imágenes</strong></label>
                                </div>
                            </div>

                            <!--Image container -->
                            <div class="row" data-type="imagesloader" data-errorformat="Accepted file formats" data-errorsize="Maximum size accepted" data-errorduplicate="File already loaded" data-errormaxfiles="Maximum number of images you can upload" data-errorminfiles="Minimum number of images to upload" data-modifyimagetext="Modify immage">

                                <!-- Progress bar -->
                                <div class="col-12 order-1 mt-2">
                                    <div data-type="progress" class="progress" style="height: 25px; display:none;">
                                        <div data-type="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%;">Load in progress...</div>
                                    </div>
                                </div>

                                <!-- Model -->
                                <div data-type="image-model" class="col-4 pl-2 pr-2 pt-2" style="max-width:200px; display:none;">

                                    <div class="ratio-box text-center" data-type="image-ratio-box">
                                        <img data-type="noimage" class="btn btn-light ratio-img img-fluid p-2 image border dashed rounded" src="{{ asset('assets/img/photo-camera-gray.svg') }}" style="cursor:pointer;">
                                        <div data-type="loading" class="img-loading" style="color:#218838; display:none;">
                                            <span class="fa fa-2x fa-spin fa-spinner"></span>
                                        </div>
                                        <img data-type="preview" class="btn btn-light ratio-img img-fluid p-2 image border dashed rounded" src="" style="display: none; cursor: default;">
                                        <span class="badge badge-pill badge-success p-2 w-50 main-tag" style="display:none;">Main</span>
                                    </div>

                                    <!-- Buttons -->
                                    <div data-type="image-buttons" class="row justify-content-center mt-2">
                                        <button data-type="add" class="btn btn-outline-success" type="button"><span class="fa fa-camera mr-2"></span>Add</button>
                                        <button data-type="btn-modify" type="button" class="btn btn-outline-success m-0" data-toggle="popover" data-placement="right" style="display:none;">
                                            <span class="fa fa-pencil-alt mr-2"></span>Modify
                                        </button>
                                    </div>
                                </div>

                                <!-- Popover operations -->
                                <div data-type="popover-model" style="display:none">
                                    <div data-type="popover" class="ml-3 mr-3" style="min-width:150px;">
                                        <div class="row">
                                            <div class="col p-0">
                                                <button data-operation="main" class="btn btn-block btn-success btn-sm rounded-pill" type="button"><span class="fa fa-angle-double-up mr-2"></span>Main</button>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 p-0 pr-1">
                                                <button data-operation="left" class="btn btn-block btn-outline-success btn-sm rounded-pill" type="button"><span class="fa fa-angle-left mr-2"></span>Left</button>
                                            </div>
                                            <div class="col-6 p-0 pl-1">
                                                <button data-operation="right" class="btn btn-block btn-outline-success btn-sm rounded-pill" type="button">Right<span class="fa fa-angle-right ml-2"></span></button>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-6 p-0 pr-1">
                                                <button data-operation="rotateanticlockwise" class="btn btn-block btn-outline-success btn-sm rounded-pill" type="button"><span class="fas fa-undo-alt mr-2"></span>Rotate</button>
                                            </div>
                                            <div class="col-6 p-0 pl-1">
                                                <button data-operation="rotateclockwise" class="btn btn-block btn-outline-success btn-sm rounded-pill" type="button">Rotate<span class="fas fa-redo-alt ml-2"></span></button>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <button data-operation="remove" class="btn btn-outline-danger btn-sm btn-block" type="button"><span class="fa fa-times mr-2"></span>Remove</button>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="input-group">
                                    <!--Hidden file input for images-->
                                    <input id="files" type="file" name="files[]" data-button="" multiple="" accept="image/jpeg, image/png, image/gif," style="display:none;">
                                </div>
                            </div>

                        </form>

                        <div class="row mt-2">
                            <div class="col-md-4 offset-md-8 text-center mb-4">
                                <button id="btnContinue" type="submit" form="frm" class="btn btn-block btn-outline-success float-right" data-toggle="tooltip" data-trigger="manual" data-placement="top" data-title="Continue">
                                    Continue<span id="btnContinueIcon" class="fa fa-chevron-circle-right ml-2"></span><span id="btnContinueLoading" class="fa fa-spin fa-spinner ml-2" style="display:none"></span>
                                </button>
                            </div>
                        </div>

                    </div>

                    <br>

                    <div class="text-center">
                        <button id="guardarEvento" class="btn btn-success my-4">{{ __('GUARDAR') }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@include('layouts.footers.auth')
</div>
@endsection


<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
<!-- Images loader -->
<script type="text/javascript" src="{{ asset('assets/js/eventos/create.js') }}"></script>


<!-- Custom javascript -->
<script type="text/javascript">
    // Ready
    $(document).ready(function() {

        //Image loader var to use when you need a function from object
        var auctionImages = null;

        // Create image loader plugin
        var imagesloader = $('[data-type=imagesloader]').imagesloader({
            maxFiles: 4,
            minSelect: 1,
            imagesToLoad: auctionImages
        });

        //Form
        $frm = $('#frm');

        // Form submit
        $frm.submit(function(e) {

            var $form = $(this);

            var files = imagesloader.data('format.imagesloader').AttachmentArray;

            var il = imagesloader.data('format.imagesloader');

            if (il.CheckValidity())
                alert('Upload ' + files.length + ' files');

            e.preventDefault();
            e.stopPropagation();
        });

    });
</script>