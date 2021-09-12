<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftdeletesInCallsTable extends Migration
{
    public function up()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('calls', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
