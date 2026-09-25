<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amil extends Model
{
    protected $table = 'amil';

    protected $fillable = [
        'user_id',
        'nip_amil',
        'jabatan',
        'divisi',
        'cabang',
        'tanggal_masuk',
        'status',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}