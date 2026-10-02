<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    // TAMBAHKAN BARIS INI
    protected $table = 'penerimaan';

    protected $guarded = [];

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function muzakki()
    {
        return $this->belongsTo(Muzakki::class, 'muzakki_id');
    }
}