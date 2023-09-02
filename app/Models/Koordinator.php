<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Koordinator extends Model
{
    protected $table = 'koordinators';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_koordinator'];
}
