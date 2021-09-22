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
            ['id' => 1, 'name' => 'Groceries', 'description' => ''],
            ['id' => 2, 'name' => 'Shopping', 'description' => ''],
            ['id' => 3, 'name' => 'Transport', 'description' => ''],
            ['id' => 4, 'name' => 'Travel', 'description' => ''],
            ['id' => 5, 'name' => 'Wellness', 'description' => ''],
            ['id' => 6, 'name' => 'Housing', 'description' => ''],
            ['id' => 7, 'name' => 'Entertainment', 'description' => ''],
            ['id' => 8, 'name' => 'Fmily & Friends', 'description' => ''],
            ['id' => 9, 'name' => 'Dinning', 'description' => ''],
            ['id' => 10, 'name' => 'Bills & Utilities', 'description' => ''],
            ['id' => 11, 'name' => 'Savings & Investment', 'description' => ''],
            ['id' => 12, 'name' => 'Miscellaneous', 'description'=> '']
        ];

        foreach($transactionCategories as $transactions)
        {
            Type::firstOrCreate($transactions);
        }

    }
}
