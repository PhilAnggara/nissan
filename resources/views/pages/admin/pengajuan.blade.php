@extends('layouts.app')

@section('title')
    Aset Kantor
@endsection

@section('content')
  <!-- Awal Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Permintaan Aset Yang Diajukan</h1>

      <!-- Search -->
      {{-- <form class="d-none d-sm-inline-block form-inline mr-3 ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('pengajuan-aset.index') }}">
        <div class="input-group">
          <input type="text" class="form-control bg-white border-1 small" placeholder="Cari..." aria-label="Search" aria-describedby="basic-addon2" autocomplete="off" name="cari" id="search" value="{{$keyword}}">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit" id="tombol-cari">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form> --}}

      {{-- Jika Roles = admin maka akan ada tombol Ajukan Permintaan Aset --}}
      @if (auth()->user()->roles == 'admin')
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success ml-auto" data-toggle="modal" data-target="#tambahModal">
          <i class="fas fa-plus fa-sm text-white"></i>
          Ajukan Permintaan Aset    
        </button>
      @endif
      
      <a type="button" target="_blank" class="btn btn-info ml-2" href="{{ route('cetak-pengajuan') }}">
        <i class="fas fa-print fa-sm text-white"></i>
        Cetak
      </a>
      
  </div>

    <div class="card mt-3 border-left-dark shadow">
      <div class="card-body">
        <h6 class="font-weight-bold text-center"><i class="fa fa-spinner text-warning"></i> Pengajuan Diproses</h6>
        <div class="table-responsive">
          <table class="table table-bordered bg-white text-center" width="100%" cellspacing="0" id="dataTable">
            <thead class="bg-secondary text-white">
              <tr>
                <th>Nama Barang</th>
                <th>Pengguna</th>
                <th>Jumlah</th>
                <th>Kisaran Harga</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($items as $item)
                <tr>
                  <td>{{ $item->nama_barang }}</td>
                  <td>{{ $item->user }}</td>
                  <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                  <td>{{ number_format($item->kisaran, 0, ',', '.') }}</td>
                  <td>{{ $item->keterangan }}</td>
                  <td style="width: 130px !important;">
                    <div class="text-center">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal-{{ $item->id }}">
                        <i class="fa fa-eye"></i>
                      </button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal-{{ $item->id }}">
                        <i class="fa fa-pencil-alt"></i>
                      </button>
                      @if ( auth()->user()->roles == 'admin' )
                        <form action="{{ route('pengajuan-aset.destroy', $item->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('delete')
                          <button class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
                      @endif
                      @if ( auth()->user()->roles == 'staf' )
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#alasanModal-{{ $item->id }}">
                          <i class="fa fa-times"></i>
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
        </div>
      </div>
    </div>

    <div class="card mt-3 border-left-dark shadow">
      <div class="card-body">
        <h6 class="font-weight-bold text-center"><i class="fa fa-check text-success"></i> Pengajuan Disetujui</h6>
        <div class="table-responsive">
          <table class="table table-bordered bg-white text-center" width="100%" cellspacing="0" id="dataTable2">
            <thead  class="bg-secondary text-white">
              <tr>
                <th>Nama Barang</th>
                <th>Pengguna</th>
                <th>Jumlah</th>
                <th>Kisaran Harga</th>
                <th>Keterangan</th>
                @if ( auth()->user()->roles == 'staf' )
                  <th>Aksi</th>
                @endif
              </tr>
            </thead>
            <tbody>
                @forelse ($things as $thing)
                <tr>
                  <td>{{ $thing->nama_barang }}</td>
                  <td>{{ $thing->user }}</td>
                  <td>{{ number_format($thing->jumlah, 0, ',', '.') }}</td>
                  <td>{{ number_format($thing->kisaran, 0, ',', '.') }}</td>
                  <td>{{ $thing->keterangan }}</td>
                  @if ( auth()->user()->roles == 'staf' )
                    <td style="width: 70px !important;">
                      <div class="text-center">
                        <form action="{{ route('pengajuan-aset.destroy', $thing->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('delete')
                          <button class="btn btn-success btn-sm">
                            <i class="fa fa-check"></i>
                          </button>
                        </form>
                      </div>
                    </td>
                  @endif
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
        </div>
      </div>
    </div>

    <div class="card mt-3 border-left-dark shadow">
      <div class="card-body">
        <h6 class="font-weight-bold text-center"><i class="fa fa-times text-danger"></i> Pengajuan Ditolak</h6>
        <div class="table-responsive">
          <table class="table table-bordered bg-white text-center" width="100%" cellspacing="0" id="dataTable3">
            <thead class="bg-secondary text-white">
              <tr>
                <th>Nama Barang</th>
                <th>Pengguna</th>
                <th>Jumlah</th>
                <th>Kisaran Harga</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($rejects as $reject)
                <tr>
                  <td>{{ $reject->nama_barang }}</td>
                  <td>{{ $reject->user }}</td>
                  <td>{{ number_format($reject->jumlah, 0, ',', '.') }}</td>
                  <td>{{ number_format($reject->kisaran, 0, ',', '.') }}</td>
                  <td>{{ $reject->keterangan }}</td>
                  <td style="width: 75px !important;">
                    <div class="text-center">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal2-{{ $reject->id }}">
                        <i class="fa fa-info-circle"></i>
                      </button>
                      <form action="{{ route('pengajuan-aset.destroy', $reject->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>
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
              <form action="{{ route('pengajuan-aset.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="nama_barang">Nama Barang</label>
                  <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" value="{{ old('nama_barang') }}">
                </div>
                <div class="form-group">
                  <label for="user">Pengguna</label>
                  <input type="text" class="form-control" name="user" placeholder="Pengguna" value="{{ old('user') }}">
                </div>
                <div class="form-group">
                  <label for="jumlah">Jumlah</label>
                  <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" value="{{ old('jumlah') }}">
                </div>
                <div class="form-group">
                  <label for="kisaran">Kisaran Harga</label>
                  <input type="number" class="form-control" name="kisaran" placeholder="Kisaran Harga" value="{{ old('kisaran') }}">
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                  Ajukan
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
                    <th>Nama Barang</th>
                    <td>{{ $detail->nama_barang }}</td>
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
                    <th>Jumlah</th>
                    <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Kisaran Harga</th>
                    <td>{{ number_format($item->kisaran, 0, ',', '.') }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Keterangan</th>
                    <td>{{ $detail->keterangan }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Status</th>
                    <td>{{ $detail->status }}</td>
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

  <!-- Modal Detail Alasan -->
  @foreach ($rejects as $detail)
  <div class="modal fade" id="detailModal2-{{ $detail->id }}" tabindex="-1" aria-labelledby="detailModal2Label" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailModal2Label">Alasan Ditolak</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ $detail->alasan }}
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
              <form action="{{ route('pengajuan-aset.update', $edit->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="nama_barang">Nama Barang</label>
                  <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" value="{{ $edit->nama_barang }}">
                </div>
                <div class="form-group">
                  <label for="user">Pengguna</label>
                  <input type="text" class="form-control" name="user" placeholder="Pengguna" value="{{ $edit->user }}">
                </div>
                <div class="form-group">
                  <label for="jumlah">Jumlah</label>
                  <input type="number" class="form-control" name="jumlah" placeholder="Jumlah" value="{{ $edit->jumlah }}">
                </div>
                <div class="form-group">
                  <label for="kisaran">Kisaran Harga</label>
                  <input type="number" class="form-control" name="kisaran" placeholder="Kisaran Harga" value="{{ $edit->kisaran }}">
                </div>
                <div class="form-group">
                  <label for="keterangan">Keterangan</label>
                  <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="{{ $edit->keterangan }}">
                </div>
                @if ( auth()->user()->roles == 'staf' )
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" required class="form-control">
                      <option value="{{ $edit->status }}">-- Ganti Status --</option>
                      <option value="Diproses">Diproses</option>
                      <option value="Disetujui">Disetujui</option>
                    </select>
                  </div>             
                @endif
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

  <!-- Modal Alasan -->
  @foreach ($items as $edit)
  <div class="modal fade" id="alasanModal-{{ $edit->id }}" tabindex="-1" aria-labelledby="alasanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="alasanModalLabel">Tolak</h5>
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

          <form action="{{ route('pengajuan-aset.update', $edit->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
              <label for="alasan">Alasan Penolakan</label>
              <textarea type="text" class="form-control" name="alasan" placeholder="" value="{{ $edit->alasan }}" rows="3"></textarea>
              <input type="hidden" class="form-control" name="status" placeholder="Ditolak" value="Ditolak">
            </div>
            <button type="submit" class="btn btn-danger btn-block">
              Tolak
            </button>
          </form>
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
      $('#dataTable2').DataTable();
      $('#dataTable3').DataTable();
    });
  </script>
@endpush