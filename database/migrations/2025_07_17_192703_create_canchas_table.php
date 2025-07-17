<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanchasTable extends Migration
{
    public function up()
    {
        Schema::create('canchas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('lugar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('canchas');
    }
}
