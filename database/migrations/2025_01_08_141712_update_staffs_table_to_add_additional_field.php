<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStaffsTableToAddAdditionalField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('staffs', function (Blueprint $table) {
            $table->string('name')->after('id');
        
            $table->date('employment_date')->nullable()->after('role');
            $table->string('email')->unique()->nullable()->after('role');
            $table->string('phone')->nullable()->after('email');
            $table->string('address')->nullable()->after('phone');
            $table->enum('sex', ['male', 'female'])->nullable()->after('address');
            $table->date('date_of_birth')->nullable()->after('sex');
            $table->string('qualification')->nullable()->after('date_of_birth');
            $table->decimal('salary', 10, 2)->nullable()->after('basic_salary');
            $table->string('department')->nullable()->after('salary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('staffs', function (Blueprint $table) {

            $table->dropColumn([
                'name',
                'employment_date',
                'email',
                'phone',
                'address',
                'sex',
                'date_of_birth',
                'qualification',
                'salary',
                'department',
            ]);
        });
    }
}
