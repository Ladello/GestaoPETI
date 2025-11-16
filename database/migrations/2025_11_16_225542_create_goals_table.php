<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoalsTable extends Migration
{
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('objective_id')->nullable()->constrained('objectives')->onDelete('set null');
            $table->string('metric')->nullable(); // ex: "reduzir tempo de resposta"
            $table->decimal('target_value', 12, 4)->nullable();
            $table->string('target_label')->nullable(); // ex: "90% uptime"
            $table->date('target_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('goals');
    }
}
