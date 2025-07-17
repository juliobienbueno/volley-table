<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetsTable extends Migration
{
    public function up()
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partido_id')->constrained('partidos')->onDelete('cascade');
            $table->integer('numero_set');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sets');
    }
}
