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
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('nome');
            $table->char('endereco');
            $table->char('email');
            $table->char('telefone');

        });

        Schema::create('vendedores', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('matricula');
            $table->char('nome');
        });

        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('cliente_id')->unsigned();//unsigned para deixar só positivos
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');//chave estrangeira da coluna id de origem da tabela clientes e quando deletado fazer em cascada
            $table->bigInteger('vendedor_id')->unsigned();
            $table->foreign('vendedor_id')->references('id')->on('vendedores')->onDelete('cascade');
            $table->date('data_da_venda');
        });

        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('nome');
            $table->char('descricao');
            $table->double('preco', 12, 2);
        });

        Schema::create('produtosVenda', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('venda_id')->unsigned();
            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->bigInteger('produto_id')->unsigned();
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            $table->Integer('quantidade');
            $table->double('valor', 12, 2);//12 posições dessas, 2 vou usar para decimal
        });

        Schema::create('notasFiscais', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('venda_id')->unsigned();
            $table->foreign('venda_id')->references('id')->on('vendas')->onDelete('cascade');
            $table->double('valor', 12, 2);//12 posições dessas, 2 vou usar para decimal
            $table->double('imposto', 12, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
