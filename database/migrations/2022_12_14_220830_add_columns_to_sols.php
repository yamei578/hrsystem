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
            $table->datetime('fecha_solicitud');
            $table->decimal('monto')->nullable();
            $table->boolean('onlyrrhh')->default(0); //booleano para que la solicitud solo vaya a rrhh
            $table->integer('cuotas')->nullable();
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
