<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome');
            $table->integer('quantidade');
            // decimal ('nomeTABELA',$quantidadeDeAlgarismos,$quantasCasasDecimais)
            $table->decimal('preco',5,2);
            // unsigned garante que não aceita valores abaixo de 0
            $table->unsignedBiginteger('id_categoria');
            $table->timestamps(); 

            // Estabelecendo a coluna id categoria como chave estrangeira
            $table->foreign('id_categoria')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations;
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
