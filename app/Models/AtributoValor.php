<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtributoValor extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'atributo_valor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'valor'
    ];


    protected $dates = ['deleted_at'];

    public $timestamps = false;

    public function atributo() {
        return $this->belongsTo(Atributo::class);
    }

    public function produtoVariacoes() {
        return $this->belongsToMany(ProdutoVariacao::class, 'produto_variacao_atributo_valor');
    }
}
