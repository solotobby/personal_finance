<?php

namespace Database\Seeders;

use App\Models\TransactionCategory;
use Illuminate\Database\Seeder;

class TransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transactionCategories = [
            ['id' => 1, 'name' => 'Groceries'],
            ['id' => 2, 'name' => 'Shopping'],
            ['id' => 3, 'name' => 'Transport'],
            ['id' => 4, 'name' => 'Travel'],
            ['id' => 5, 'name' => 'Wellness'],
            ['id' => 6, 'name' => 'Housing'],
            ['id' => 7, 'name' => 'Entertainment'],
            ['id' => 8, 'name' => 'Fmily & Friends'],
            ['id' => 9, 'name' => 'Dinning'],
            ['id' => 10, 'name' => 'Bills & Utilities'],
            ['id' => 11, 'name' => 'Savings & Investment'],
            ['id' => 12, 'name' => 'Miscellaneous']
        ];

        foreach($transactionCategories as $transactions)
        {
            TransactionCategory::firstOrCreate($transactions);
        }

    }
}
