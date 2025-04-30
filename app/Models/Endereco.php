<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    /** @use HasFactory<\Database\Factories\EnderecoFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /* Relações */

    // Relação 1:1 com o modelo Dados
    public function dados()
    {
        return $this->belongsTo(Dados::class);
    }
}
