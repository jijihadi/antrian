@extends('layouts.app', ['activePage' => 'poli', 'titlePage' => __('Tambah Data Poli')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title ">Tambah Data Poli</h4>
            <p class="card-category">Isikan Data Poli</p>
            
          </div>
          <div class="card-body">
          <form action="{{ route('poli.store') }}" method="post">
            @csrf
            
          <div class="form-group">
    <label for="nama_poli">Nama Poli</label>
    <input type="text" class="form-control" id="nama_poli" aria-describedby="emailHelp" name="nama_poli" placeholder="Isikan nama poli">
  
  </div>
 

  <button type="submit" class="btn btn-primary">Buat Poli</button>
        </form>
          </div>
        </div>
      </div>
    

      </div>
    </div>
  </div>
</div>
@endsection