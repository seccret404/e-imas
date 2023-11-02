<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $fillable = [
        'nama',
        'nisn',
        'jenis_kelamin',
        'jurusan',
        'kelas'

    ];

    public static function getEmailList()
    {
        return self::pluck('email')->toArray();
    }

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
}
