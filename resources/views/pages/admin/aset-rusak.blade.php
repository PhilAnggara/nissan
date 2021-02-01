@extends('layouts.app')

@section('title')
    Aset Rusak
@endsection

@section('content')
  <!-- Awal Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Aset Rusak</h1>

      <!-- Search -->
    {{-- <form class="d-none d-sm-inline-block form-inline mr-3 ml-md-3 my-2 my-md-0 mw-100 navbar-search">
      <div class="input-group">
        <input type="text" class="form-control bg-white border-1 small" placeholder="Cari..." aria-label="Search" aria-describedby="basic-addon2" autofocus autocomplete="off">
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form> --}}
    </div>

    {{-- Aset Kendaraan Rusak --}}
    <div class="card mt-3 border-left-dark shadow">
      <div class="card-body">
        <h6 class="font-weight-bold text-center"><i class="fa fa-car-side"></i> Aset Kendaraan Rusak</h6>
        <div class="table-responsive">
          <table class="table table-bordered bg-white text-center" width="100%" cellspacing="0" id="dataTable">
            <thead class="bg-secondary text-white">
              <tr>
                <th>Area</th>
                <th>Merk</th>
                <th>Model</th>
                <th>No. Polisi</th>
                <th>Warna</th>
                <th>Status Pajak</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($kendaraan as $item)
                <tr>
                  <td>{{ $item->area }}</td>
                  <td>{{ $item->merk }}</td>
                  <td>{{ $item->model }}</td>
                  <td>{{ $item->no_polisi }}</td>
                  <td>{{ $item->warna }}</td>
                  <td>
                    @if ( Carbon\Carbon::parse($item->jatuh_tempo_stnk)->subDays(30) > Carbon\Carbon::now() )
                      <div class="text-center text-success">
                        <i class="fa fa-circle text-success}"></i>
                        {{ \Carbon\Carbon::parse($item->jatuh_tempo_stnk)->diffForHumans() }}
                      </div>
                    @elseif( $item->jatuh_tempo_stnk < Carbon\Carbon::now() )
                      <div class="text-center text-danger">
                        <i class="fa fa-circle text-danger}"></i>
                        {{ \Carbon\Carbon::parse($item->jatuh_tempo_stnk)->diffForHumans() }}
                      </div>
                    @elseif( Carbon\Carbon::parse($item->jatuh_tempo_stnk)->subDays(30) < Carbon\Carbon::now() )
                      <div class="text-center text-warning">
                        <i class="fa fa-circle text-warning}"></i>
                        {{ \Carbon\Carbon::parse($item->jatuh_tempo_stnk)->diffForHumans() }}
                      </div>
                    @endif
                  </td>
                  <td style="width: {{ auth()->user()->roles == 'staf' ? 130 : 100 }}px !important;">
                    <div class="text-center">
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailKendaraanModal-{{ $item->id }}">
                        <i class="fa fa-eye"></i>
                      </button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editKendaraanModal-{{ $item->id }}">
                        <i class="fa fa-pencil-alt"></i>
                      </button>
                      @if ( auth()->user()->roles == 'staf' )
                        <form action="{{ route('destroy-kendaraan', $item->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('delete')
                          <button class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
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

    @foreach ($kendaraan as $detail)
  <!-- Modal Detail Kendaraan -->
  <div class="modal fade" id="detailKendaraanModal-{{ $detail->id }}" tabindex="-1" aria-labelledby="detailKendaraanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailKendaraanModalLabel">Detail</h5>
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
                    <th>Area</th>
                    <td>{{ $detail->area }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Merk</th>
                    <td>{{ $detail->merk }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Model</th>
                    <td>{{ $detail->model }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Isi Silinder</th>
                    <td>{{ $detail->isi_silinder }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Jenis Transmisi</th>
                    <td>{{ $detail->transmisi }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>No. Polisi</th>
                    <td>{{ $detail->no_polisi }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Tahun Produksi</th>
                    <td>{{ $detail->tahun_produksi }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Warna</th>
                    <td>{{ $detail->warna }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>No. Chasis</th>
                    <td>{{ $detail->no_chasis }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>No. Engine</th>
                    <td>{{ $detail->no_engine }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Tanggal Jatuh Tempo STNK</th>
                    <td>{{ Carbon\Carbon::parse($detail->jatuh_tempo_stnk )->isoFormat('D MMMM Y') }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Waktu Pembelian</th>
                    <td>{{ Carbon\Carbon::parse($detail->waktu_pembelian)->isoFormat('MMMM Y') }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Harga Perolehan</th>
                    <td>Rp{{ number_format($detail->harga_perolehan, 0, ',', '.') }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>NBV per_2020 *)</th>
                    <td>{{ number_format($detail->nvb, 0, ',', '.') }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Kondisi Aset</th>
                    <td>{{ $detail->kondisi }}</td>
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

  @foreach ($kendaraan as $edit)
  <!-- Modal Edit Kendaraan -->
  <div class="modal fade" id="editKendaraanModal-{{ $edit->id }}" tabindex="-1" aria-labelledby="editKendaraanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editKendaraanModalLabel">Edit</h5>
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
              <form action="{{ route('update-kendaraan', $edit->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="area">Area</label>
                  <input type="text" class="form-control" name="area" placeholder="Area" value="{{ $edit->area }}">
                </div>
                <div class="form-group">
                  <label for="merk">Merk</label>
                  <input type="text" class="form-control" name="merk" placeholder="Merk" value="{{ $edit->merk }}">
                </div>
                <div class="form-group">
                  <label for="model">Model</label>
                  <input type="text" class="form-control" name="model" placeholder="Model" value="{{ $edit->model }}">
                </div>
                <div class="form-group">
                  <label for="isi_silinder">Isi Silinder</label>
                  <input type="number" class="form-control" name="isi_silinder" placeholder="Isi Silinder" value="{{ $edit->isi_silinder }}">
                </div>
                <div class="form-group">
                  <label for="transmisi">Jenis Transmisi</label>
                  <input type="text" class="form-control" name="transmisi" placeholder="Jenis Transmisi" value="{{ $edit->transmisi }}">
                </div>
                <div class="form-group">
                  <label for="no_polisi">No. Polisi</label>
                  <input type="text" class="form-control" name="no_polisi" placeholder="No. Polisi" value="{{ $edit->no_polisi }}">
                </div>
                <div class="form-group">
                  <label for="tahun_produksi">Tahun Produksi</label>
                  <input type="number" class="form-control" name="tahun_produksi" placeholder="Tahun Produksi" value="{{ $edit->tahun_produksi }}">
                </div>
                <div class="form-group">
                  <label for="warna">Warna</label>
                  <input type="text" class="form-control" name="warna" placeholder="Warna" value="{{ $edit->warna }}">
                </div>
                <div class="form-group">
                  <label for="no_chasis">No. Chasis</label>
                  <input type="text" class="form-control" name="no_chasis" placeholder="No. Chasis" value="{{ $edit->no_chasis }}">
                </div>
                <div class="form-group">
                  <label for="no_engine">No. Engine</label>
                  <input type="text" class="form-control" name="no_engine" placeholder="No. Engine" value="{{ $edit->no_engine }}">
                </div>
                <div class="form-group">
                  <label for="jatuh_tempo_stnk">Jatuh Tempo STNK</label>
                  <input type="date" class="form-control" name="jatuh_tempo_stnk" placeholder="Jatuh Tempo STNK" value="{{ $edit->jatuh_tempo_stnk }}">
                </div>
                <div class="form-group">
                  <label for="waktu_pembelian">Waktu Pembelian</label>
                  <input type="date" class="form-control" name="waktu_pembelian" placeholder="Waktu Pembelian" value="{{ $edit->waktu_pembelian }}">
                </div>
                <div class="form-group">
                  <label for="harga_perolehan">Harga Perolehan</label>
                  <input type="number" class="form-control" name="harga_perolehan" placeholder="Harga Perolehan" value="{{ $edit->harga_perolehan }}">
                </div>
                <div class="form-group">
                  <label for="nvb">NVB per _ 2020 *)</label>
                  <input type="number" class="form-control" name="nvb" placeholder="NVB per _ 2020 *)" value="{{ $edit->nvb }}">
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


    {{-- Aset Peralatan Bengkel Rusak --}}
    <div class="card mt-3 border-left-dark shadow">
      <div class="card-body">
        <h6 class="font-weight-bold text-center"><i class="fa fa-wrench"></i> Aset Peralatan Bengkel Rusak</h6>
        <div class="table-responsive">
          <table class="table table-bordered bg-white text-center" width="100%" cellspacing="0" id="dataTable2">
            <thead class="bg-secondary text-white">
              <tr>
                <th>Area</th>
                <th>Jenis Aset</th>
                <th>Tahun Perolehan</th>
                <th>Nilai Perolehan</th>
                <th>Nilai Buku</th>
                <th>Pengguna</th>
                <th>Status di Laporan Keuangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($peralatan as $item)
                <tr>
                  <td>{{ $item->area }}</td>
                  <td>{{ $item->jenis_aset }}</td>
                  <td>{{ $item->tahun_perolehan }}</td>
                  <td>{{ number_format($item->nilai_perolehan, 0, ',', '.') }}</td>
                  <td>{{ number_format($item->nilai_buku, 0, ',', '.') }}</td>
                  <td>{{ $item->user }}</td>
                  <td>{{ $item->status }}</td>
                  <td style="width: {{ auth()->user()->roles == 'staf' ? 130 : 100 }}px !important;">
                    <div class="text-center">
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailPeralatanModal-{{ $item->id }}">
                        <i class="fa fa-eye"></i>
                      </button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editPeralatanModal-{{ $item->id }}">
                        <i class="fa fa-pencil-alt"></i>
                      </button>
                      @if ( auth()->user()->roles == 'staf' )
                        <form action="{{ route('destroy-peralatan', $item->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('delete')
                          <button class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
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

    @foreach ($peralatan as $detail)
  <!-- Modal Detail Peralatan Bengkel -->
  <div class="modal fade" id="detailPeralatanModal-{{ $detail->id }}" tabindex="-1" aria-labelledby="detailPeralatanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailPeralatanModalLabel">Detail</h5>
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
                    <th>Nama Cabang</th>
                    <td>{{ $detail->nama_cabang }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Nama PT</th>
                    <td>{{ $detail->nama_pt }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Area</th>
                    <td>{{ $detail->area }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Jenis Aset</th>
                    <td>{{ $detail->jenis_aset }}</td>
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
                <tbody>
                  <tr>
                    <th>Nilai Buku</th>
                    <td>{{ number_format($item->nilai_buku, 0, ',', '.') }}</td>
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
                    <th>Status di Laporan Keuangan</th>
                    <td>{{ $detail->status }}</td>
                  </tr>
                </tbody>
                <tbody>
                  <tr>
                    <th>Kondisi Aset</th>
                    <td>{{ $detail->kondisi }}</td>
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

  @foreach ($peralatan as $edit)
  <!-- Modal Edit Peralatan Bengkel -->
  <div class="modal fade" id="editPeralatanModal-{{ $edit->id }}" tabindex="-1" aria-labelledby="editPeralatanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPeralatanModalLabel">Edit</h5>
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
              <form action="{{ route('update-peralatan', $edit->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                  <label for="nama_cabang">Nama Cabang</label>
                  <input type="text" class="form-control" name="nama_cabang" placeholder="Nama Cabang" value="{{ $edit->nama_cabang }}">
                </div>
                <div class="form-group">
                  <label for="nama_pt">Nama PT</label>
                  <input type="text" class="form-control" name="nama_pt" placeholder="Nama PT" value="{{ $edit->nama_pt }}">
                </div>
                <div class="form-group">
                  <label for="area">Area</label>
                  <input type="text" class="form-control" name="area" placeholder="Area" value="{{ $edit->area }}">
                </div>
                <div class="form-group">
                  <label for="jenis_aset">Jenis Aset</label>
                  <input type="text" class="form-control" name="jenis_aset" placeholder="Jenis Aset" value="{{ $edit->jenis_aset }}">
                </div>
                <div class="form-group">
                  <label for="tahun_perolehan">Tahun Perolehan</label>
                  <input type="number" class="form-control" name="tahun_perolehan" placeholder="Tahun Perolehan" value="{{ $edit->tahun_perolehan }}">
                </div>
                <div class="form-group">
                  <label for="nilai_perolehan">Nilai Perolehan</label>
                  <input type="number" class="form-control" name="nilai_perolehan" placeholder="Nilai Perolehan" value="{{ $edit->nilai_perolehan }}">
                </div>
                <div class="form-group">
                  <label for="nilai_buku">Nilai Buku</label>
                  <input type="number" class="form-control" name="nilai_buku" placeholder="Nilai Buku" value="{{ $edit->nilai_buku }}">
                </div>
                <div class="form-group">
                  <label for="user">Pengguna</label>
                  <input type="text" class="form-control" name="user" placeholder="Pengguna" value="{{ $edit->user }}">
                </div>
                <div class="form-group">
                  <label for="status">Status di Laporan Keuangan</label>
                  <input type="text" class="form-control" name="status" placeholder="Status di Laporan Keuangan" value="{{ $edit->status }}">
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

    {{-- Aset Kantor Rusak --}}
    <div class="card mt-3 border-left-dark shadow">
      <div class="card-body">
        <h6 class="font-weight-bold text-center"><i class="fa fa-tv"></i> Aset Kantor Rusak</h6>
        <div class="table-responsive">
          <table class="table table-bordered bg-white text-center" width="100%" cellspacing="0" id="dataTable3">
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
                @forelse ($kantor as $item)
                <tr>
                  <td>{{ $item->nama_aset }}</td>
                  <td>{{ $item->nomor_aset }}</td>
                  <td>{{ $item->informasi }}</td>
                  <td>{{ $item->tahun_perolehan }}</td>
                  <td>{{ $item->user }}</td>
                  <td>{{ number_format($item->nilai_perolehan, 0, ',', '.') }}</td>
                  <td style="width: {{ auth()->user()->roles == 'staf' ? 130 : 100 }}px !important;">
                    <div class="text-center">
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailKantorModal-{{ $item->id }}">
                        <i class="fa fa-eye"></i>
                      </button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editKantorModal-{{ $item->id }}">
                        <i class="fa fa-pencil-alt"></i>
                      </button>
                      @if ( auth()->user()->roles == 'staf' )
                        <form action="{{ route('aset-rusak.destroy', $item->id) }}" method="POST" class="d-inline">
                          @csrf
                          @method('delete')
                          <button class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i>
                          </button>
                        </form>
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
    
  </div>
  <!-- /.container-fluid -->

  @foreach ($kantor as $detail)
  <!-- Modal Detail Kantor -->
  <div class="modal fade" id="detailKantorModal-{{ $detail->id }}" tabindex="-1" aria-labelledby="detailKantorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="detailKantorModalLabel">Detail</h5>
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
                    <td>{{ number_format($detail->nilai_perolehan, 0, ',', '.') }}</td>
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

  @foreach ($kantor as $edit)
  <!-- Modal Edit Kantor -->
  <div class="modal fade" id="editKantorModal-{{ $edit->id }}" tabindex="-1" aria-labelledby="editKantorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editKantorModalLabel">Edit</h5>
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
              <form action="{{ route('aset-rusak.update', $edit->id) }}" method="POST">
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
                  <label for="kondisi">Status</label>
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
      $('#dataTable2').DataTable();
      $('#dataTable3').DataTable();
    });
  </script>
@endpush