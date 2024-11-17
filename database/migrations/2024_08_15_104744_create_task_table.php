<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TaskStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

    Schema::create('task', function (Blueprint $table) {
        $table->id();
        $table->string('task_description');
        $table->string('status')->default(TaskStatus::TO_DO);
        // $table->enum('status', [
        //     TaskStatus::TO_DO->value,
        //     TaskStatus::IN_PROGRESS->value,
        //     TaskStatus::DONE->value
        // ])->default(TaskStatus::TO_DO->value);
                $table->boolean('end_flag')->default(false);
        $table->dateTime('dead_line');
        $table->timestamps(); // Adds `created_at` and `updated_at` columns
        $table->softDeletes(); // Adds 'deleted_at' column for soft deletes


    });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
     }
};
