<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->string('staff_id');
            $table->string('name');
            $table->decimal('amount', 15, 2);
            $table->decimal('basic_salary', 15, 2);
            $table->decimal('bonus', 15, 2);
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_name');
            $table->string('payer_name');
            $table->string('narration');
            $table->string('date');
            $table->string('status')->default('Pending'); // Paid, Pending, Failed
            $table->uuid('transaction_id')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payslips');
    }
};
