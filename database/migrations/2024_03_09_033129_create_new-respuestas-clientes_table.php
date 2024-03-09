<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewRespuestasClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('respuestas_clientes', function (Blueprint $table) {
            //foreign key idUser
            $table->UnsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('users');

            //foreign key idPregunta
            $table->UnsignedBigInteger('idPregunta');
            $table->foreign('idPregunta')->references('id')->on('preguntas');
            $table->longText('Respuesta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('respuestas_clientes', function (Blueprint $table) {
            $table->dropColumn('idPregunta','idUser','Respuesta');
        });
    }
}
