<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $table = 'hasiltugas';

    protected $fillable = [
        'file_hasil',
        'dedline',
        'creted_at',
        'id_user'
    ];

    protected $primaryKey = 'id_hasil';

    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
