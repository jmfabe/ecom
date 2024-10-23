<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Product 1',
            'price' => 100,
            'description' => 'Description for Sample Product 1',
        ]);
        Product::create([
            'name' => 'Product 2',
            'price' => 200,
            'description' => 'Description for Sample Product 2',
        ]);
        Product::create([
            'name' => 'Product 3',
            'price' => 150,
            'description' => 'Description for Sample Product 3',
        ]);
        Product::create([
            'name' => 'Product 4',
            'price' => 250,
            'description' => 'Description for Sample Product 4',
        ]);
        Product::create([
            'name' => 'Product 5',
            'price' => 100,
            'description' => 'Description for Sample Product 5',
        ]);
        Product::create([
            'name' => 'Product 6',
            'price' => 200,
            'description' => 'Description for Sample Product 6',
        ]);
        Product::create([
            'name' => 'Product 7',
            'price' => 150,
            'description' => 'Description for Sample Product 7',
        ]);
        Product::create([
            'name' => 'Product 8',
            'price' => 250,
            'description' => 'Description for Sample Product 8',
        ]);
    }
}
