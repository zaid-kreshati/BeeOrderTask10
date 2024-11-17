<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            //$table->text('message');
            $table->morphs('commentable');  // This will create `commentable_id` and `commentable_type`
            $table->text('comment');
            $table->timestamps();
            $table->softDeletes(); // Adds 'deleted_at' column for soft deletes

            $table->index(['commentable_type', 'commentable_id', 'user_id']);


        });
    }

    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropIndex(['commentable_type', 'commentable_id', 'user_id']);

        });
    }
}
