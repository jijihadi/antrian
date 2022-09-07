@extends('layouts.app', ['activePage' => 'riwayat', 'titlePage' => __('Data Riwayat Antrian')])
@csrf
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title ">Data Riwayat Antrian</h4>
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
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            No.
                                        </th>
                                        <th>
                                            Nama Pasien
                                        </th>
                                        <th>
                                            Status Antrian
                                        </th>
                                        <th>
                                            Tanggal Daftar
                                        </th>
                                        <th>
                                            #
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayat as $i)
                                            @php
                                                switch ($i->status_antrian) {
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
                                                {{-- <td>{{ $i->id_antrian }}</td> --}}
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ get_nama_pasien($i->id_pasien) }}</td>
                                                <td>{!! $s !!}</td>
                                                <td>{{ $i->created_at }}</td>
                                                <td>
                                                    @if ($i->status_antrian != 1)
                                                    {{-- @if ($i->status_antrian == 1) --}}
                                                        <a href="{{url('/cetak_antrian')."/".$i->nomor_antrian}}" target="_blank">
                                                            <button class="btn btn-success btn-sm">
                                                                Cetak
                                                                <span class="material-icons md-18">print</span>
                                                            </button>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
