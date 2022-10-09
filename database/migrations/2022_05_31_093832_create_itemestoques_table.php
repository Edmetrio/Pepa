<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemestoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemestoque', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('estoque_id')->nullable();
            $table->foreign('estoque_id')->references('id')->on('estoque')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('usersFor_id')->nullable();
            $table->foreign('usersFor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('quantidade', 20,2)->nullable();
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
        Schema::dropIfExists('itemestoque');
    }
}
