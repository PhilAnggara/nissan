@extends('layouts.app')

@section('title')
    Aset Kantor
@endsection

@section('content')
  <!-- Awal Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Aset Kantor</h1>

      <!-- Search -->
      {{-- <form class="d-none d-sm-inline-block form-inline mr-3 ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('kantor.index') }}">
        <div class="input-group">
          <input type="text" class="form-control bg-white border-1 small" placeholder="Cari..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" name="cari" id="search" value="{{$keyword}}">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit" id="tombol-cari">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form> --}}

      {{-- Jika Roles = admin maka akan ada tombol Tambah Data --}}
      @if (auth()->user()->roles == 'admin')
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success ml-auto" data-toggle="modal" data-target="#tambahModal">
          <i class="fas fa-plus fa-sm text-white"></i>
          Tambah Data
        </button>
      @endif
      
      <a type="button" target="_blank" class="btn btn-info ml-2" href="{{ route('cetak-kantor') }}">
        <i class="fas fa-print fa-sm text-white"></i>
        Cetak
      </a>

  </div>

    <div class="card mt-3 border-left-dark shadow">
      <div class="card-body">
        <div class="table-responsive" id="hasil-cari">
          <table class="table table-bordered bg-white text-center" width="100%" cellspacing="0" id="dataTable">
            <thead class="bg-secondary text-white">
              <tr>
                <th>Nama Aset</th>
                <th>Nomor Aset</th>
                <th>Informasi</th>
                <th>Tahun Beli</th>
                <th>Pengguna</th>
                <th>Nilai Perolehan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                <tr>
                  <td>{{ $item->nama_aset }}</td>
                  <td>{{ $item->nomor_aset }}</td>
                  <td>{{ $item->informasi }}</td>
                  <td>{{ $item->tahun_perolehan }}</td>
                  <td>{{ $item->user }}</td>
                  <td>{{ number_format($item->nilai_perolehan, 0, ',', '.') }}</td>
                  <td style="width: 100px !important;">
                    <div class="text-center">
                      @if ( auth()->user()->roles == 'admin' )
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal-{{ $item->id }}">
                          <i class="fa fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal-{{ $item->id }}">
                          <i class="fa fa-pencil-alt"></i>
                        </button>
                        {{-- <form action="{{ route('kantor.destroy', $item->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('delete')
                          <button class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form> --}}
                      @else
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal-{{ $item->id }}">
                          Detail
                        </button>
                      @endif                    
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <th colspan="10" class="text-center">
                    Data Kosong
                  </th>
                </tr>
                @endforelse
            </tbody>
          </table>
          {{-- {{$items->links()}} --}}
        </div>

      </div>
    </div>
    
  </div>
  <!-- /.container-fluid -->

  <!-- Modal Tambah Data -->
  <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <div class="card shadow">
            <div class="card-body">
              <form action="{{ route('kantor.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="nama_pt">Nama PT</label>
                  <input type="text" class="form-control" name="nama_pt" placeholder="Nama PT" value="{{ old('nama_pt') }}">
                </div>
                <div class="form-group">
                  <label for="nama_cabang">Nama Cabang</label>
                  <input type="text" class="form-control" name="nama_cabang" placeholder="Nama Cabang" value="{{ old('nama_cabang') }}">
                </div>
                <div class="form-group">
                  <label for="nama_aset">Nama Aset</label>
                  <input type="text" class="form-control" name="nama_aset" placeholder="Nama Aset" value="{{ old('nama_aset') }}">
                </div>
                <div class="form-group">
                  <label for="nomor_aset">Nomor Aset by DMS</label>
                  <input type="text" class="form-control" name="nomor_aset" placeholder="Nomor Aset by DMS" value="{{ old('nomor_aset') }}">
                </div>
                <div class="form-group">
                  <label for="informasi">Informasi</label>
                  <input type="text" class="form-control" name="informasi" placeholder="Informasi" value="{{ old('informasi') }}">
                </div>
                <div class="form-group">
                  <label for="tahun_perolehan">Tahun Perolehan</label>
                  <input type="number" class="form-control" name="tahun_perolehan" placeholder="Tahun Perolehan" value="{{ old('tahun_perolehan') }}">
                </div>
                <div class="form-group">
                  <label for="user">Pengguna</label>
                  <input type="text" class="form-control" name="user" placeholder="Pengguna" value="{{ old('user') }}">
                </div>
                <div class="form-group">
                  <label for="nilai_perolehan">Nilai Perolehan</label>
                  <input type="number" class="form-control" name="nilai_perolehan" placeholder="Nilai Perolehan" value="{{ old('nilai_perolehan') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                  Simpan
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Detail -->
  @foreach ($items as $detail)
  <div class="modal fade" id="detailModal-{{ $detail->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModalLabel">Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card shadow">
            <div class="card-body">
              <table class="table bg-white" width="100%" cellspacing="0">
                <tbody>
                  <tr>
                    <th>Nama PT</th>
                    <td>{{ $detail->nama_pt }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Nama Cabang</th>
                    <td>{{ $detail->nama_cabang }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Nama Aset</th>
                    <td>{{ $detail->nama_aset }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Nomor Aset by DMS</th>
                    <td>{{ $detail->nomor_aset }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Kondisi Aset</th>
                    <td>{{ $detail->kondisi }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Informasi</th>
                    <td>{{ $detail->informasi }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Pengguna</th>
                    <td>{{ $detail->user }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Tahun Perolehan</th>
                    <td>{{ $detail->tahun_perolehan }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Nilai Perolehan</th>
                    <td>{{ number_format($item->nilai_perolehan, 0, ',', '.') }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach

  <!-- Modal Edit -->
  @foreach ($items as $edit)
  <div class="modal fade" id="editModal-{{ $edit->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <div class="card shadow">
            <div class="card-body">
              <form action="{{ route('kantor.update', $edit->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="nama_pt">Nama PT</label>
                  <input type="text" class="form-control" name="nama_pt" placeholder="Nama PT" value="{{ $edit->nama_pt }}">
                </div>
                <div class="form-group">
                  <label for="nama_cabang">Nama Cabang</label>
                  <input type="text" class="form-control" name="nama_cabang" placeholder="Nama Cabang" value="{{ $edit->nama_cabang }}">
                </div>
                <div class="form-group">
                  <label for="nama_aset">Nama Aset</label>
                  <input type="text" class="form-control" name="nama_aset" placeholder="Nama Aset" value="{{ $edit->nama_aset }}">
                </div>
                <div class="form-group">
                  <label for="nomor_aset">Nomor Aset by DMS</label>
                  <input type="text" class="form-control" name="nomor_aset" placeholder="Nomor Aset by DMS" value="{{ $edit->nomor_aset }}">
                </div>
                <div class="form-group">
                  <label for="informasi">Informasi</label>
                  <input type="text" class="form-control" name="informasi" placeholder="Informasi" value="{{ $edit->informasi }}">
                </div>
                <div class="form-group">
                  <label for="tahun_perolehan">Tahun Perolehan</label>
                  <input type="number" class="form-control" name="tahun_perolehan" placeholder="Tahun Perolehan" value="{{ $edit->tahun_perolehan }}">
                </div>
                <div class="form-group">
                  <label for="user">Pengguna</label>
                  <input type="text" class="form-control" name="user" placeholder="Pengguna" value="{{ $edit->user }}">
                </div>
                <div class="form-group">
                  <label for="nilai_perolehan">Nilai Perolehan</label>
                  <input type="number" class="form-control" name="nilai_perolehan" placeholder="Nilai Perolehan" value="{{ $edit->nilai_perolehan }}">
                </div>
                <div class="form-group">
                  <label for="kondisi">Kondisi Aset</label>
                  <select name="kondisi" required class="form-control">
                    <option value="{{ $edit->kondisi }}">-- Ganti Status --</option>
                    <option value="Baik & Berfungsi">Baik & Berfungsi</option>
                    <option value="Rusak">Rusak</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                  Ubah
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach

@endsection

@push('addon-script')
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
    });
  </script>
@endpush

{{-- @push('addon-script')
  <script>
      // Ambil elemen" yang dibutuhkan
      var keyword = document.getElementById('keyword');
      var tombolCari = document.getElementById('tombol-cari');
      var hasilCari = document.getElementById('hasil-cari');

      // Tambahkan event ketika keyword ditulis
      keyword.addEventListener('keyup', function() {
        
        // Buat object ajax
        var xhr = new XMLHttpRequest();

        // Cek kesiapan ajax
        xhr.onreadystatechange = function() {
          if( xhr.readyState == 4 && xhr.status == 200 ) {
            hasilCari.innerHTML = xhr.responseText;
          }
        }

        // Eksekusi ajax
        xhr.open('GET', '../frontend/scripts/cariKantor.php?keyword=' + keyword.value, true);
        xhr.send();
        
      });
  </script>
@endpush --}}