<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('foods')->insert([
            [
                'name' => 'Chicken Wings',
                'price' => '15',
                'category' => 'Breakfast',
                'description' => 'Classic Chicken Wings.',
                'image' => 'menu-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Chicken Burger',
                'price' => '10',
                'category' => 'Lunch',
                'description' => 'Fresh romaine lettuce with Caesar dressing, croutons, and Parmesan cheese.',
                'image' => 'menu-1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pizza Margherita',
                'price' => '12.99',
                'category' => 'Dinner',
                'description' => 'Classic pizza with tomato sauce, mozzarella, and basil.',
                'image' => 'menu-7.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
