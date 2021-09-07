<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('technician_id')->nullable();
            $table->unsignedBigInteger('action_id')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('filepath')->nullable();
            $table->integer('status')->default(1);
            $table->integer('severity');
            $table->integer('urgency')->default(1);
            $table->integer('trend')->default(1);
            $table->integer('gut')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            //Constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('Cascade');
            $table->foreign('technician_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('calls');
    }
}
