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

    // ==========================================
    // TAMBAHKAN METHOD INI UNTUK AUTO-GENERATE KODE
    // ==========================================
    protected static function booted(): void
    {
        static::creating(function ($program) {
            // Jika kode_program kosong, buat otomatis
            if (empty($program->kode_program)) {
                $tahun = date('Y');
                // Cari program terakhir di tahun yang sama
                $lastProgram = static::whereYear('created_at', $tahun)->latest('id')->first();

                // Ambil 4 angka terakhir dari kode sebelumnya, kalau tidak ada mulai dari 0
                $lastNumber = $lastProgram ? (int) substr($lastProgram->kode_program, -4) : 0;
                // Tambah 1 dan jadikan format 4 digit (contoh: 0001)
                $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

                $program->kode_program = 'PRG-' . $tahun . '-' . $newNumber;
            }
        });
    }
    // ==========================================

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