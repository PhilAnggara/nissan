<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laproan Aset Peralatan Kantor</title>
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

  <h1 class="mb">LAPORAN ASET KANTOR</h1>
  <h1>NISSAN MARTADINATA MANADO</h1>
  <hr>
  <p class="alamat">Jl. Martadinata No.64, Dendengan Luar, Paal Dua, Kota Manado, Sulawesi Utara 95129</p>
  <hr>

  <table border="1" cellpadding="4" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th>Nama Aset</th>
        <th>Nomor Aset</th>
        <th>Informasi</th>
        <th>Tahun Perolehan</th>
        <th>Nilai Perolehan</th>
        <th>Pengguna</th>
      </tr>
    </thead>
    <tbody>
        @forelse ($items as $item)
          <tr>
            <td>{{ $item->nama_aset }}</td>
            <td>{{ $item->nomor_aset }}</td>
            <td>{{ $item->informasi }}</td>
            <td>{{ $item->tahun_perolehan }}</td>
            <td class="kanan">{{ number_format($item->nilai_perolehan, 0, ',', '.') }}</td>
            <td>{{ $item->user }}</td>
          </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center">
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