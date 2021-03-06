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
                            <h3 class="mb-0">Banners de eventos</h3>
                            <!-- <image src="{{asset('/storage/events/img/6203c745c525310a60478135/16444147900_.jpg')}}"> -->
                        </div>
                        <div class="col-4">
                            <!-- <button data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-primary">Agregar imagen</button> -->
                            <form id="formAddPhotoBannerEvent" method="POST" action="{{ url('/create-image-bannerevent')}}" enctype="multipart/form-data">
                                @csrf
                                <input id="addPhotoBannerEvent" type="file" name="newPhoto"></input>
                            </form>
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
                                <th scope="col">Descripci??n</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha de creaci??n</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">IM??GENES</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Imagen</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="records_images_table">

                            </tbody>
                        </table>
                        <!-- <img src="{{ storage_path('app/events/img/6203c745c525310a60478135/16444147900_.jpg') }}" style="width: 100%; height: 100%;"> -->
                    </div>

                    <form id="formAddPhoto" method="POST" action="{{ url('/create-image')}}" enctype="multipart/form-data">
                        @csrf
                        <input id="addPhoto" type="file" name="newPhoto">Agregar imagen</input>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
<script type="text/javascript" src="{{ asset('assets/js/bannersevents/index.js') }}"></script>

<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

@stack('js')

<!-- Argon JS -->
<script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>