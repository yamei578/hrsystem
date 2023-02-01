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
            //
            $table->date('fecha_nacimiento')->nullable();
            $table->date('fecha_ingreso')->nullable();
            $table->text('idiomas')->nullable();
            $table->text('habilidades')->nullable();
            $table->text('experiencia_laboral')->nullable();
            $table->text('educacion')->nullable();
            $table->text('certificaciones_cursos')->nullable();
            $table->string('estatura')->nullable();
            $table->string('peso')->nullable();
            $table->string('grupo_sanguineo')->nullable();
            $table->string('contacto_emergencia')->nullable();
            $table->string('telefono_emergencia')->nullable();
            $table->text('alergias')->nullable();
            $table->text('intolerancias')->nullable();
            $table->text('vacunas')->nullable();
            $table->text('antecedentes_familiares')->nullable();
            $table->text('enfermedades_dolencias')->nullable();
            $table->text('cirugias_transplantes')->nullable();
            $table->text('medicamentos')->nullable();
            $table->text('necesidades_especiales')->nullable();
            $table->text('medico_contacto')->nullable();
            $table->text('notas_medicas')->nullable();
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
