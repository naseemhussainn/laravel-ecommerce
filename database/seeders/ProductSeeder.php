<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $smartphones = Category::where('name', 'Smartphones')->first();
        $accessories = Category::where('name', 'Accessories')->first();
        $menClothing = Category::where('name', "Men's")->first();
        $womenClothing = Category::where('name', "Women's")->first();

        // Smartphones
        Product::create([
            'name' => 'Smartphone X1',
            'description' => 'Latest model with high-end features',
            'price' => 899.00,
            'stock' => 50,
            'category_id' => $smartphones->id,
            'image' => 'smartphone_x1.jpg',
            'attributes' => json_encode(['color' => 'Black', 'size' => '128GB']),
        ]);

        Product::create([
            'name' => 'Smartphone X2',
            'description' => 'Premium smartphone with advanced camera',
            'price' => 999.00,
            'stock' => 40,
            'category_id' => $smartphones->id,
            'image' => 'smartphone_x2.jpg',
            'attributes' => json_encode(['color' => 'White', 'size' => '256GB']),
        ]);

        Product::create([
            'name' => 'Smartphone X3',
            'description' => 'Budget-friendly smartphone with great features',
            'price' => 499.00,
            'stock' => 75,
            'category_id' => $smartphones->id,
            'image' => 'smartphone_x3.jpg',
            'attributes' => json_encode(['color' => 'Blue', 'size' => '128GB']),
        ]);

        // Accessories
        Product::create([
            'name' => 'Phone Case',
            'description' => 'Durable phone case with shock absorption',
            'price' => 19.99,
            'stock' => 200,
            'category_id' => $accessories->id,
            'image' => 'phone_case.jpg',
            'attributes' => json_encode(['color' => 'Black']),
        ]);

        Product::create([
            'name' => 'Wireless Earbuds',
            'description' => 'High-quality sound with noise cancellation',
            'price' => 129.99,
            'stock' => 80,
            'category_id' => $accessories->id,
            'image' => 'earbuds.jpg',
            'attributes' => json_encode(['color' => 'White']),
        ]);

        Product::create([
            'name' => 'Fast Charger',
            'description' => 'Quick charging adapter for all smartphones',
            'price' => 24.99,
            'stock' => 150,
            'category_id' => $accessories->id,
            'image' => 'charger.jpg',
            'attributes' => json_encode(['color' => 'White']),
        ]);

        // Men's Clothing
        Product::create([
            'name' => "Men's T-Shirt",
            'description' => 'Comfortable cotton t-shirt',
            'price' => 35.00,
            'stock' => 100,
            'category_id' => $menClothing->id,
            'image' => 'men_tshirt.jpg',
            'attributes' => json_encode(['color' => 'Blue', 'size' => 'M']),
        ]);

        Product::create([
            'name' => "Men's Jeans",
            'description' => 'Classic fit denim jeans',
            'price' => 59.99,
            'stock' => 50,
            'category_id' => $menClothing->id,
            'image' => 'men_jeans.jpg',
            'attributes' => json_encode(['color' => 'Blue', 'size' => 'L']),
        ]);

        // Women's Clothing
        Product::create([
            'name' => "Women's Blouse",
            'description' => 'Elegant blouse for formal occasions',
            'price' => 45.99,
            'stock' => 75,
            'category_id' => $womenClothing->id,
            'image' => 'women_blouse.jpg',
            'attributes' => json_encode(['color' => 'White', 'size' => 'M']),
        ]);

        Product::create([
            'name' => "Women's Dress",
            'description' => 'Fashionable summer dress',
            'price' => 65.00,
            'stock' => 60,
            'category_id' => $womenClothing->id,
            'image' => 'women_dress.jpg',
            'attributes' => json_encode(['color' => 'Red', 'size' => 'S']),
        ]);
    }
}
