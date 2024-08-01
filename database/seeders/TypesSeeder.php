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
            ['id' => 4, 'name' => 'Travel', 'description' => ''],
            ['id' => 5, 'name' => 'Wellness', 'description' => ''],
            ['id' => 6, 'name' => 'Housing', 'description' => ''],
            ['id' => 7, 'name' => 'Entertainment', 'description' => ''],
            ['id' => 8, 'name' => 'Family & Friends', 'description' => ''],
            ['id' => 9, 'name' => 'Dinning', 'description' => ''],
            ['id' => 10, 'name' => 'Bills & Utilities', 'description' => ''],
            ['id' => 11, 'name' => 'Savings', 'description' => ''],
            ['id' => 12, 'name' => 'Investment', 'description' => ''],
            ['id' => 13, 'name' => 'Miscellaneous', 'description'=> '']
        ];

        foreach($transactionCategories as $transactions)
        {
            Type::firstOrCreate($transactions);
        }

    }
}
