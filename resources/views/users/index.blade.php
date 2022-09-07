@extends('layouts.app', ['activePage' => 'user-management', 'titlePage' => __('Data Petugas')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title ">Data Petugas</h4>
                            <p class="card-category">Mengatur Data Petugas dalam bentuk table</p>
                            <p class="text-right"><a href="{{ route('user.create') }}" class="btn btn-md btn-info"><span
                                        class="material-icons mr-2">add</span>Tambah Petugas</a></p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            No
                                        </th>
                                        <th>
                                            Nama
                                        </th>
                                        <th>
                                            NIK
                                        </th>
                                        <th>
                                            Jabatan
                                        </th>
                                        <th>
                                            Tanggal Dibuat
                                        </th>
                                        <th  class="text-center">
                                            Action
                                        </th>
                                    </thead>
                                    <tbody>
                                        @if (empty($data))
                                            Data Kosong
                                        @endif
                                        @if (!empty($data))
                                            @foreach ($data as $i)
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
                                                    @if ($i->role == 2)
                                                        <td>
                                                            <span class="badge badge-success">Petugas</span>
                                                        </td>
                                                    @endif

                                                    <td>
                                                        {{ $i->created_at }}
                                                    </td>
                                                    <td class="td-action text-center">

                                                        <a href="#"><span
                                                                class="material-icons text-danger">delete</span></a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

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
