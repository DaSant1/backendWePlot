<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respuestas_clientes', function (Blueprint $table) {
            $table->id();
            //foreign key idUser
            $table->UnsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('users');

            //foreign key idPregunta
            $table->UnsignedBigInteger('idPregunta');
            $table->foreign('idPregunta')->references('id')->on('preguntas');
            $table->longText('Respuesta');
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
        Schema::dropIfExists('respuestas_clientes');
    }
}
