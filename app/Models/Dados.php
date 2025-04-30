<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Dados extends Model
{
    /** @use HasFactory<\Database\Factories\DadosFactory> */
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /* Relações */

    // Relação 1:1 com o modelo Endereco
    public function endereco(): HasOne
    {
        return $this->hasOne(Endereco::class);
    }

    // Relação n:n com o modelo File através da tabela 'anexos'
    public function anexos(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'anexos', 'dados_id', 'file_id');
    }
}
