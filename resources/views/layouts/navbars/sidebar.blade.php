<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{url('/')}}" class="simple-text logo-normal">
      <img src="{{url('material/img/logo-full.png')}}" style="max-height:3.5em"/> 
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Beranda') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
        <i class="material-icons">manage_accounts</i>
      
          <p>{{ __('Akun') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('Profil Pengguna') }} </span>
              </a>
            </li>
            @if(auth()->user()->role == 1)
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('Data Pengguna') }} </span>
              </a>
            </li>
            @endif
          </ul>
        </div>
      </li>
      
      @if(auth()->user()->role == 1 || auth()->user()->role == 3)
      <li class="nav-item{{ $activePage == 'poli' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('poli.index') }}">
          <i class="material-icons">view_list</i>
            <p>{{ __('Daftar Poli') }}</p>
        </a>
      </li>
      @endif
      <li class="nav-item{{ $activePage == 'pasien' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('pasien.index') }}">
          <i class="material-icons">supervised_user_circle</i>
            <p>{{ __('Data Pasien') }}</p>
        </a>
      </li>
      @if(auth()->user()->role == 1 || auth()->user()->role == 2)
      <li class="nav-item{{ $activePage == 'list_antrian' ? ' active' : '' }}">
        <a class="nav-link" href="{{ url('list_antrian') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Daftar Pendaftar') }}</p>
        </a>
      </li>
      @endif
      <li class="nav-item{{ $activePage == 'antrian' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('antrian.index') }}">
          <i class="material-icons">list</i>
          <p>{{ __('Informasi Nomor Antrian') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'riwayat' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('riwayat.index') }}">
          <i class="material-icons">history</i>
          <p>{{ __('Riwayat') }}</p>
        </a>
      </li>
      @if(auth()->user()->role != 3)
      <li class="nav-item{{ $activePage == 'report_poli' ? ' active' : '' }}">
        <a class="nav-link" href="{{ url('report_poli') }}">
          <i class="material-icons">note_alt</i>
            <p>{{ __('Laporan Poli') }}</p>
        </a>
      </li>
      @endif
      
    </ul>
  </div>
</div>
