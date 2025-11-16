<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('status', ['planejado','em_andamento','cancelado','concluido'])->default('planejado');
            $table->text('acceptance_criteria')->nullable(); // metas para considerar atendida
            $table->date('due_date')->nullable();
            $table->unsignedBigInteger('assignee_id')->nullable(); // usuário responsável
            $table->timestamps();

            $table->foreign('assignee_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
