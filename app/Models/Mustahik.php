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
    $prefix = 'MST-' . $tahun . '-';

    $last = self::where('kode', 'like', $prefix . '%')
                ->orderBy('kode', 'desc')
                ->first();

    $num = $last ? (int) substr($last->kode, -4) + 1 : 1;

    do {
        $kode = $prefix . str_pad($num, 4, '0', STR_PAD_LEFT);
        $exists = self::where('kode', $kode)->exists();
        if ($exists) $num++;
    } while ($exists);

    return $kode;
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