<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'Income', 'type' => 'Credit'],
            ['id' => 2, 'name' => 'Expenses', 'type' => 'Debit'],
            ['id' => 3, 'name' => 'Savings', 'type' => 'Credit']
        ];

        foreach($categories as $category)
        {
            Categories::firstOrCreate($category);
        }
    }
}
