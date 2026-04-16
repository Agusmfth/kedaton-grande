<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PengaduanHistori;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';

    protected $fillable = [
    'user_id',
    'judul',
    'keluhan',
    'tanggal_pengaduan',
    'status',
    'foto_perbaikan',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histori()
    {
        return $this->hasMany(PengaduanHistori::class, 'pengaduan_id')
                    ->orderBy('created_at', 'asc');
    }
}