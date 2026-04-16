<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaduanHistori extends Model
{
    protected $table = 'pengaduan_histori';

    protected $fillable = [
        'pengaduan_id',
        'status',
        'keterangan',
        'updated_by',
    ];
}