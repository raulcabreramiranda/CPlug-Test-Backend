<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;
    
    protected $table = 'estoque';
    
    const TIPO_MOVIMENTO_ENTRADA = 'ENTRADA';
    const TIPO_MOVIMENTO_SAIDA = 'SAIDA';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quantidade','data', 'tipo_movimento',
    ];

    public function produtoVariacao() {
        return $this->belongsTo(ProdutoVariacao::class);
    }

}
