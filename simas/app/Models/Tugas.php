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


    ];

    protected $primaryKey = 'id_tugas';

    public function hasilTugas()
    {
        return $this->hasMany(Hasil::class, 'id_tugas');
    }
}
