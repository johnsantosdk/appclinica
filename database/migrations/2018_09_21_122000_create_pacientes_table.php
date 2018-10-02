<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('nome');
            $table->string('data_nascimento');
            $table->integer('cpf')->unique();
            $table->string('email')->unique();
            $table->timestamps();
        });
    
        Schema::table('pacientes', function (Blueprint $table) {
            $table->unsignedInteger('consulta_id');

            $table->foreign('consulta_id')->references('id')->on('consultas');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pacientes');
    }
}
