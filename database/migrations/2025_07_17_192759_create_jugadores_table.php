<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJugadoresTable extends Migration
{
    public function up()
    {
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipo_id')->constrained('equipos')->onDelete('cascade');
            $table->string('nombre');
            $table->integer('numero')->nullable();
            $table->string('posicion')->nullable();
            $table->boolean('es_capitan')->default(false);
            $table->boolean('es_libero')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jugadores');
    }
}
