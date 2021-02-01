<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- Topbar Navbar -->
  <ul class="navbar-nav ml-auto">

    <!-- Nav Item - Search Dropdown (Hanya dilihat pada ukuran XS) -->
    <li class="nav-item dropdown no-arrow d-sm-none">
      {{-- <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
      </a> --}}
      <!-- Dropdown - Messages -->
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <!-- Nav Item - Pemberitahuan -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-lg"></i>
        <!-- Jika ada notifikasi maka akan muncul tanda merah -->
        @if ($items->isNotEmpty())
          <span class="badge badge-danger badge-counter">{{ $items->count() }}</span>
        @endif
      </a>

      <!-- Dropdown - Pemberitahuan -->
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
          Pemberitahuan
        </h6>
        @forelse ($items as $item)
          <a class="dropdown-item d-flex align-items-center" href="{{ $item->kondisi == 'Baik & Berfungsi' ? route('kendaraan.index') : route('aset-rusak.index') }}">
            <div class="mr-3">
              <div class="icon-circle {{ $item->jatuh_tempo_stnk < $now ? 'bg-danger' : 'bg-warning' }}">
                <i class="fas fa-donate text-white"></i>
              </div>
            </div>
            <div>
              <span class="font-weight-bold">
                Kendaraan dengan no. polisi {{ $item->no_polisi }} {{ $item->jatuh_tempo_stnk < $now ? 'sudah lewat pajak pada' : 'harus segera membayar pajak sebelum' }} {{ Carbon\Carbon::parse($item->jatuh_tempo_stnk )->isoFormat('D MMMM Y') }}
              </span>
            </div>
          </a>
        @empty
            <p class="text-center mt-3">Belum ada pemberitahuan</p>
        @endforelse
        {{-- <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="mr-3">
            <div class="icon-circle bg-danger">
              <i class="fas fa-donate text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500">5 Desember 2020</div>
            <span class="font-weight-bold">Kendaraan dengan no. polisi DB 1234 FC harus membayar pajak sebelum 10 Desember 2020</span>
          </div>
        </a>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="mr-3">
            <div class="icon-circle bg-warning">
              <i class="fas fa-donate text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500">2 Desember 2020</div>
            Kendaraan dengan no. polisi DB 2426 AI harus membayar pajak sebelum 30 Desember 2020
          </div>
        </a>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <div class="mr-3">
            <div class="icon-circle bg-warning">
              <i class="fas fa-donate text-white"></i>
            </div>
          </div>
          <div>
            <div class="small text-gray-500">30 November 2020</div>
            Kendaraan dengan no. polisi DB 3459 CB harus membayar pajak sebelum 10 Desember 2020
          </div>
        </a> --}}
      </div>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - Informasi User -->
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small nama-user">
          {{ Auth::user()->name }}
        </span>
      </a>
    </li>

    <!-- Tombol Log Out -->
    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="modal" data-target="#logoutModal">
        <button class="btn btn-dark" type="button">
          <i class="fas fa-sign-out-alt fa-sm fa-fw text-gray-400"></i>
        </button>
      </a>
    </li>

  </ul>

</nav>
<!-- Akhir Topbar -->