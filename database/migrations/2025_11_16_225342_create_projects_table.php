<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // nome do projeto
            $table->text('description')->nullable(); // descrição/justificativa (modelo PETI: Portfolio de Projetos)
            $table->enum('status', ['proposta','planejado','em_andamento','cancelado','concluido','liberado','em_operacao','aposentado'])->default('proposta');
            $table->enum('priority', ['baixa','media','alta'])->default('media');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->json('meta')->nullable(); // campo genérico para metas/indicadores ligados ao projeto
            $table->timestamps();

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
