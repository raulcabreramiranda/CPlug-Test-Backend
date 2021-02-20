<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdutoVariacao extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'produto_variacao';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        
    ];


    protected $dates = ['deleted_at'];

    public function produto() {
        return $this->belongsTo(Produto::class);
    }

    public function estoques() {
        return $this->hasOne(Estoque::class);
    }

    public function atributoValores() {
        return $this->belongsToMany(AtributoValor::class, 'produto_variacao_atributo_valor');
    }
}
