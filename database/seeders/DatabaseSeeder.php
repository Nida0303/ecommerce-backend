<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run() {
        // Create 5 categories and 20 products
        Category::factory(5)->create()->each(function ($category) {
            $products = Product::factory(4)->create();
            $category->products()->attach($products);
        });
    }
}

