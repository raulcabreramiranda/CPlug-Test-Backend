<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaAtributoValor extends Migration
{
    public function up()
    {
        Schema::create('atributo_valor', function (Blueprint $table) {
            $table->id();
            $table->string('valor');     
            $table->unsignedBigInteger('atributo_id');     
            $table->foreign('atributo_id')->references('id')->on('atributo');  
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atributo_valor');
    }
}
