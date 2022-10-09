<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemcarrinhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemcarrinha', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('produto_id')->nullable();
            $table->foreign('produto_id')->references('id')->on('produto')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('distrito_id')->nullable();
            $table->foreign('distrito_id')->references('id')->on('distrito')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('endereco_id')->nullable();
            $table->foreign('endereco_id')->references('id')->on('endereco')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('unidade_id')->nullable();
            $table->foreign('unidade_id')->references('id')->on('unidade')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('quantidade', 20,2)->nullable();
            $table->string('transporte')->default('on');
            $table->string('estado')->default('on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itemcarrinha');
    }
}
