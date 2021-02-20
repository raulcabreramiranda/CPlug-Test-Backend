<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriandoTabelaAtributo extends Migration
{
    public function up()
    {
        Schema::create('atributo', function (Blueprint $table) {
            $table->id();
            $table->string('nome');     
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atributo');
    }
}
