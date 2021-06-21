<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskSubGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_sub_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id');
            $table->string('title');
            $table->string("description")->nullable();
            $table->integer('estimated_time');
            $table->string('important');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_sub_groups');
    }
}
