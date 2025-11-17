<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePortalUrlFromServicesTable extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'portal_url')) {
                $table->dropColumn('portal_url');
            }
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            if (! Schema::hasColumn('services', 'portal_url')) {
                $table->string('portal_url')->nullable();
            }
        });
    }
}

