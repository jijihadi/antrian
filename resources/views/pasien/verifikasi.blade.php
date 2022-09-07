@extends('layouts.app', ['activePage' => 'pasien', 'titlePage' => __('Verifikasi Data Pasien')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-warning">
                            <h4 class="card-title ">Verifikasi Data Pasien</h4>
                            <p class="card-category">Silahkan verifikasi Data Pasien untuk mengaktifkan antrian</p>

                        </div>
                        <div class="card-body">

                            <?php $url = Request::segment(2); ?>

                            <form action="{{ route('pasien.verifikasi-update', $url) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="nama_poli">Nama Pasien</label>
                                    <input type="text" class="form-control" id="nama_pasien" readonly
                                        aria-describedby="emailHelp" name="nama_poli" placeholder="Isikan nama poli"
                                        value="{{ get_nama_pasien($antrian[0]->id_pasien) }}">
                                </div>

                                <div class="form-group">
                                    <label for="nik">Nik</label>
                                    <input type="text" class="form-control" id="nik" readonly
                                        aria-describedby="emailHelp" name="nik" placeholder="Isikan nama poli"
                                        value="{{ $antrian[0]->nik }}">
                                </div>
                                <div class="form-group">
                                    <label for="poli">Poli Yang di tuju</label>
                                    <input type="text" class="form-control" id="poli" readonly
                                        aria-describedby="emailHelp" name="poli" placeholder="Isikan nama poli"
                                        value="{{ get_nama_poli($antrian[0]->id_poli) }}">
                                </div>
                                <div class="form-group">
                                    <label for="antrian">Nomor Antrian</label>
                                    <input type="text" class="form-control" id="antrian" readonly name="antrian"
                                        placeholder="Isikan nama poli" value="{{ $antrian[0]->nomor_antrian }}">
                                </div>
                                <div class="form-group">
                                    <label for="status_antrian">Status Antrian ( @if ($antrian[0]->status_antrian == 2)
                                            <span class="badge badge-danger">Pending</span>
                                        @endif
                                        @if ($antrian[0]->status_antrian == 1)
                                            <span class="badge badge-success">Aktif</span>
                                        @endif
                                        )
                                    </label>
                                    <select class="form-control" id="status_antrian" name="status_antrian" required>
                                        <option value="">-- Edit Status Antrian --</option>
                                        <option value="1">Aktif</option>
                                        <option value="2">Pending</option>
                                    </select>
                                </div>


                                <button type="submit" class="btn btn-primary">Verifikasi</button>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
@endsection
