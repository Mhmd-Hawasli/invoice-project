<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            "product_name" => "Product One",
            "description" => "This is Product one",
            "user_id" => "1",
            "section_id" => "1",
        ]);
    }
}
