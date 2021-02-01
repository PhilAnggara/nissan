<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laproan Permintaan Aset</title>
  <style type="text/css">

    h1 {
      text-align: center;
      font-size: 20px;
    }

    .mb {
      margin-bottom: -15px;
    }

    hr {
      border-top: 0px;
      border-bottom: 1px;
      margin-top: -8px;
      margin-bottom: -10px;
    }

    table {
      margin-top: 50px;
      font-size: 12px;
      text-align: center;
    }

    .kiri {
      text-align: left;
    }
    .kanan {
      text-align: right;
    }

    .bawah {
      text-align: left
    }

    .alamat {
      text-align: center;
      font-style: italic;
      font-size: 10px;
    }

    .status {
      font-size: 14px;
      margin-top: 50px;
      margin-bottom: -40px;
    }

    .martop {
      margin-top: 20px;
    }

    .jabatan {
      margin-top: -10px;
    }

    .ttd {
      margin-top: 50px;
    }

  </style>
</head>
<body>

  <h1 class="mb">LAPORAN PENGAJUAN ASET</h1>
  <h1>NISSAN MARTADINATA MANADO</h1>
  <hr>
  <p class="alamat">Jl. Martadinata No.64, Dendengan Luar, Paal Dua, Kota Manado, Sulawesi Utara 95129</p>
  <hr>

  <h2 class="status">Permintaan Diajukan</h2>
  <table border="1" cellpadding="4" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Nama Barang</th>
        <th>Pengguna</th>
        <th>Jumlah</th>
        <th>Kisaran</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($items as $item)
          <tr>
            <td>{{ $item->nama_barang }}</td>
            <td>{{ $item->user }}</td>
            <td>{{ $item->jumlah }}</td>
            <td class="kanan">{{ number_format($item->kisaran, 0, ',', '.') }}</td>
            <td>{{ $item->keterangan }}</td>
          </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center">
            Data Kosong
          </td>
        </tr>
        @endforelse
    </tbody>
  </table>

  <h2 class="status martop">Permintaan Disetujui</h2>
  <table border="1" cellpadding="4" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Nama Barang</th>
        <th>Pengguna</th>
        <th>Jumlah</th>
        <th>Kisaran</th>
        <th>Keterangan</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($things as $thing)
          <tr>
            <td>{{ $thing->nama_barang }}</td>
            <td>{{ $thing->user }}</td>
            <td>{{ $thing->jumlah }}</td>
            <td class="kanan">{{ number_format($thing->kisaran, 0, ',', '.') }}</td>
            <td>{{ $thing->keterangan }}</td>
          </tr>
        @empty
        <tr>
          <td colspan="10" class="text-center">
            Data Kosong
          </td>
        </tr>
        @endforelse
    </tbody>
  </table>

  <table class="bawah" width="100%">
    <tr>
      <td></td>
      <td width="200px">
        <p class="tanggal">Manado, {{ Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
        <p class="jabatan">{{ Auth::user()->name }}</p>
        <p class="ttd">__________________________</p>
      </td>
    </tr>
  </table>

</body>
</html>