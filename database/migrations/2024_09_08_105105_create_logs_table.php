<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('model');  // Model name
            $table->unsignedBigInteger('model_id');  // ID of the model instance
            $table->string('action');
            $table->string('action_by');

            $table->json('new_model')->nullable();  // Changed to nullable
            $table->json('old_model')->nullable();  // Changed to nullable
            $table->json('deleted_model')->nullable();  // Changed to nullable
            $table->dateTime('createdTime')->nullable();;
            $table->dateTime('updatedTime')->nullable();;
            $table->dateTime('deletedTime')->nullable();;
            $table->timestamps();
            $table->softDeletes(); // Adds 'deleted_at' column for soft deletes



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
