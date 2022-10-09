<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCambiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cambio', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('moeda_id')->nullable();
            $table->foreign('moeda_id')->references('id')->on('moeda')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('valor', 20, 2)->nullable();
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
        Schema::dropIfExists('cambio');
    }
}
