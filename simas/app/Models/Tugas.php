<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $fillable = [
        'nama_pelajaran',
        'judul',
        'jurusan',
        'kelas',
        'catatan',
        'file',
        'dedline',
    ];

    protected $primaryKey = 'id_tugas';

    public function hasiltugas()
    {
        return $this->hasMany(Hasil::class);
    }
}
