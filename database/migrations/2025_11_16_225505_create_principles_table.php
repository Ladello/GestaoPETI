<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrinciplesTable extends Migration
{
    public function up()
    {
        Schema::create('principles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->integer('priority')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('principles');
    }
}
