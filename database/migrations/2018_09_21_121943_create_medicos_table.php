<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nome');
            $table->integer('cpf')->unique();
            $table->integer('crm')->unique();
            $table->timestamps();
        });

        Schema::table('medicos', function (Blueprint $table) {
            $table->unsignedInteger('consulta_id');

            $table->foreign('consulta_id')->references('id')->on('consultas');
        });

        Schema::table('medicos', function (Blueprint $table) {
            $table->unsignedInteger('especialidade_id');

            $table->foreign('especialidade_id')->references('id')->on('especialidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicos');
    }
}
