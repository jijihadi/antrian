@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'titlepage' => __('Material Dashboard')])

@section('content')
    <div class="container" style="height: auto;">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-8">
                <h1 class="text-white text-center">
                    <small>Aplikasi Antrian <br></small>
                    <b>Puskesmas Klatak</b>
                </h1>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title text-center">Informasi Data Antrian ( <?php date_default_timezone_set('Asia/Jakarta');
                        echo date('Y-m-d'); ?> ) </h4>

                    </div>
                    <div class="card-body ">
                        <div class="row">

                            @foreach ($poli as $i)
                                <div class="col-md-4">
                                    <div class="card card-nav-tabs" style="width: 20rem;">
                                        <div class="card-header card-header-info">
                                            {{ $i->nama_poli }}
                                            @if ($i->status_poli == 1)
                                                (<span class="badge badge-success">Buka</span>)
                                            @endif
                                            @if ($i->status_poli == 0)
                                                (<span class="badge badge-danger">Tutup</span>)
                                                <br>
                                                <i>Buka lagi besok jam 07:00</i>
                                            @endif
                                            <br>
                                            Antrian Sekarang : (<span
                                                class="text-dark">{{ get_antrian_sekarang($i->id_poli) }}</span>)
                                        </div>


                                    </div>
                                </div>
                            @endforeach

                        </div>


                    </div>
                </div>


            </div>

        </div>
    @endsection
