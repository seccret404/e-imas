<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $table = 'ujian';

    protected $fillable = [
        'jenis_ujian',
        'judul',
        'dedline',
        'jurusan',
        'kelas',
        'catatan',
        'file',
        'tahun_akademik',
        'uploaded',
    ];
}
