<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactionCategories = [
            ['id' => 1, 'name' => 'Freebyz', 'description' => ''],
            ['id' => 2, 'name' => 'Payhankey', 'description' => ''],
            ['id' => 3, 'name' => 'Salaries', 'description' => ''],
            ['id' => 4, 'name' => 'Groceries', 'description' => ''],
            ['id' => 5, 'name' => 'Shopping', 'description' => ''],
            ['id' => 6, 'name' => 'Transport', 'description' => ''],
            ['id' => 7, 'name' => 'Travel', 'description' => ''],
            ['id' => 8, 'name' => 'Wellness', 'description' => ''],
            ['id' => 9, 'name' => 'Housing', 'description' => ''],
            ['id' => 10, 'name' => 'Entertainment', 'description' => ''],
            ['id' => 11, 'name' => 'Family & Friends', 'description' => ''],
            ['id' => 12, 'name' => 'Dinning', 'description' => ''],
            ['id' => 13, 'name' => 'Bills & Utilities', 'description' => ''],
            ['id' => 14, 'name' => 'Savings', 'description' => ''],
            ['id' => 15, 'name' => 'Investment', 'description' => ''],
            ['id' => 16, 'name' => 'Miscellaneous', 'description'=> '']
        ];

        foreach($transactionCategories as $transactions)
        {
            Type::firstOrCreate($transactions);
        }

    }
}
