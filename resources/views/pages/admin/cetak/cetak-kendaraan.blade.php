<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laproan Aset Kendaraan</title>
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

    .jabatan {
      margin-top: -10px;
    }

    .ttd {
      margin-top: 50px;
    }

  </style>
</head>
<body>

  <h1 class="mb">LAPORAN ASET KENDARAAN</h1>
  <h1>NISSAN MARTADINATA MANADO</h1>
  <hr>
  <p class="alamat">Jl. Martadinata No.64, Dendengan Luar, Paal Dua, Kota Manado, Sulawesi Utara 95129</p>
  <hr>

  <table border="1" cellpadding="4" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Area</th>
        <th>Merk</th>
        <th width="70px">Model</th>
        <th>Isi Silinder</th>
        <th>Jenis Transmisi</th>
        <th width="65px">No. Polisi</th>
        <th>Tahun Produksi</th>
        <th>Warna</th>
        <th>Nomor Chasis</th>
        <th>Nomor Engine</th>
        <th width="80px">Tanggal Jatuh Tempo STNK</th>
        <th width="70px">Waktu Pembelian</th>
        <th>Harga Perolehan</th>
        <th>NVB per_2020*)</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($items as $item)
          <tr>
            <td>{{ $item->area }}</td>
            <td>{{ $item->merk }}</td>
            <td>{{ $item->model }}</td>
            <td>{{ $item->isi_silinder }}</td>
            <td>{{ $item->transmisi }}</td>
            <td>{{ $item->no_polisi }}</td>
            <td>{{ $item->tahun_produksi }}</td>
            <td>{{ $item->warna }}</td>
            <td class="kiri">{{ $item->no_chasis }}</td>
            <td class="kiri">{{ $item->no_engine }}</td>
            <td>{{ Carbon\Carbon::parse($item->jatuh_tempo_stnk )->isoFormat('D MMMM Y') }}</td>
            <td>{{ Carbon\Carbon::parse($item->waktu_pembelian )->isoFormat('D MMMM Y') }}</td>
            <td class="kanan">{{ number_format($item->harga_perolehan, 0, ',', '.') }}</td>
            <td class="kanan">{{ number_format($item->nvb, 0, ',', '.') }}</td>
          </tr>
        @empty
        <tr>
          <td colspan="14" class="text-center">
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