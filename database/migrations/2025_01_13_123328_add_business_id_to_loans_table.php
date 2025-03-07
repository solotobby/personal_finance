<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusinessIdToLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('loans', function (Blueprint $table) {
        $table->unsignedBigInteger('business_id')->nullable()->after('user_id');
        $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('loans', function (Blueprint $table) {
        $table->dropForeign(['business_id']);
        $table->dropColumn('business_id');
    });
}

}
