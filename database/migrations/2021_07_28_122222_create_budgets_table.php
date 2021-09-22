<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constraint('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constraint('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('date');
            $table->string('name');
            $table->decimal('amount');
            $table->text('description');
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('budgets');
    }
}
