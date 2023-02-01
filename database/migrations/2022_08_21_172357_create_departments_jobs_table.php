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
        Schema::create('department_job', function (Blueprint $table) {
           //$table->id();
           $table->primary(['department_id','job_id']); //makes it unique
           $table->foreignId('department_id')->constrained()->onDelete('cascade');
           $table->foreignId('job_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('department_job');
    }
};
