<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    protected $table = 'penerimaan';
    protected $guarded = [];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'decimal:2',
    ];

    // Relasi ke Muzakki
    public function muzakki()
    {
        return $this->belongsTo(\App\Models\Muzakki::class, 'muzakki_id');
    }

    // Relasi ke Program
    public function program()
    {
        return $this->belongsTo(\App\Models\Program::class, 'program_id');
    }

    // TAMBAHKAN INI: Relasi ke validator (User yang validasi)
    public function validator()
    {
        return $this->belongsTo(\App\Models\User::class, 'validated_by');
    }

    // Relasi ke creator (User yang buat)
    public function creator()
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}