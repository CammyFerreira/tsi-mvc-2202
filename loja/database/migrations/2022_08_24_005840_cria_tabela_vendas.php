<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    //Migrations é o controle de versão do banco de dados
    public function up()
    {
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('cliente_id')->unsigned();//unsigned para deixar só positivos
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');//chave estrangeira da coluna id de origem da tabela clientes e quando deletado fazer em cascada(tudo relacionado a ele será deletado também)
            $table->bigInteger('vendedor_id')->unsigned();
            $table->foreign('vendedor_id')->references('id')->on('vendedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas');
    }
};
