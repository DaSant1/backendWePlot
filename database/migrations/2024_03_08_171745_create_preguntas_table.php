<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            
            //idUser
            $table->UnsignedBigInteger('idAdmin');
            $table->foreign('idAdmin')->references('id')->on('admins');

            //id Estado
            $table->UnsignedBigInteger('idEstado');
            $table->foreign('idEstado')->references('id')->on('estados');

            $table->boolean('Activo')->default(true);
            $table->longText('pregunta');

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
        Schema::dropIfExists('preguntas');
    }
}
