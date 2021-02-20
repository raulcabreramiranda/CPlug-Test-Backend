<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaProdutoVariacao extends Migration
{
    public function up()
    {
        Schema::create('produto_variacao', function (Blueprint $table) {
            $table->id();       
            $table->unsignedBigInteger('produto_id');     
            $table->foreign('produto_id')->references('id')->on('produto');  
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produto_variacao');
    }
}
