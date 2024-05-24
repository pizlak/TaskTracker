<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title', 30);
            $table->string('status', 15)->default(2);
            $table->boolean('type')->default(1);
            $table->boolean('priority')->default(2);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
            $table->date('due_date')->nullable();

            $table->index('user_id', 'task_user_idx');
            $table->index('parent_id', 'task_task_idx');

            $table->foreign('user_id', 'task_user_fk')->on('users')->references('id');
            $table->foreign('parent_id', 'task_task_fk')->on('tasks')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
