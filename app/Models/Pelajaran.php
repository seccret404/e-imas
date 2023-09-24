<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    use HasFactory;
    protected $table = 'matapelajran';
    protected $fillable = [
        'nama_pelajaran',
        'kode_guru',
        'nama',
        'jurusan',
        'kelas'
    ];
    
}
