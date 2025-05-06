<?php

namespace App\Models;

use App\Models\Livro;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    protected $table = 'locacoes';
    protected $guarded = ['id'];

    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

   
}
