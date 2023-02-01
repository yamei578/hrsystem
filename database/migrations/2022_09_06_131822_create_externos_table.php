<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('externos', function (Blueprint $table) {
            $table->id();
             //$table->id();
             $table->string('nombre');
             $table->string('cedula');
             $table->date('fecha_nacimiento');
             $table->string('numero');
             $table->string('email_personal');
             $table->text('direccion');
             $table->text('avatar');
             $table->integer('job_id')->unsigned();
           
            $table->text('idiomas');
            $table->text('habilidades');
            $table->text('experiencia_laboral');
            $table->text('educacion');
            $table->text('certificaciones_cursos');
            $table->text('referencias_personales');
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
        Schema::dropIfExists('externos');
    }
};
