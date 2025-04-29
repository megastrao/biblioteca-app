<?php

namespace App\Models;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Model;

class Editora extends Model
{
    protected $table = 'editoras';
    protected $guarded = ['id'];

    public function livro()
    {
        return $this->hasMany(Livro::class, 'editora_id');
    }
}
