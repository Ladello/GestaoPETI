<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanvasItemsTable extends Migration
{
    public function up()
    {
        Schema::create('canvas_items', function (Blueprint $table) {
            $table->id();
            $table->enum('section', ['parcerias','atividades','proposta_valor','relacionamento','segmentos','recursos','canais','custos','receitas']);
            $table->text('content')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('canvas_items');
    }
}
