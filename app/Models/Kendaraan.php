<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kendaraan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'kendaraan';

    protected $fillable = [
        'area','merk','model','isi_silinder','transmisi','no_polisi','tahun_produksi','warna','no_chasis','no_engine','jatuh_tempo_stnk','waktu_pembelian','harga_perolehan','nvb','kondisi'
    ];


    protected $hidden = [
        
    ];
}
