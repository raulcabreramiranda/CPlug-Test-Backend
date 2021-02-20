<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atributo extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'atributo';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome'
    ];


    protected $dates = ['deleted_at'];

    public $timestamps = false;

    public function atributoValores() {
        return $this->hasMany(AtributoValor::class);
    }

    public function produtos() {
        return $this->belongsToMany(Produto::class, 'produto_atributo', 'atributo_id', 'produto_id');
    }
}
