<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="{{ url('frontend/images/logo.png') }}">
  <title>@yield('title')</title>
  @stack('prepend-style')
  @include('includes.admin.style')
  @stack('addon-style')
</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    @include('includes.admin.sidebar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        @include('includes.admin.navbar', ['items' => App\Models\Kendaraan::where('jatuh_tempo_stnk', '<' , Carbon\Carbon::now()->addDays(30))->get()], ['now' => Carbon\Carbon::now()])
        @yield('content')

      </div>
      <!-- Akhir Main Content -->

      @include('includes.admin.footer')

    </div>
    <!-- Akhir Content Wrapper -->

  </div>
  <!-- Akhir Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anda Ingin Keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih tombol "Keluar" di bawah jika anda siap untuk mengakhiri sesi Anda saat ini.</div>
        <div class="modal-footer">
          <form action="{{ url('logout') }}" method="POST">
            @csrf
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
            <button class="btn btn-primary" type="submit">Keluar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  @stack('prepend-script')
  @include('includes.admin.script')
  @stack('addon-script')
</body>
</html>