<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'produto';
        
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome','codigo', 'preco',
    ];

    protected $casts = [
        'nome' => 'string',
        'codigo' => 'string',
        'preco' => 'double',
    ];


    protected $dates = ['deleted_at'];

    public function produtoVariacoes() {
        return $this->hasMany(ProdutoVariacao::class);
    }
    	
    public function atributos() {
        return $this->belongsToMany(Atributo::class, 'produto_atributo', 'produto_id', 'atributo_id');
    }
}
