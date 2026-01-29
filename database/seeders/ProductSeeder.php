<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DISABLE SAFETY LOCK (To clear tables without errors)
        Schema::disableForeignKeyConstraints();

        // 2. Clear existing data so we don't get duplicates
        DB::table('products')->truncate();
        DB::table('categories')->truncate();

        // 3. RE-ENABLE SAFETY LOCK
        Schema::enableForeignKeyConstraints();

        // 4. Create Categories & Capture their IDs
        // We save the ID (like '1') into a variable so we can use it later
        $hotCoffeeId = DB::table('categories')->insertGetId([
            'name' => 'Hot Coffee', 'slug' => 'hot-coffee', 'image' => 'images/latte.png', 'created_at' => now(), 'updated_at' => now()
        ]);

        $coldCoffeeId = DB::table('categories')->insertGetId([
            'name' => 'Cold Coffee', 'slug' => 'cold-coffee', 'image' => 'images/iced_americano.png', 'created_at' => now(), 'updated_at' => now()
        ]);

        $shakesId = DB::table('categories')->insertGetId([
            'name' => 'Shakes', 'slug' => 'shakes', 'image' => 'images/chocoshake.png', 'created_at' => now(), 'updated_at' => now()
        ]);

        $sweetsId = DB::table('categories')->insertGetId([
            'name' => 'Sweets', 'slug' => 'sweets', 'image' => 'images/chocodo.png', 'created_at' => now(), 'updated_at' => now()
        ]);

        // 5. Insert Products (Linked by ID)
        // Notice we use 'category_id' => $variable, NOT 'category' => 'text'
        DB::table('products')->insert([
            // --- HOT COFFEE ---
            ['category_id' => $hotCoffeeId, 'name' => 'Golden Latte', 'description' => 'Our signature blend infused with turmeric, cinnamon, and honey.', 'price' => 6.50, 'image' => 'images/golden_latte.png', 'badge' => 'Signature', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $hotCoffeeId, 'name' => 'Classic Cappuccino', 'description' => 'Rich espresso lying in wait under a smoothed layer of thick milk foam.', 'price' => 5.50, 'image' => 'images/cappuccino.png', 'badge' => 'Classic', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $hotCoffeeId, 'name' => 'Caffè Latte', 'description' => 'A shot of espresso in steamed milk with a light layer of foam.', 'price' => 5.00, 'image' => 'images/latte.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $hotCoffeeId, 'name' => 'Espresso', 'description' => 'A concentrated dose of rich, bold coffee flavor.', 'price' => 3.00, 'image' => 'images/expresso.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $hotCoffeeId, 'name' => 'Flat White', 'description' => 'Smooth ristretto shots of espresso with velvety microfoam.', 'price' => 5.25, 'image' => 'images/flat.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $hotCoffeeId, 'name' => 'Caffè Mocha', 'description' => 'Rich espresso, bittersweet cocoa sauce and steamed milk.', 'price' => 5.75, 'image' => 'images/mocha.png', 'badge' => 'Sweet', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $hotCoffeeId, 'name' => 'Caffè Americano', 'description' => 'Espresso shots topped with hot water.', 'price' => 4.00, 'image' => 'images/americano.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $hotCoffeeId, 'name' => 'Latte Macchiato', 'description' => 'Steamed milk marked with a shot of espresso.', 'price' => 5.50, 'image' => 'images/macchiato.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],

            // --- COLD COFFEE ---
            ['category_id' => $coldCoffeeId, 'name' => 'Iced Americano', 'description' => 'Espresso shots topped with cold water and ice.', 'price' => 4.50, 'image' => 'images/iced_americano.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $coldCoffeeId, 'name' => 'Cold Brew Special', 'description' => 'Slow-steeped cool coffee blend served over ice.', 'price' => 4.95, 'image' => 'images/cold.png', 'badge' => 'Refresh', 'created_at' => now(), 'updated_at' => now()],

            // --- SHAKES ---
            ['category_id' => $shakesId, 'name' => 'Strawberry Shake', 'description' => 'Creamy strawberry milkshake topped with whipped cream.', 'price' => 6.00, 'image' => 'images/strawberry.png', 'badge' => 'New', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $shakesId, 'name' => 'Chocolate Shake', 'description' => 'Rich chocolate milkshake for the ultimate sweet tooth.', 'price' => 6.00, 'image' => 'images/chocoshake.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $shakesId, 'name' => 'Vanilla Shake', 'description' => 'Classic vanilla bean milkshake, smooth and creamy.', 'price' => 5.75, 'image' => 'images/vanillashake.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $shakesId, 'name' => 'Coffee Frappe', 'description' => 'Coffee blended with ice and milk for a frozen treat.', 'price' => 6.25, 'image' => 'images/coffeeshake.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],

            // --- SWEETS ---
            ['category_id' => $sweetsId, 'name' => 'Chocolate Donut', 'description' => 'Fresh donut dipped in rich dark chocolate glaze.', 'price' => 3.50, 'image' => 'images/chocodo.png', 'badge' => 'Bestseller', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $sweetsId, 'name' => 'Glazed Donut', 'description' => 'Classic soft donut with a sweet sugar glaze.', 'price' => 3.00, 'image' => 'images/glazeddo.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $sweetsId, 'name' => 'Strawberry Donut', 'description' => 'Donut topped with pink strawberry frosting and sprinkles.', 'price' => 3.50, 'image' => 'images/strawdo.png', 'badge' => 'Kids Love', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $sweetsId, 'name' => 'Butter Croissant', 'description' => 'Flaky, buttery pastry baked fresh daily.', 'price' => 4.25, 'image' => 'images/buttercro.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $sweetsId, 'name' => 'Chocolate Croissant', 'description' => 'Buttery croissant filled with rich chocolate.', 'price' => 4.75, 'image' => 'images/choccro.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => $sweetsId, 'name' => 'Chocolate Muffin', 'description' => 'Moist muffin loaded with chocolate chips.', 'price' => 3.75, 'image' => 'images/chocomuffin.png', 'badge' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}