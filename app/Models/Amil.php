<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amil extends Model
{
    use HasFactory;

    protected $table = 'amil'; // Sesuaikan dengan nama tabel di database
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // TAMBAHKAN 2 FUNGSI INI (Jika belum ada)
    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'amil_id'); // Sesuaikan nama kolom foreign key
    }

    public function penyaluran()
    {
        return $this->hasMany(Penyaluran::class, 'amil_id'); // Sesuaikan nama kolom foreign key
    }
}