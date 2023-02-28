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
        Schema::create('impuestos', function (Blueprint $table) {
            $table->id();
            $table->decimal('fraccion_basica');
            $table->decimal('exceso_hasta');
            $table->decimal('impuesto_fraccion_basica');
            $table->decimal('impuesto_fraccion_excedente', $precision = 8, $scale = 4);
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
        Schema::dropIfExists('impuestos');
    }
};
