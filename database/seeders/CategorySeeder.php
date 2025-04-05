<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Parent categories
        $electronics = Category::create(['name' => 'Electronics']);
        $clothing = Category::create(['name' => 'Clothing']);

        // Child categories
        Category::create([
            'name' => 'Smartphones',
            'parent_id' => $electronics->id,
        ]);
        Category::create([
            'name' => 'Accessories',
            'parent_id' => $electronics->id,
        ]);
        Category::create([
            'name' => "Men's",
            'parent_id' => $clothing->id,
        ]);
        Category::create([
            'name' => "Women's",
            'parent_id' => $clothing->id,
        ]);
    }
}
