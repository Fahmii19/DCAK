<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilih extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pemilih';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_pemilih';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_pemilih',
        'nik',
        'nama_koordinator',
        'nama_pemilih',
        'jenis_kelamin',
        'no_hp',
        'rt',
        'rw',
        'tps',
        'kelurahan'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];


    public function koordinator()
    {
        return $this->belongsTo(Koordinator::class, 'nama_koordinator', 'nama_koordinator');
    }
}
