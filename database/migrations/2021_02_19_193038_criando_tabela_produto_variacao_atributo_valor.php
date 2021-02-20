<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaProdutoVariacaoAtributoValor extends Migration
{
    public function up()
    {
        Schema::create('produto_variacao_atributo_valor', function (Blueprint $table) {
            $table->unsignedBigInteger('produto_variacao_id');     
            $table->foreign('produto_variacao_id')->references('id')->on('produto_variacao');  
            $table->unsignedBigInteger('atributo_valor_id');     
            $table->foreign('atributo_valor_id')->references('id')->on('atributo_valor');                    
            $table->primary(array('produto_variacao_id', 'atributo_valor_id'), 'prod_var_atr_valor_primary');      
        });
    }

    public function down()
    {
        Schema::dropIfExists('produto_variacao_atributo_valor');
    }
}
