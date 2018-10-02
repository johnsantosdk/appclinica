<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConveniosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenios', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('matricula')->unique();
            $table->string('plano');
            $table->timestamps();
        });

        Schema::table('convenios', function (Blueprint $table) {
            $table->unsignedInteger('consulta_id');

            $table->foreign('consulta_id')->references('id')->on('consultas');
        });

        Schema::table('pacientes', function (Blueprint $table) {
            $table->unsignedInteger('paciente_id');

            $table->foreign('paciente_id')->references('id')->on('pacientess');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('convenios');
    }
}
