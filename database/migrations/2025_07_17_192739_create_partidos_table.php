<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidosTable extends Migration
{
    public function up()
    {
        Schema::create('partidos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('equipo_local_id')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('equipo_visita_id')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('cancha_id')->constrained('canchas')->onDelete('cascade');
            $table->foreignId('cuerpo_arbitros_id')->constrained('cuerpo_arbitros')->onDelete('cascade');

            $table->dateTime('horario_inicio');
            $table->dateTime('horario_termino')->nullable();
            $table->integer('cantidad_sets')->default(3);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('partidos');
    }
}
