<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $customers = User::where('role', 'customer')->get();
        $products = Product::all();

        // Create 5 completed orders
        for ($i = 0; $i < 5; $i++) {
            $customer = $customers->random();
            $orderTotal = 0;
            
            $order = Order::create([
                'user_id' => $customer->id,
                'total' => 0, // Temporary, will update after adding items
                'status' => 'completed',
            ]);

            // Add 1-3 items to each order
            $itemCount = rand(1, 3);
            $selectedProducts = $products->random($itemCount);
            
            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 3);
                $price = $product->price;
                $itemTotal = $price * $quantity;
                $orderTotal += $itemTotal;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }

            // Update order total
            $order->update(['total' => $orderTotal]);
        }

        // Create 5 pending orders
        for ($i = 0; $i < 5; $i++) {
            $customer = $customers->random();
            $orderTotal = 0;
            
            $order = Order::create([
                'user_id' => $customer->id,
                'total' => 0, // Temporary, will update after adding items
                'status' => 'pending',
            ]);

            // Add 1-3 items to each order
            $itemCount = rand(1, 3);
            $selectedProducts = $products->random($itemCount);
            
            foreach ($selectedProducts as $product) {
                $quantity = rand(1, 3);
                $price = $product->price;
                $itemTotal = $price * $quantity;
                $orderTotal += $itemTotal;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                ]);
            }

            // Update order total
            $order->update(['total' => $orderTotal]);
        }
    }
}