<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Peralatan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'peralatan';

    protected $fillable = [
        'nama_cabang','nama_pt','area','jenis_aset','tahun_perolehan','nilai_perolehan','nilai_buku','user','status','kondisi'
    ];


    protected $hidden = [
        
    ];
}
