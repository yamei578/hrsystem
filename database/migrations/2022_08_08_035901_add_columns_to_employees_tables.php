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
        Schema::table('employees', function (Blueprint $table) {
            //$table->id();
            $table->string('nombre');
            $table->string('cedula');
            $table->string('numero');
            $table->text('avatar')->nullable();
            $table->string('email_personal');
            $table->string('email_empresa');
            $table->text('direccion');
            $table->string('salario');
            $table->text('cuenta_bancaria');
            $table->text('notas');
            $table->integer('status'); //cambiar a boolean
            $table->integer('es_externo'); //cambiar a boolean

            /*$table->id('department_id');
            $table->id('job_id');*/
           // $table->timestamps();

            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
};
