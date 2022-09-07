@extends('layouts.app', ['activePage' => 'report_poli', 'titlePage' => __('Laporan Pendaftaran tiap Poli')])
@csrf
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title ">Laporan Antrian Poli</h4>
                            {{-- <p class="card-category">Mengatur Data Poli dalam bentuk table</p> --}}
                            <div class="col-md-12">
                                <div class="form-inline" style="float:right;">
                                    <label class="text-white">Tanggal:</label> &nbsp;
                                    <input type="date" id="filter_riwayat" class="form-control ml-auto"
                                        name="filter_riwayat" style="color: #f4f4f4" />
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row" style="margin: 0 auto;">
                                    @foreach ($poli as $i)
                                        <div class="card col-md-5 m-3 mb-4">
                                            <div class="card-header text-white"
                                                style="background: {{ rand_color() }}; border-radius:2px; margin-top:-1em; box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.1), 0 2px 2px 0 rgba(0, 0, 0, 0.19);">
                                                <b>{{ $i->nama_poli }}</b>
                                            </div>
                                            <table class="table table-borderless" style="font-size:.8em;">
                                                <tr>
                                                    <th width="10%">No.</th>
                                                    <th>Pasien</th>
                                                    <th colspan="2">Status</th>
                                                </tr>
                                                @php
                                                    $antrn = get_poli_antrian($i->id_poli);
                                                    $hadir = get_kehadiran_antrian($i->id_poli, 3);
                                                    $tidak = get_kehadiran_antrian($i->id_poli, 1);
                                                @endphp
                                                @if ($antrn != '0')
                                                    @foreach ($antrn as $j)
                                                        @php
                                                            $i = 1;
                                                            switch ($j->status_antrian) {
                                                                case 1:
                                                                    $s = '<span class="badge badge-danger">Pending</span>';
                                                                    break;
                                                                case 2:
                                                                    $s = '<span class="badge badge-info">On going</span>';
                                                                    break;
                                                                default:
                                                                    $s = '<span class="badge badge-success">Finished</span>';
                                                                    break;
                                                            }
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ get_nama_pasien($j->id_pasien) }}</td>
                                                            <td colspan="2">{!! $s !!}</td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                    <tr>
                                                        <th colspan="2" class="text-success">Pasien Hadir: {{ $hadir }}</th>
                                                        <th colspan="2" class="text-danger">Pasien Tidak Hadir: {{ $tidak }}</th>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td class="text-center text-secondary" colspan="3">
                                                            <i> Tidak ada Antrian Hari ini</i>
                                                        </td>
                                                    </tr>
                                                @endif
                                            </table>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



    </div>
@endsection
