<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('data');
            $table->timestamps();
        });

        Schema::table('pacientes', function (Blueprint $table) {
            $table->unsignedInteger('atendente_id');

            $table->foreign('atendente_id')->references('id')->on('atendentes');
        });

        Schema::table('consultas', function (Blueprint $table) {
            $table->unsignedInteger('paciente_id');

            $table->foreign('paciente_id')->references('id')->on('pacientes');
        });

        Schema::table('pacientes', function (Blueprint $table) {
            $table->unsignedInteger('convenio_id');

            $table->foreign('convenio_id')->references('id')->on('convenios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultas');
    }
}
