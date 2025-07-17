<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuerpoArbitrosTable extends Migration
{
    public function up()
    {
        Schema::create('cuerpo_arbitros', function (Blueprint $table) {
            $table->id();
            $table->string('primer_arbitro');
            $table->string('segundo_arbitro');
            $table->string('juez_linea_1');
            $table->string('juez_linea_2');
            $table->string('juez_linea_3');
            $table->string('juez_linea_4');
            $table->string('planillero');
            $table->string('asistente_planilla');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cuerpo_arbitros');
    }
}
