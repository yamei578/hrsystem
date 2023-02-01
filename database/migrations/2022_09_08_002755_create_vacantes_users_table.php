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
        Schema::create('user_vacante', function (Blueprint $table) {
            $table->primary(['user_id','vacante_id']); //makes it unique
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vacante_id')->constrained()->onDelete('cascade');
            
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_vacante');
    }
};
