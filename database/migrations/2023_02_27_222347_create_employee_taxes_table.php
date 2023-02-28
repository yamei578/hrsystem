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
        Schema::create('employee_taxes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->index(); 
            $table->string('anio');
            $table->decimal('sueldo_anual');
            $table->decimal('total_ingresos');
            $table->decimal('alimentacion');
            $table->decimal('vivienda');
            $table->decimal('recreacion');
            $table->decimal('vestimenta');
            $table->decimal('salud');
            $table->decimal('total_deduccion_personales');
            $table->decimal('deduccion_iess');
            $table->decimal('otros_gastos');
            $table->decimal('total_deducciones');
            $table->decimal('base_imponible');
            $table->decimal('impuesto_por_pagar');
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
        Schema::dropIfExists('employee_taxes');
    }
};
