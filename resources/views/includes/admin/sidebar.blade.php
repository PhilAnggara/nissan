<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
    <div class="sidebar-brand-icon">
      <img class="nissan" src="{{ url('frontend/images/logo.png') }}" alt="">
    </div>
    <div class="sidebar-brand-text mx-3 logo">PT. Wahana Wirawan Manado</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{ Request::path() === 'admin' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Data Aset
  </div>

  <!-- Nav Item - Kendaraan -->
  <li class="nav-item {{ request()->path() == 'admin/kendaraan' ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('kendaraan.index') }}">
      <i class="fas fa-fw fa-car-side"></i>
      <span>Kendaraan</span></a>
  </li>

  <!-- Nav Item - Peralatan Bengkel -->
  <li class="nav-item {{ Request::is('admin/peralatan') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('peralatan.index') }}">
      <i class="fas fa-fw fa-wrench"></i>
      <span>Peralatan Bengkel</span></a>
  </li>

  <!-- Nav Item - Kantor -->
  <li class="nav-item {{ Request::is('admin/kantor') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('kantor.index') }}">
      <i class="fas fa-fw fa-tv"></i>
      <span>Kantor</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Pengajuan Data Aset -->
  <li class="nav-item  {{ Request::is('admin/pengajuan-aset') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('pengajuan-aset.index') }}">
      <i class="fas fa-fw fa-cart-plus"></i>
      <span>{{ auth()->user()->roles == 'admin' ? 'Ajukan Permintaan Aset' : 'Permintaan Aset' }}</span></a>
  </li>
  
  <!-- Nav Item - Aset Rusak -->
  <li class="nav-item  {{ Request::is('admin/aset-rusak') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('aset-rusak.index') }}">
      <i class="fas fa-fw fa-minus-circle"></i>
      <span>Aset Rusak</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- Akhir Sidebar -->