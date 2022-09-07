@extends('layouts.app', ['activePage' => 'list_antrian', 'titlePage' => __('Data Pendaftar Antrian')])
@csrf
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title ">Data Pendaftar Antrian</h4>
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
                                            No
                                        </th>
                                        <th>
                                            Nomor Antrian
                                        </th>
                                        <th>
                                            Nama Pasien
                                        </th>
                                        <th>
                                            Poli Tujuan
                                        </th>
                                        <th>
                                            Status Antrian
                                        </th>
                                        <th>
                                            Tanggal Antrian
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
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $i->nomor_antrian }}</td>
                                                <td>{{ get_nama_pasien($i->id_pasien) }}</td>
                                                <td>{!! $i->nama_poli !!}</td>
                                                <td>{!! $s !!}</td>
                                                <td>{{ $i->created_at }}</td>



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
