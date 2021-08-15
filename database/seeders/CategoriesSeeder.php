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
        $cat1 = Categories::create(['name' => 'Income', 'type' => 'Credit']);
        $cat2 = Categories::create(['name' => 'Expenses', 'type' => 'Debit']);
        $cat3 = Categories::create(['name' => 'Savings']);
    }
}
