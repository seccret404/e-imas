<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $fillable = [
        'nama',
        'npdn',
        'kode_guru',
        'alamat',
        'no_hp',
        'jenis_kelamin'

    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
