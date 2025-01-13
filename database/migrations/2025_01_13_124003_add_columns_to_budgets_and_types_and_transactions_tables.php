<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToBudgetsAndTypesAndTransactionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add columns to budgets table
        Schema::table('budgets', function (Blueprint $table) {
            $table->unsignedBigInteger('business_id')->nullable()->after('category_id');

            // Add foreign keys
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
        });

        // Add category_id to types table
        Schema::table('types', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('id');

            // Add foreign key
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Remove columns from budgets table
        Schema::table('budgets', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['business_id']);
            $table->dropColumn(['category_id', 'business_id']);
        });

        // Remove category_id from types table
        Schema::table('types', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });

        // Remove category_id from transactions table
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}
