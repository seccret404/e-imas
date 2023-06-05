<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';

    public function user()
    {
        return $this->belongsTo(User::class, 'jurusan', 'kelas');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
