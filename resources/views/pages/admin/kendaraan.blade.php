@extends('layouts.app')

@section('title')
    Aset Kendaraan
@endsection

@section('content')
  <!-- Awal Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Aset Kendaraan</h1>

      <!-- Search -->
    {{-- <form class="d-none d-sm-inline-block form-inline mr-3 ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="GET" action="{{ route('kendaraan.index') }}">
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

      {{-- <!-- Button trigger modal Cetak -->
      <button type="button" class="btn btn-info ml-2" data-toggle="modal" data-target="#cetakModal">
        <i class="fas fa-print fa-sm text-white"></i>
        Cetak
      </button> --}}
      
      <a type="button" target="_blank" class="btn btn-info ml-2" href="{{ route('cetak-kendaraan') }}">
        <i class="fas fa-print fa-sm text-white"></i>
        Cetak
      </a>

    </div>

    <div class="card mt-3 border-left-dark shadow">
      <div class="card-body">
        <div class="table-responsive" id="container">
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
                @forelse ($items as $item)
                <tr>
                  <td>{{ $item->area }}</td>
                  <td>{{ $item->merk }}</td>
                  <td>{{ $item->model }}</td>
                  <td>{{ $item->no_polisi }}</td>
                  <td>{{ $item->warna }}</td>
                  <td>
                    @if ( Carbon\Carbon::parse($item->jatuh_tempo_stnk)->subDays(30) > $now )
                      <div class="text-center text-success">
                        <i class="fa fa-circle text-success}"></i>
                        {{ \Carbon\Carbon::parse($item->jatuh_tempo_stnk)->diffForHumans() }}
                      </div>
                    @elseif( $item->jatuh_tempo_stnk < $now )
                      <div class="text-center text-danger">
                        <i class="fa fa-circle text-danger}"></i>
                        {{ \Carbon\Carbon::parse($item->jatuh_tempo_stnk)->diffForHumans() }}
                      </div>
                    @elseif( Carbon\Carbon::parse($item->jatuh_tempo_stnk)->subDays(30) < $now )
                      <div class="text-center text-warning">
                        <i class="fa fa-circle text-warning}"></i>
                        {{ \Carbon\Carbon::parse($item->jatuh_tempo_stnk)->diffForHumans() }}
                      </div>
                    @endif
                  </td>
                  <td style="width: 100px !important;">
                    <div class="text-center">
                      @if ( auth()->user()->roles == 'admin' )
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal-{{ $item->id }}">
                          <i class="fa fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal-{{ $item->id }}">
                          <i class="fa fa-pencil-alt"></i>
                        </button>
                        {{-- <form action="{{ route('kendaraan.destroy', $item->id) }}" method="POST" class="d-inline">
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
              <form action="{{ route('kendaraan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                  <label for="area">Area</label>
                  <input type="text" class="form-control" name="area" placeholder="Area" value="{{ old('area') }}">
                </div>
                <div class="form-group">
                  <label for="merk">Merk</label>
                  <input type="text" class="form-control" name="merk" placeholder="Merk" value="{{ old('merk') }}">
                </div>
                <div class="form-group">
                  <label for="model">Model</label>
                  <input type="text" class="form-control" name="model" placeholder="Model" value="{{ old('model') }}">
                </div>
                <div class="form-group">
                  <label for="isi_silinder">Isi Silinder</label>
                  <input type="number" class="form-control" name="isi_silinder" placeholder="Isi Silinder" value="{{ old('isi_silinder') }}">
                </div>
                <div class="form-group">
                  <label for="transmisi">Jenis Transmisi</label>
                  <input type="text" class="form-control" name="transmisi" placeholder="Jenis Transmisi" value="{{ old('transmisi') }}">
                </div>
                <div class="form-group">
                  <label for="no_polisi">No. Polisi</label>
                  <input type="text" class="form-control" name="no_polisi" placeholder="No. Polisi" value="{{ old('no_polisi') }}">
                </div>
                <div class="form-group">
                  <label for="tahun_produksi">Tahun Produksi</label>
                  <input type="number" class="form-control" name="tahun_produksi" placeholder="Tahun Produksi" value="{{ old('tahun_produksi') }}">
                </div>
                <div class="form-group">
                  <label for="warna">Warna</label>
                  <input type="text" class="form-control" name="warna" placeholder="Warna" value="{{ old('warna') }}">
                </div>
                <div class="form-group">
                  <label for="no_chasis">No. Chasis</label>
                  <input type="text" class="form-control" name="no_chasis" placeholder="No. Chasis" value="{{ old('no_chasis') }}">
                </div>
                <div class="form-group">
                  <label for="no_engine">No. Engine</label>
                  <input type="text" class="form-control" name="no_engine" placeholder="No. Engine" value="{{ old('no_engine') }}">
                </div>
                <div class="form-group">
                  <label for="jatuh_tempo_stnk">Jatuh Tempo STNK</label>
                  <input type="date" class="form-control" name="jatuh_tempo_stnk" placeholder="Jatuh Tempo STNK" value="{{ old('jatuh_tempo_stnk') }}">
                </div>
                <div class="form-group">
                  <label for="waktu_pembelian">Waktu Pembelian</label>
                  <input type="date" class="form-control" name="waktu_pembelian" placeholder="Waktu Pembelian" value="{{ old('waktu_pembelian') }}">
                </div>
                <div class="form-group">
                  <label for="harga_perolehan">Harga Perolehan</label>
                  <input type="number" class="form-control" name="harga_perolehan" placeholder="Harga Perolehan" value="{{ old('harga_perolehan') }}">
                </div>
                <div class="form-group">
                  <label for="nvb">NVB per _ 2020 *)</label>
                  <input type="number" class="form-control" name="nvb" placeholder="NVB per _ 2020 *)" value="{{ old('nvb') }}">
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

  <!-- Modal Cetak -->
  <div class="modal fade" id="cetakModal" tabindex="-1" aria-labelledby="cetakModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cetakModalLabel">Cetak Laporan</h5>
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
              <form target="_blank" action="{{ route('cetak-kendaraan') }}" method="GET">
                @csrf
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="tahun_awal">Tahun Awal</label>
                      <select name="tahun_awal" required class="form-control">
                        <option value="2000">2000</option>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-6">                    
                    <div class="form-group">
                      <label for="tahun_akhir">Tahun Akhir</label>
                      <select name="tahun_akhir" required class="form-control">
                        <option value="2000">2000</option>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                      </select>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                  <i class="fas fa-print fa-sm text-white"></i>
                  Cetak
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
              <form action="{{ route('kendaraan.update', $edit->id) }}" method="POST">
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

@endsection

@push('addon-script')
  <script>
    $(document).ready(function() {
      $('#dataTable').DataTable();
    });
  </script>
@endpush

{{-- @push('prepend-style')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
@endpush --}}

{{-- @push('addon-script')
  <script>
      $(document).ready(function(){

        fetch_customer_data();

        function fetch_customer_data(query = '')
        {
        $.ajax({
          url:"{{ route('kendaraan.action') }}",
          method:'GET',
          data:{query:query},
          dataType:'json',
          success:function(data)
          {
          $('tbody').html(data.table_data);
          $('#total_records').text(data.total_data);
          }
        })
        }

        $(document).on('keyup', '#search', function(){
          var query = $(this).val();
          fetch_customer_data(query);
        });
      });
  </script> --}}
  {{-- <script>
    
    // Ambil elemen-elemen yang dibutuhkan
    var keyword = document.getElementById('keyword');
    var tombolCari = document.getElementById('tombol-cari');
    var container = document.getElementById('container');

    // Tambahkan event ketika keyword ditulis
    keyword.addEventListener('keyup', function() {
      
      // Buat object ajax
      var xhr = new XMLHttpRequest();

      // Cek kesiapan ajax
      xhr.onreadystatechange = function() {
        if( xhr.readyState == 4 && xhr.status == 200 ) {
          container.innerHTML = xhr.responseText;
        }
      }

      // Eksekusi ajax
      xhr.open('GET', '{{ route('cari-kendaraan') }}', true);
      xhr.send();

    });

  </script> --}}
{{-- @endpush --}}