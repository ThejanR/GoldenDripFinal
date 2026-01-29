<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // We need to create this Model next!

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Hot Coffee',  'slug' => 'hot-coffee',  'image' => 'images/cappuccino.png'],
            ['name' => 'Cold Coffee', 'slug' => 'cold-coffee', 'image' => 'images/iced_americano.png'],
            ['name' => 'Shakes',      'slug' => 'shakes',      'image' => 'images/strawberry.png'],
            ['name' => 'Sweets',      'slug' => 'sweets',      'image' => 'images/chocodo.png'],
        ];

        foreach ($categories as $category) {
            // This creates the category if it doesn't exist
            \Illuminate\Support\Facades\DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'image' => $category['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}