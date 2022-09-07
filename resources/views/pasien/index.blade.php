@extends('layouts.app', ['activePage' => 'pasien', 'titlePage' => __('Data Poli')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        @if (auth()->user()->role == 1)
                            <div class="card-header card-header-warning">
                                <h4 class="card-title ">Data Pasien</h4>
                                <p class="card-category">Mengatur Data Pasien yang terdaftar</p>
                                {{-- <p class="text-right"><a href="{{ route('poli.create') }}" class="btn btn-md btn-info"><span class="material-icons mr-2">add</span>Tambah Poli</a></p> --}}
                            </div>
                        @endif
                        @if (auth()->user()->role == 3)
                            <div class="card-header card-header-warning text-white">
                                <h4 class="card-title ">Data Pasien ( {{ auth()->user()->name }} )</h4>
                                <p class="card-category">Data verifikasi pada <?php date_default_timezone_set('Asia/Jakarta');
                                echo date('Y-m-d'); ?> </p>
                                <p class="text-right"><a href="{{ route('pasien.create') }}"
                                        class="btn btn-md btn-info"><span class="material-icons mr-2">history</span>Data
                                        Riwayat</a></p>
                            </div>
                        @endif

                        <div class="card-body">
                            @if (auth()->user()->role == 1)
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
                                                NIK
                                            </th>
                                            <th>
                                                Waktu Pendaftaran
                                            </th>
                                            <th  class="text-center">
                                                #
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach ($pasien as $i)
                                                <tr>

                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $i->name }}
                                                    </td>
                                                    <td>
                                                        {{ $i->nik }}
                                                    </td>
                                                    <td>
                                                        {{ $i->created_at }}
                                                    </td>
                                                    <td class="td-action text-center">
                                                        <a href="{{ route('pasien.edit', $i->id) }}"><span
                                                                class="material-icons text-warning">edit</span></a>
                                                        <a href="#"><span
                                                                class="material-icons text-danger">delete</span></a>

                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if (auth()->user()->role == 1 || auth()->user()->role == 2)
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-warning">
                                <h4 class="card-title ">Verifikasi Data Pasien</h4>
                                <p class="card-category">Konfirmasi Data Pasien Untuk mendapatkan Antrian </p>

                                    <div class="col-md-12">
                                        <div class="form-inline" style="float:right;">
                                            <input type="date" id="tanggal_antrian" class="form-control ml-auto"
                                                name="tanggal_antrian" style="color: #f4f4f4" />
                                        </div>
                                    </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Nama Pasien
                                            </th>
                                            <th>
                                                Nomor Antrian
                                            </th>
                                            <th>
                                                Poli Terdaftar
                                            </th>

                                            <th>
                                                Status Verifikasi
                                            </th>
                                            <th>
                                                Tanggal Terdaftar
                                            </th>
                                            <th  class="text-center">
                                                Action
                                            </th>
                                        </thead>
                                        <tbody class="isi_table_pasien">
                                            @foreach ($antrian as $i)
                                                <tr>
                                                    <td>{{ $i->id_antrian }}</td>
                                                    <td>{{ get_nama_pasien($i->id_pasien) }}</td>
                                                    <td>{{ $i->nomor_antrian }}</td>
                                                    <td>{{ get_nama_poli($i->id_poli) }}</td>
                                                    <td>
                                                        @if ($i->status_antrian == 2)
                                                            <span class="badge badge-danger">Pending</span>
                                                        @endif
                                                        @if ($i->status_antrian == 1)
                                                            <span class="badge badge-success">Verified</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ $i->created_at }}
                                                    </td>
                                                    <td class="td-action text-center">
                                                        <a href="{{ route('pasien.verifikasi', $i->id_antrian) }}"><span
                                                                class="material-icons text-warning">edit</span></a>
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (auth()->user()->role == 3)
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Nama Pasien
                                    </th>
                                    <th>
                                        Nomor Antrian
                                    </th>
                                    <th>
                                        Poli Terdaftar
                                    </th>

                                    <th>
                                        Status Verifikasi
                                    </th>
                                    <th>
                                        Tanggal Terdaftar
                                    </th>
                                    {{-- <th  class="text-center">
                Action
              </th> --}}
                                </thead>
                                <tbody class="isi_table_pasien">

                                    @if (!empty($mypasien))
                                        @foreach ($mypasien as $i)
                                            <tr>
                                                <td>{{ $i->id_antrian }}</td>
                                                <td>{{ get_nama_pasien($i->id_pasien) }}</td>
                                                <td>{{ $i->nomor_antrian }}</td>
                                                <td>{{ get_nama_poli($i->id_poli) }}</td>
                                                <td>
                                                    @if ($i->status_antrian == 2)
                                                        <span class="badge badge-danger">Pending</span>
                                                    @endif
                                                    @if ($i->status_antrian == 1)
                                                        <span class="badge badge-success">Verified</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $i->created_at }}
                                                </td>
                                                {{-- <td class="td-action text-center">
                    <a href="{{ route('pasien.verifikasi',$i->id_antrian) }}"><span class="material-icons text-warning">edit</span></a>
                  </td> --}}
                                            </tr>
                                        @endforeach
                                    @endif

                                    @if (empty($mypasien))
                                        <h1>sdfs</h1>
                                        <tr>
                                            <td colspan="4">
                                                <center>Maaf data Anda Kosong</center>
                                            </td>
                                        </tr>
                                    @endif


                                </tbody>
                            </table>
                        </div>
                    </div>

                @endif


            </div>




        </div>
    </div>



    </div>
@endsection
