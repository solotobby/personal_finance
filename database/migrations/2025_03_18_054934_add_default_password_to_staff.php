<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    public function up()
    {

        DB::table('staffs')->whereNull('password')->orWhere('password', '')->update([
            'password' => Hash::make('password123'),
        ]);
    }

    public function down()
    {

    }
};
