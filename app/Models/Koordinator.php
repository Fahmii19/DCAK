<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Koordinator extends Model
{
    protected $table = 'koordinator';
    protected $primaryKey = 'id_koordinator';
    protected $fillable = [
        'nama_kepala', 'username', 'password', 'jumlah_surat_dukungan', 'id_kelurahan', 'id_kecamatan', 'user_id'
    ];

    public function usersDcak()
    {
        return $this->hasMany(UserDcak::class, 'id_koordinator');
    }
}
