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
    'assigned_to',
    'judul',
    'keluhan',
    'foto_pengaduan',
    'tanggal_pengaduan',
    'status',
    'foto_perbaikan',
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function histori()
    {
        return $this->hasMany(PengaduanHistori::class, 'pengaduan_id')
                    ->with('updater')
                    ->orderBy('created_at', 'asc');
    }
}
