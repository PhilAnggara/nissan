@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
  <!-- Awal Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard {{ Auth::user()->name }}</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

      <!-- Pengajuan Aset Rusak -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-dark shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Pengajuan Aset Rusak</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rusak }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-minus-circle fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pengajuan Aset Baru -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-dark shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pengajuan Aset Baru</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pengajuan }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-plus-circle fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Aset yang Harus Segera Bayar Pajak -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-dark shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Harus Bayar Pajak</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pajak }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Jumlah Total Aset -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-bottom-dark shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Jumlah Aset</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->
@endsection