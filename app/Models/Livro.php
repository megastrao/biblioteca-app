<?php

namespace App\Models;

use App\Models\Autor;
use App\Models\Genero;
use App\Models\Editora;
use App\Models\Locacao;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $table = 'livros';
    protected $guarded = ['id'];

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }

    public function editora()
    {
        return $this->belongsTo(Editora::class, 'editora_id');
    }

    public function genero()
    {
        return $this->belongsTo(Genero::class, 'genero_id');
    }

    public function locacao()
    {
        return $this->hasMany(Locacao::class, 'livro_id');
    }
}
