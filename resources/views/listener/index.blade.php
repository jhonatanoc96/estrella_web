@extends('layouts.app')

@section('content')


<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">

</div>

<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success col-12" role="alert" id="id">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $message }}
                        </div>
                        @endif
                        <div class="col-8">
                            <h3 class="mb-0">Club de oyentes</h3>
                        </div>
                        <div class="col-4 text-right">
                            <button data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-primary"><i class="fa fa-envelope" aria-hidden="true"></i> ENVIAR MENSAJE</button>
                            <a href="{{route('generate-excel-listeners')}}" class="btn btn-sm btn-success"><i class="fa fa-file-excel" aria-hidden="true"></i>   EXCEL</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">País</th>
                                <th scope="col">Departamento</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Correo electrónico</th>
                                <th scope="col">Ocupación</th>
                                <th scope="col">Fecha de nacimiento</th>
                                <th scope="col">Fecha de registro</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="records_table">

                        </tbody>
                    </table>

                    <!-- <img src="{{ storage_path('app/events/img/6203c745c525310a60478135/16444147900_.jpg') }}" style="width: 100%; height: 100%;"> -->


                </div>
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">

                    </nav>
                </div>
            </div>
        </div>
    </div>


    <!-- MODALS -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ENVIAR MENSAJE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="table-responsive">

                        <label class="form-control-label" for="name">{{ __('Título de la notificación') }}</label>
                        <input type="text" name="title" id="titleNotification" class="form-control" placeholder="{{ __('Título') }}" required autofocus>
                        <br>
                        <label class="form-control-label" for="url">{{ __('URL') }}</label>
                        <input type="text" name="description" id="descriptionNotification" class="form-control" placeholder="{{ __('Descripción') }}" required autofocus>
                        <br>

                        <div class="text-center">
                            <button id="enviarNotificacion" class="btn btn-success my-4">{{ __('GUARDAR') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@include('layouts.footers.auth')
@endsection

<!-- Argon JS -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/listener/index.js') }}"></script>

<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

@stack('js')

<!-- Argon JS -->
<script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>