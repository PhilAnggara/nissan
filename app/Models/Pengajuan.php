<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengajuan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pengajuan';

    protected $fillable = [
        'nama_barang','user','jumlah','kisaran','keterangan','status','alasan'
    ];


    protected $hidden = [
        
    ];
}
