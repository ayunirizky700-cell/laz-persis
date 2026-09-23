<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    protected $table = 'penerimaan';
    protected $fillable = [
        'nomor_transaksi',
        'tanggal',
        'muzakki_id',
        'nama_donatur',
        'program_id',
        'jenis_dana',
        'nominal',
        'metode_pembayaran',
        'no_referensi',
        'bukti_pembayaran',
        'keterangan',
        'status',
        'validated_by',
        'validated_at',
        'created_by'
    ];
    protected $casts = [
        'tanggal' => 'date',
        'validated_at' => 'datetime',
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
            if ($m->isDirty('status') && $m->status === 'valid' && $m->program_id) {
                $p = Program::find($m->program_id);
                if ($p)
                    $p->increment('dana_terkumpul', $m->nominal);
            }
        });
    }
    public static function generateNomor()
    {
        $tahun = date('Y');
        $last = self::whereYear('created_at', $tahun)->latest()->first();
        $num = $last ? (int) substr($last->nomor_transaksi, -4) + 1 : 1;
        return 'TRX-IN-' . $tahun . '-' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }

    public function muzakki()
    {
        return $this->belongsTo(Muzakki::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class);
    }
    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
    public function scopeValid($q)
    {
        return $q->where('status', 'valid');
    }
    public function scopePending($q)
    {
        return $q->where('status', 'pending');
    }
}