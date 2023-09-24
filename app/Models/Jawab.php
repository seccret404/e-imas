<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawab extends Model
{
    use HasFactory;

    protected $table = 'jawab';
    protected $fillable =
    [
        'jawaban',
        'id_user'
    ];
    protected $primaryKey = 'id_j';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

