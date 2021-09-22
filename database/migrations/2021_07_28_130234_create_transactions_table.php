<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constraint('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constraint('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('type_id')->constraint('types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('budget_id')->constraint('budgets')->cascadeOnDelete()->cascadeOnUpdate()->nullable();
            $table->string('name');
            $table->decimal('amount');
            $table->text('description');
            $table->dateTime('date');
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
        Schema::dropIfExists('transactions');
    }
}
