<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Penyaluran extends Model
{
    protected $table = 'penyaluran';
    protected $fillable = [
        'nomor_transaksi',
        'tanggal_pengajuan',
        'tanggal_realisasi',
        'program_id',
        'mustahik_id',
        'jenis_bantuan',
        'nominal',
        'deskripsi_bantuan',
        'bukti_penyaluran',
        'status',
        'keterangan',
        'created_by'
    ];
    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'tanggal_realisasi' => 'date',
        'nominal' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($m) {
            if (empty($m->nomor_transaksi))
                $m->nomor_transaksi = self::generateNomor();
            if (empty($m->created_by))
                $m->created_by = auth()->id();
        });
        static::updated(function ($m) {
            if ($m->isDirty('status') && $m->status === 'direalisasi') {
                $p = Program::find($m->program_id);
                if ($p)
                    $p->increment('dana_tersalurkan', $m->nominal);
            }
        });
    }
    public static function generateNomor()
    {
        $tahun = date('Y');
        $last = self::whereYear('created_at', $tahun)->latest()->first();
        $num = $last ? (int) substr($last->nomor_transaksi, -4) + 1 : 1;
        return 'TRX-OUT-' . $tahun . '-' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function mustahik()
    {
        return $this->belongsTo(Mustahik::class);
    }
    public function persetujuan()
    {
        return $this->hasMany(Persetujuan::class, 'referensi_id')->where('referensi_tipe', 'penyaluran');
    }
    public function scopeMenungguPersetujuan($q)
    {
        return $q->where('status', 'diajukan');
    }
}