<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEncomendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encomenda', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('formapagamento_id')->nullable();
            $table->foreign('formapagamento_id')->references('id')->on('formapagamento')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('moeda_id')->nullable();
            $table->foreign('moeda_id')->references('id')->on('moeda')->onDelete('cascade')->onUpdate('cascade');
            $table->string('numero')->nullable();
            $table->decimal('valor', 20,2)->nullable();
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
        Schema::dropIfExists('encomenda');
    }
}
