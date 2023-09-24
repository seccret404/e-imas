<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;
    protected $table = 'forum';
    protected $fillable = [
        'judul',
        'pertanyaan',
        'deskripsi'
    ];

    protected $primaryKey = 'id_q';

    public function answers()
    {
        return $this->hasMany(Jawab::class, 'id_q');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

}
