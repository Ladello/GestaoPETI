<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArchitectureUploadsTable extends Migration
{
    public function up()
    {
        Schema::create('architecture_uploads', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('mime')->nullable();
            $table->unsignedBigInteger('uploaded_by')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('architecture_uploads');
    }
}
