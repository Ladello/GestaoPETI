<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectivesTable extends Migration
{
    public function up()
    {
        Schema::create('objectives', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // objetivo estratégico
            $table->text('description')->nullable();
            $table->enum('type', ['estrategico','operacional','tatico'])->default('estrategico');
            $table->json('requirements')->nullable(); // requisitos de negócio para TI desdobrados
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('objectives');
    }
}
