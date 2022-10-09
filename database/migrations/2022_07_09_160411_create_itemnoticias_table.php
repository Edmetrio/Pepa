<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemnoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemnoticia', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('noticia_id')->nullable();
            $table->foreign('noticia_id')->references('id')->on('noticia')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('texto')->nullable();
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
        Schema::dropIfExists('itemnoticia');
    }
}
