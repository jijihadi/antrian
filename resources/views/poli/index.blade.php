@extends('layouts.app', ['activePage' => 'poli', 'titlePage' => __('Data Poli')])
@csrf
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @if (auth()->user()->role == 1)
                        <div class="card">
                            <div class="card-header card-header-warning">
                                <h4 class="card-title ">Data Poli</h4>
                                <p class="card-category">Mengatur Data Poli dalam bentuk table</p>
                                <p class="text-right"><a href="{{ route('poli.create') }}"
                                        class="btn btn-md btn-info"><span class="material-icons mr-2">add</span>Tambah
                                        Poli</a></p>
                            </div>  

                        

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>
                                                No.
                                            </th>
                                            <th>
                                                Nama Poli
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Tanggal Berdiri
                                            </th>
                                            <th  class="text-center">
                                                #
                                            </th>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $i)
                                                <tr>

                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $i->nama_poli }}
                                                    </td>
                                                    @if ($i->status_poli == 1)
                                                        <td>
                                                            <span class="badge badge-success">Buka</span>
                                                        </td>
                                                    @endif
                                                    @if ($i->status_poli == 0)
                                                        <td>
                                                            <span class="badge badge-danger">Tutup</span>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        {{ $i->created_at }}
                                                    </td>
                                                    <td class="td-action text-center">
                                                        <a href="{{ route('poli.edit', $i->id_poli) }}"><span
                                                                class="material-icons text-warning">edit</span></a>
                                                        <a href="#"><span
                                                                class="material-icons text-danger">delete</span></a>

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
            @endif

            @if (auth()->user()->role == 3)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header card-header-warning">
                                <h4 class="card-title ">Daftar Poli</h4>
                                <p class="card-category">Silahkan Pilih Poli anda untuk mendapatkan nomor antrian </p>

                            </div>
                            <div class="card-body">

            

                                <div class="row">
                                    @foreach ($data as $item)
                                        <div class="col-md-4">
                                            <div class="card card-nav-tabs mt-4 text-center">
                                                <h4 class="card-header card-header-info">{{ $item->nama_poli }}</h4>
                                                <div class="card-body">
                                                    @if ($item->status_poli == 1)
                                                        <h4 class="card-title text-success">{{ $item->nama_poli }} Buka
                                                        </h4>
                                                    @endif
                                                    @if ($item->status_poli == 0)
                                                        <h4 class="card-title text-danger">{{ $item->nama_poli }} Tutup
                                                        </h4>
                                                    @endif

                                                </div>
                                                <div class="card-footer text-center">
                                                    @if ($item->status_poli == 1)
                                                        <button data-id="{{ $item->id_poli }}"
                                                            data-name="{{ substr($item->nama_poli, 5, 3) }}"
                                                            class="btn btn-primary text-center tambah_antrian">Daftar
                                                            Poli</button>
                                                    @endif
                                                    @if ($item->status_poli == 0)
                                                        <a href="#0" onclick="md.showNotification('top','center')"
                                                            class="btn btn-danger text-center">Poli Tutup</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            @endif


        </div>
    </div>
    </div>



    </div>
@endsection
