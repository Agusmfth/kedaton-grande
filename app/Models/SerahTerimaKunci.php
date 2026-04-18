<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class SerahTerimaKunci extends Model
{
    protected $table = 'serah_terima_kunci';

    protected $fillable = [
        'user_id',
        'blok',
        'tanggal_serah_terima',
        'keterangan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}