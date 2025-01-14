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
            ['id' => 1, 'category_id' => 1, 'name' => 'Freebyz', 'description' => ''],
            ['id' => 2, 'category_id' => 1, 'name' => 'Payhankey', 'description' => ''],
            ['id' => 3, 'category_id' => 1, 'name' => 'Salaries', 'description' => ''],
            ['id' => 4, 'category_id' => 2, 'name' => 'Travel', 'description' => ''],
            ['id' => 5, 'category_id' => 2, 'name' => 'Wellness', 'description' => ''],
            ['id' => 6, 'category_id' => 2, 'name' => 'Housing', 'description' => ''],
            ['id' => 7, 'category_id' => 2, 'name' => 'Entertainment', 'description' => ''],
            ['id' => 8, 'category_id' => 2, 'name' => 'Family & Friends', 'description' => ''],
            ['id' => 9, 'category_id' => 2, 'name' => 'Dinning', 'description' => ''],
            ['id' => 10, 'category_id' => 2, 'name' => 'Bills & Utilities', 'description' => ''],
            ['id' => 11, 'category_id' => 3, 'name' => 'Savings', 'description' => ''],
            ['id' => 12, 'category_id' => 3, 'name' => 'Investment', 'description' => ''],
            ['id' => 13, 'category_id' => 3, 'name' => 'Miscellaneous', 'description' => '']
        ];
        foreach ($transactionCategories as $transactions) {
            Type::firstOrCreate($transactions);
        }
    }
}
