<?php

namespace App\Models;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autores';
    protected $guarded = ['id'];

    public function livro()
    {
        return $this->hasMany(Livro::class, 'autor_id');
    }
}
