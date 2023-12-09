<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User_dcak extends Authenticatable
{

    use HasFactory, Notifiable;
    use HasRoles;

    protected $table = 'users_dcak';
    protected $primaryKey = 'id_users_dcak';
    protected $fillable = [
        'id_users_dcak', 'id_koordinator', 'username', 'password', 'level'
    ];

    public function koordinator()
    {
        return $this->belongsTo(Koordinator::class, 'id_koordinator');
    }

    public function isAdmin()
    {
        return $this->level === 'admin';
    }

    public function isSuperAdmin()
    {
        return $this->level === 'superadmin';
    }

    public function hasRole($role)
    {
        if ($this->role == $role) {
            return true;
        }

        return false;
    }
}
