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
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('user_id')->unsigned()->index(); 
            $table->string('nombre');
            $table->date('fecha_desde');
            $table->date('fecha_hasta');
            $table->string('mes_anio');
            $table->decimal('sueldo_nominal');
            $table->decimal('sueldo_ganado');
            $table->integer('dias_laborados');
            $table->integer('horas_suplementarias')->nullable();
            $table->integer('horas_extras')->nullable();
            $table->decimal('total_horas_extras')->nullable(); //o float?
            $table->decimal('valor_horas_extras')->nullable(); //o float?
            $table->decimal('comision')->nullable();
            $table->decimal('total_ingresos');
            $table->decimal('aporte_iess');
            $table->decimal('prestamos_quirografarios')->nullable();
            $table->decimal('anticipos_prestamos')->nullable();
            $table->decimal('total_descuentos')->nullable();
            $table->decimal('liquido_pagar')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payslips');
    }
};
