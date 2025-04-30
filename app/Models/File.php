<?php

namespace App\Models;

use App\Facades\FileManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class File extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $casts = [
        'expires_in' => 'datetime',
    ];

    protected $appends = [
        'url',
    ];

    /**
     * Retorna a URL pública gerada para o arquivo.
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return FileManager::getUrl($this);
    }
    
    // Relação com o modelo Dados
    public function dados(): BelongsToMany
    {
        return $this->belongsToMany(Dados::class, 'anexos', 'file_id', 'dados_id');
    }
}
