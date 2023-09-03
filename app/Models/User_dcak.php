<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_dcak extends Model
{
    use HasFactory;

    protected $table = 'users-dcak';

    public function koordinator()
    {
        return $this->hasOne(Koordinator::class);
    }
}
