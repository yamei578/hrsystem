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
        Schema::create('marcs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->index(); 
            $table->integer('marcacion_id')->unsigned()->index(); //tipo de marcacion 
            $table->datetime('fecha_hora_marcacion');
            $table->time('horas_trabajadas');
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
        Schema::dropIfExists('marcs');
    }
};
