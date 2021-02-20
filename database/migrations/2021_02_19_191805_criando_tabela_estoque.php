<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaEstoque extends Migration
{
    public function up()
    {
        Schema::create('estoque', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_variacao_id');     
            $table->foreign('produto_variacao_id')->references('id')->on('produto_variacao');  
            $table->date('data');     
            $table->integer('quantidade');    
            $table->enum('tipo_movimento',array('ENTRADA','SAIDA')); 
            $table->timestamps();            
        });
    }

    public function down()
    {
        Schema::dropIfExists('estoque');
    }
}
