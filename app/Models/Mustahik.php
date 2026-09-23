<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Mustahik extends Model
{
    protected $table = 'mustahik';
    protected $fillable = ['kode', 'nama', 'alamat', 'no_telepon', 'kategori_asnaf', 'status_verifikasi', 'status', 'created_by'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($m) {
            if (empty($m->kode))
                $m->kode = self::generateKode();
            if (empty($m->created_by))
                $m->created_by = auth()->id();
        });
    }
    public static function generateKode()
    {
        $tahun = date('Y');
        $last = self::whereYear('created_at', $tahun)->latest()->first();
        $num = $last ? (int) substr($last->kode, -4) + 1 : 1;
        return 'MST-' . $tahun . '-' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }
    public function penyaluran()
    {
        return $this->hasMany(Penyaluran::class);
    }
    public function scopeTerverifikasi($q)
    {
        return $q->where('status_verifikasi', 'terverifikasi');
    }
}