<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kantor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'kantor';

    protected $fillable = [
        'nama_pt','nama_cabang','nama_aset','nomor_aset','kondisi','informasi','tahun_perolehan','nilai_perolehan','user'
    ];


    protected $hidden = [
        
    ];
}
