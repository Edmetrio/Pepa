<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtensionistafornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extensionistafornecedor', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('extensionista_id')->nullable();
            $table->foreign('extensionista_id')->references('id')->on('extensionista')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->uuid('situacao_id')->nullable();
            $table->foreign('situacao_id')->references('id')->on('situacao')->onDelete('cascade')->onUpdate('cascade');
            $table->string('descricao')->nullable();
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
        Schema::dropIfExists('extensionistafornecedor');
    }
}
