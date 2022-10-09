<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistritoestoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distritoestoque', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('estoque_id')->nullable();
            $table->foreign('estoque_id')->references('id')->on('estoque')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('produto_id')->nullable();
            $table->foreign('produto_id')->references('id')->on('produto')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('pais_id')->nullable();
            $table->foreign('pais_id')->references('id')->on('pais')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('provincia_id')->nullable();
            $table->foreign('provincia_id')->references('id')->on('provincia')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('distrito_id')->nullable();
            $table->foreign('distrito_id')->references('id')->on('distrito')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('distritoestoque');
    }
}
