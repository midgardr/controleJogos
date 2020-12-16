<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJogosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jogos', function (Blueprint $table) {
            $table->id();
            $table->biginteger('user_id')->unsigned();
            $table->string('titulo');
            $table->enum('plataforma', ['PS3', 'PS4', 'PSVita', 'PS5'])->default('PS4');
            $table->boolean('exclusivo')->default(false);
            $table->boolean('repetido')->default(false);
            $table->enum('dificuldade', ['Garapa','Fácil', 'Normal', 'Difícil', 'Insano'])->default('Normal');
            $table->enum('situacao', ['Não lançado','A platinar', 'Platinando', 'Platinado'])->default('A platinar');
            $table->dateTime('platinado_em')->nullable();
            $table->string('guia1')->nullable();
            $table->string('guia2')->nullable();
            $table->string('print')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jogos');
    }
}
