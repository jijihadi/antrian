@extends('layouts.app', ['activePage' => 'antrian', 'titlePage' => __('Infromasi Antrian ')])
@csrf
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title text-center">Informasi Data Antrian ( <?php date_default_timezone_set('Asia/Jakarta');
                            echo tgl_indo(date('Y-m-d')); ?> ) </h4>

                        </div>
                        <div class="card-body ">
                            <div class="row">

                                @foreach ($poli as $i)
                                    <div class="col-md-4">
                                        <div class="card card-nav-tabs" style="width: 20rem;">
                                            <div class="card-header card-header-info">
                                                {{ $i->nama_poli }} (
                                                @if ($i->status_poli == 1)
                                                    <span class="badge badge-success">Buka</span>
                                                @endif
                                                @if ($i->status_poli == 0)
                                                    <span class="badge badge-danger">Tutup</span>
                                                @endif
                                                )<br>
                                                <h4><b>
                                                        Antrian Sekarang : (<span
                                                            class="text-white">{{ get_antrian_sekarang($i->id_poli) }}</span>)
                                                    </b></h4>
                                            </div>

                                            <ul class="list-group list-group-flush">
                                                @foreach (get_nomor_antrian($i->id_poli) as $ii)
                                                    @if ($ii->nomor_antrian == get_antrian_sekarang($ii->id_poli))
                                                        @if ($ii->status_antrian == 3)
                                                            <li class="list-group-item">
                                                                {{ $ii->nomor_antrian }}--{{ get_nama_pasien($ii->id_pasien) }}
                                                                <span data-id="{{ $ii->id_antrian }}"
                                                                    data-idp="{{ $ii->id_poli }}"
                                                                    class="ml-auto material-icons text-secondary"
                                                                    style="cursor: not-allowed;">check</span>
                                                            </li>
                                                        @endif
                                                        @if ($ii->status_antrian == 1)
                                                            <li class="list-group-item">
                                                                {{ $ii->nomor_antrian }}--{{ get_nama_pasien($ii->id_pasien) }}
                                                                <span data-id="{{ $ii->id_antrian }}"
                                                                    data-idp="{{ $ii->id_poli }}"
                                                                    class="ml-auto material-icons {{(auth()->user()->role==3? "":"aktifkan_antrian")}}"
                                                                    style="cursor: pointer;">label_important</span>
                                                            </li>
                                                        @endif
                                                        @if ($ii->status_antrian == 2)
                                                            <li class="list-group-item">
                                                                {{ $ii->nomor_antrian }}--{{ get_nama_pasien($ii->id_pasien) }}
                                                                <span data-id="{{ $ii->id_antrian }}"
                                                                    data-idp="{{ $ii->id_poli }} "
                                                                    class="ml-auto material-icons text-success {{(auth()->user()->role==3? "":"finishantri")}}"
                                                                    style="cursor: pointer;">label_important</span>
                                                            </li>
                                                            <div class="card-footer">
                                                                {{-- <div class="stats"> --}}
                                                                {{-- <i class="material-icons text-danger">warning</i>
                                                                              <a href="#">Belum di verifikasi</a>
                                                                          </div> --}}
                                                            </div>
                                                        @endif
                                                    @endif

                                                    @if ($ii->nomor_antrian != get_antrian_sekarang($ii->id_poli))
                                                        @if ($ii->status_antrian == 3)
                                                        <li class="list-group-item">
                                                            {{ $ii->nomor_antrian }}--{{ get_nama_pasien($ii->id_pasien) }}
                                                            <span data-id="{{ $ii->id_antrian }}"
                                                                data-idp="{{ $ii->id_poli }}"
                                                                class="ml-auto material-icons text-secondary"
                                                                style="cursor: not-allowed;">check</span>
                                                        </li>
                                                        @endif
                                                        @if ($ii->status_antrian == 1 && cek_finish_antrian($ii->nomor_antrian) == 0)
                                                            <li class="list-group-item">
                                                                {{ $ii->nomor_antrian }}--{{ get_nama_pasien($ii->id_pasien) }}
                                                                <span data-id="{{ $ii->id_antrian }}"
                                                                    data-idp="{{ $ii->id_poli }}"
                                                                    class="ml-auto material-icons {{(auth()->user()->role==3? "":"aktifkan_antrian")}} "
                                                                    style="cursor: pointer;">label_important</span>
                                                            </li>
                                                        @endif
                                                        @if ($ii->status_antrian == 2 && cek_finish_antrian($ii->nomor_antrian) == 0)
                                                            <li class="list-group-item">
                                                                {{ $ii->nomor_antrian }}--{{ get_nama_pasien($ii->id_pasien) }}
                                                                <span data-id="{{ $ii->id_antrian }}"
                                                                    data-idp="{{ $ii->id_poli }} "
                                                                    class="ml-auto material-icons {{(auth()->user()->role==3? "":"aktifkan_antrian")}}"
                                                                    style="cursor: pointer;">label_important</span>
                                                            </li>
                                                            <div class="card-footer">
                                                                {{-- <div class="stats">
                                                                              <i class="material-icons text-danger">warning</i>
                                                                              <a href="#">Belum di verifikasi</a>
                                                                          </div> --}}
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach

                            </div>


                        </div>
                    </div>


                </div>



            </div>
        </div>
    @endsection
