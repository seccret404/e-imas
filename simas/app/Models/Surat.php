<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surat_izins';

    protected $fillable = [
        'id_user',
        'jenis_surat',
        'keterangan_surat',
        'keteranfvvvgan_tambahan',
        'waktu_mulai',
        'waktu_berakhir',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id');
    }
}
