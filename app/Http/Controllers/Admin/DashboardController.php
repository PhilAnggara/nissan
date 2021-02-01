<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kendaraan;
use App\Models\Peralatan;
use App\Models\Kantor;
use App\Models\Pengajuan;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $kendaraan_rusak = Kendaraan::where('kondisi', 'Rusak')->count();
        $peralatan_rusak = Peralatan::where('kondisi', 'Rusak')->count();
        $kantor_rusak = Kantor::where('kondisi', 'Rusak')->count();
        // Total semua aset yang rusak
        $rusak = $kendaraan_rusak + $peralatan_rusak + $kantor_rusak;
        
        $kendaraan_total = Kendaraan::where('kondisi', 'Baik & Berfungsi')->count();
        $peralatan_total = Peralatan::where('kondisi', 'Baik & Berfungsi')->count();
        $kantor_total = Kantor::where('kondisi', 'Baik & Berfungsi')->count();
        // Total semua aset yang berfungsi
        $total = $kendaraan_total + $peralatan_total + $kantor_total;
        
        // Menghitung jumlah kendaraan yang harus bayar pajak
        $pajak = Kendaraan::where('jatuh_tempo_stnk', '<' , \Carbon\Carbon::now()->addDays(30))->count();

        // Menghitung total aset yang diajukan
        $pengajuan = Pengajuan::where('status', 'Diproses')->count();

        return view('pages.admin.dashboard', compact('rusak','total','pajak','pengajuan'));
    }
}
