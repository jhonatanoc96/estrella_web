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
                        <div class="col-8">
                            <h3 class="mb-0">Encuestas</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{route('encuestas.create')}}" class="btn btn-sm btn-primary">Agregar encuesta</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Descripción</th>
                                <th scope="col">Campaña</th>
                                <th scope="col">Fecha de creación</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="records_table">

                        </tbody>
                    </table>

                </div>

                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">

                    </nav>
                </div>
            </div>

            <div class="card shadow" id="card_preguntas" style="display: none;">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Preguntas</h3>
                        </div>
                        <!-- <div class="col-4 text-right">
                            <a href="{{route('encuestas.create')}}" class="btn btn-sm btn-primary">Agregar encuesta</a>
                        </div> -->
                    </div>
                </div>

                <div class="col-12">
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Pregunta</th>
                                <th scope="col">Tipo de pregunta</th>
                                <th scope="col">Encuesta</th>
                                <th scope="col">Fecha de creación</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="records_table_preguntas">

                        </tbody>
                    </table>

                </div>

                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">

                    </nav>
                </div>
            </div>

            <div class="card shadow" id="card_opcionrespuesta" style="display: none;">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Opciones de respuesta</h3>
                        </div>
                        <!-- <div class="col-4 text-right">
                            <a href="{{route('encuestas.create')}}" class="btn btn-sm btn-primary">Agregar encuesta</a>
                        </div> -->
                    </div>
                </div>

                <div class="col-12">
                </div>

                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Respuesta</th>
                                <th scope="col">Fecha de creación</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="records_table_opcionrespuesta">

                        </tbody>
                    </table>

                </div>

                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">

                    </nav>
                </div>
            </div>
            <input type="hidden" id="_id_usuario" value="{{ old('_id', Session::get('_id')) }}">
        </div>
    </div>

</div>
@include('layouts.footers.auth')
@endsection


<!-- Argon JS -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="{{ asset('assets/js/encuestas/index.js') }}"></script>

<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

@stack('js')

<!-- Argon JS -->
<script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>