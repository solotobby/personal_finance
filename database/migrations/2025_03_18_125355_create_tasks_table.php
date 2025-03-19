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
            $table->string('business_id');
            $table->string('task_id');
            $table->string('title');
            $table->string('staff_id');
            $table->string('created_by');
            $table->enum('priority', ['high', 'medium', 'low'])->default('low');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->timestamp('due_date')->nullable();
            $table->timestamp('completion_date')->nullable();
            $table->timestamps();

            // $table->foreign('business_id')->references('business_id')->on('businesses')->onDelete('cascade');
            // $table->foreign('staff_id')->references('staff_id')->on('staffs')->onDelete('cascade');
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
