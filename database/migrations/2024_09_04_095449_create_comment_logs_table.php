<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentLogsTable extends Migration
{
    public function up()
    {
        Schema::create('comment_logs', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->text('user_name')->nullable(); 
            $table->string('action'); // 'insert' or 'delete'
            $table->text('comment'); // 
            $table->string('type')->nullable(); // Type of the commentable (e.g., 'post', 'article')
            $table->unsignedBigInteger('comment_id')->nullable(); // ID of the comment affected
            $table->unsignedBigInteger('user_id')->nullable(); // ID of the user who made the action
            //$table->timestamp('created_at')->useCurrent(); // Timestamp when the action was logged
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('comment_logs');
    }
}







  