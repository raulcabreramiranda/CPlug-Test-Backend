<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaProdutoAtributo extends Migration
{
    public function up()
    {
        Schema::create('produto_atributo', function (Blueprint $table) {
            $table->unsignedBigInteger('produto_id');     
            $table->foreign('produto_id')->references('id')->on('produto');  
            $table->unsignedBigInteger('atributo_id');     
            $table->foreign('atributo_id')->references('id')->on('atributo');                    
            $table->primary(array('produto_id', 'atributo_id'));      
        });
    }

    public function down()
    {
        Schema::dropIfExists('produto_atributo');
    }
}
