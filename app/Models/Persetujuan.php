<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Persetujuan extends Model
{
    protected $table = 'persetujuan';
    protected $fillable = ['referensi_tipe', 'referensi_id', 'approver_id', 'status', 'catatan', 'approved_at'];
    protected $casts = ['approved_at' => 'datetime'];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
    public function penyaluran()
    {
        return $this->belongsTo(Penyaluran::class, 'referensi_id');
    }
    public function scopePending($q)
    {
        return $q->where('status', 'pending');
    }
}