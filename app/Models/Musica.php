<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Musica extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'duracao', 'id_album', 'nome_album'];

    public function disco()
    {
        return $this->belongsTo(Disco::class, 'id_album');
    }
}
