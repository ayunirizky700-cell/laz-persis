<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['nama', 'email', 'password', 'role_id', 'status', 'last_login'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function isSuperAdmin()
    {
        return $this->role?->nama_role === 'super_admin';
    }
    public function isAdminAmil()
    {
        return $this->role?->nama_role === 'admin_amil';
    }
    public function isPimpinan()
    {
        return $this->role?->nama_role === 'pimpinan';
    }
}