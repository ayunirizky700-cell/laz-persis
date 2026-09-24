<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Muzakki extends Model
{
    protected $table = 'muzakki';
    protected $fillable = ['kode', 'nama', 'no_telepon', 'email', 'alamat', 'kategori', 'status', 'created_by'];

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
    $prefix = 'MZK-' . $tahun . '-';

    // Ambil kode terbesar di tahun ini berdasarkan KODE (bukan created_at)
    $last = self::where('kode', 'like', $prefix . '%')
                ->orderBy('kode', 'desc')
                ->first();

    $num = $last ? (int) substr($last->kode, -4) + 1 : 1;

    // Loop kalau ternyata kode sudah ada (jaga-jaga)
    do {
        $kode = $prefix . str_pad($num, 4, '0', STR_PAD_LEFT);
        $exists = self::where('kode', $kode)->exists();
        if ($exists) $num++;
    } while ($exists);

    return $kode;
}
    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class);
    }
    public function scopeAktif($q)
    {
        return $q->where('status', 'aktif');
    }
}