<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntosTable extends Migration
{
    public function up()
    {
        Schema::create('puntos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('set_id')->constrained('sets')->onDelete('cascade');
            $table->string('accion_punto');
            $table->integer('punto_actual');
            $table->foreignId('jugador_id')->nullable()->constrained('jugadores')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('puntos');
    }
}
