<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedor', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('distrito_id')->nullable();
            $table->foreign('distrito_id')->references('id')->on('distrito')->onDelete('cascade')->onUpdate('cascade');
            $table->string('endereco');
            $table->string('categoria');
            $table->longText('produto');
            $table->decimal('quantidade', 20,2)->nullable();
            $table->decimal('montante', 20,2)->nullable();
            $table->longText('observacao')->nullable();
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
        Schema::dropIfExists('fornecedor');
    }
}
