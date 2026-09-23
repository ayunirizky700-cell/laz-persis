<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';
    protected $fillable = ['user_id', 'aktivitas', 'modul', 'referensi_id', 'deskripsi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function catat($aktivitas, $modul, $deskripsi = null, $referensiId = null)
    {
        return self::create([
            'user_id' => auth()->id(),
            'aktivitas' => $aktivitas,
            'modul' => $modul,
            'referensi_id' => $referensiId,
            'deskripsi' => $deskripsi,
        ]);
    }
}