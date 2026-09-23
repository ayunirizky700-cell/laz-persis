<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';
    protected $fillable = [
        'kode_program',
        'nama_program',
        'deskripsi',
        'kategori',
        'jenis',
        'target_dana',
        'dana_terkumpul',
        'dana_tersalurkan',
        'periode_mulai',
        'periode_selesai',
        'status',
        'created_by'
    ];
    protected $casts = [
        'periode_mulai' => 'date',
        'periode_selesai' => 'date',
        'target_dana' => 'decimal:2',
        'dana_terkumpul' => 'decimal:2',
        'dana_tersalurkan' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($m) {
            if (empty($m->kode_program))
                $m->kode_program = self::generateKode();
            if (empty($m->created_by))
                $m->created_by = auth()->id();
        });
    }
    public static function generateKode()
    {
        $tahun = date('Y');
        $prefix = 'PRG-' . $tahun . '-';
        $last = self::where('kode_program', 'like', $prefix . '%')
            ->orderBy('kode_program', 'desc')
            ->first();
        $num = $last ? (int) substr($last->kode_program, -4) + 1 : 1;
        return $prefix . str_pad($num, 4, '0', STR_PAD_LEFT);
    }
    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class);
    }
    public function penyaluran()
    {
        return $this->hasMany(Penyaluran::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getPersentaseCapaianAttribute()
    {
        if ($this->target_dana <= 0)
            return 0;
        return round(($this->dana_terkumpul / $this->target_dana) * 100, 2);
    }
    public function scopeAktif($q)
    {
        return $q->where('status', 'aktif');
    }
}