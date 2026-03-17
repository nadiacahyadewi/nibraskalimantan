<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // 1. Create Categories
        $categories = ['Gamis', 'Koko', 'Sarimbit', 'Mukena', 'Hijab'];
        foreach ($categories as $cat) {
            Category::updateOrCreate(['name' => $cat], ['slug' => strtolower($cat)]);
        }

        // 2. Create Brands
        $brands = ['Nibras', 'Alnita', 'HaiHai'];
        foreach ($brands as $brand) {
            Brand::updateOrCreate(['name' => $brand], ['slug' => strtolower($brand)]);
        }

        $allCategories = Category::all();
        $allBrands = Brand::all();

        // 3. Create 30 Random Products
        for ($i = 1; $i <= 30; $i++) {
            $category = $allCategories->random();
            $brand = $allBrands->random();
            $price = $faker->numberBetween(150000, 500000);

            $product = Product::updateOrCreate(
                ['name' => 'Produk ' . $faker->words(2, true) . ' ' . $i],
                [
                    'category_id' => $category->id,
                    'brand_id' => $brand->id,
                    'description' => $faker->paragraph(),
                    'price' => $price,
                    'color' => $faker->safeColorName(),
                    'slug' => 'produk-' . $i . '-' . time(),
                ]
            );

            // Create Variants S - XXL
            $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
            foreach ($sizes as $size) {
                ProductVariant::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'size' => $size,
                    ],
                    [
                        'price' => $price + ($faker->numberBetween(0, 5) * 5000),
                        'stock' => $faker->numberBetween(1, 7),
                    ]
                );
            }

            // Add Random Image (Landscape or Clothing)
            $keywords = ['landscape', 'scenery', 'nature', 'fashion', 'clothing', 'apparel'];
            $randomKeyword = $keywords[array_rand($keywords)];
            $imageUrl = "https://loremflickr.com/800/1000/" . $randomKeyword . "?random=" . $i;

            ProductImage::updateOrCreate(
                [
                    'product_id' => $product->id,
                    'is_primary' => true,
                ],
                [
                    'image_path' => $imageUrl,
                ]
            );
        }
    }
}
