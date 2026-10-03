<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'program';
    protected $guarded = [];

    protected $casts = [
        'periode_mulai' => 'date',
        'periode_selesai' => 'date',
        'target_dana' => 'decimal:2',
        'dana_terkumpul' => 'decimal:2',
        'dana_tersalurkan' => 'decimal:2',
    ];

    // Relasi ke Penerimaan
    public function penerimaan()
    {
        return $this->hasMany(\App\Models\Penerimaan::class, 'program_id');
    }

    // Relasi ke Penyaluran
    public function penyaluran()
    {
        return $this->hasMany(\App\Models\Penyaluran::class, 'program_id');
    }
}