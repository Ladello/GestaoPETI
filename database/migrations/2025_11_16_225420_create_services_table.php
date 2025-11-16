<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nome do serviço (modelo PETI: portfólio de serviços)
            $table->text('description')->nullable();
            $table->string('portal_url')->nullable();
            $table->string('sla')->nullable();
            $table->json('results_expected')->nullable(); // resultados de negócio requeridos pelos clientes
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
}
