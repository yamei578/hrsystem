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
        Schema::table('sols', function (Blueprint $table) {
            //
            $table->integer('user_id')->unsigned()->index(); 
            $table->integer('solicitud_id')->unsigned()->index();
            //$table->integer('department_id')->unsigned()->index();
            //$table->integer('employee_id')->unsigned()->index();
            $table->datetime('fecha_desde');
            $table->datetime('fecha_hasta');
            $table->boolean('status');
            $table->boolean('is_employee');
            $table->text('explicacion')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sols', function (Blueprint $table) {
            //
        });
    }
};
