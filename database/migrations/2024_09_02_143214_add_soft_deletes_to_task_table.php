<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeletesToTaskTable extends Migration
{
    public function up()
    {
        Schema::table('task', function (Blueprint $table) {
            //
        });
    }

    public function down()
    {

        Schema::table('task', function (Blueprint $table) {
            //
        });
    }
}