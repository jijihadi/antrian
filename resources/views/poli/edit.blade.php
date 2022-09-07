@extends('layouts.app', ['activePage' => 'poli', 'titlePage' => __('Edit Data Poli')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title ">Edit Data Poli</h4>
            <p class="card-category">Silahkan Edit Data Poli dengan benar</p>
            
          </div>
          <div class="card-body">
        
                    <?php $url = Request::segment(2) ?>
               
          <form action="{{ route('poli.update',$url) }}" method="post">
            @csrf
            @method('put')
            
            
          <div class="form-group">
    <label for="nama_poli">Nama Poli</label>
    <input type="text" class="form-control" id="nama_poli" aria-describedby="emailHelp" name="nama_poli" placeholder="Isikan nama poli" value="{{ $data[0]->nama_poli }}">
        </div>
        <div class="form-group">
            <label for="status_poli">Status Poli ( <span class="badge badge-info">{{ status_poli($data[0]->id_poli) }}</span> )</label>
            <select class="form-control" id="status_poli" name="status_poli" required>
            <option value="">-- Edit Status -- </option>
            <option value="1">Buka</option>
            <option value="0">Tutup</option>
            </select>
        </div>
 

        <button type="submit" class="btn btn-primary">Edit Poli</button>
        </form>
          </div>
        </div>
      </div>
    

      </div>
    </div>
  </div>
</div>
@endsection