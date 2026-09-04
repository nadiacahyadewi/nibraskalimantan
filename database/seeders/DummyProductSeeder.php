<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use Illuminate\Support\Str;

class DummyProductSeeder extends Seeder
{
    public function run()
    {
        // Ensure some categories exist
        $categories = ['Gamis', 'Koko', 'Sarimbit', 'Tunik', 'Hijab', 'Mukena', 'Pakaian Anak'];
        $categoryIds = [];
        foreach ($categories as $cat) {
            $category = Category::firstOrCreate(
                ['name' => $cat],
                ['slug' => Str::slug($cat)]
            );
            $categoryIds[$cat] = $category->id;
        }

        // Ensure some brands exist
        $brands = ['Nibras', 'Alnita', 'Inspire', 'HaiHai'];
        $brandIds = [];
        foreach ($brands as $brand) {
            $brandModel = Brand::firstOrCreate(
                ['name' => $brand],
                ['slug' => Str::slug($brand)]
            );
            $brandIds[$brand] = $brandModel->id;
        }

        $dummyProducts = [
            // Gamis
            ['name' => 'Gamis Nibras NB B12', 'category' => 'Gamis', 'brand' => 'Nibras', 'price' => 248000, 'color' => 'Maroon'],
            ['name' => 'Gamis Nibras NB B14', 'category' => 'Gamis', 'brand' => 'Nibras', 'price' => 258000, 'color' => 'Navy'],
            ['name' => 'Gamis Inspire B01', 'category' => 'Gamis', 'brand' => 'Inspire', 'price' => 210000, 'color' => 'Black'],
            ['name' => 'Gamis Alnita A 02', 'category' => 'Gamis', 'brand' => 'Alnita', 'price' => 195000, 'color' => 'Dusty Pink'],
            ['name' => 'Gamis Nibras NB A34', 'category' => 'Gamis', 'brand' => 'Nibras', 'price' => 228000, 'color' => 'Olive'],
            ['name' => 'Gamis Syari Nibras NS 70', 'category' => 'Gamis', 'brand' => 'Nibras', 'price' => 310000, 'color' => 'Mustard'],
            ['name' => 'Gamis HaiHai H 10', 'category' => 'Gamis', 'brand' => 'HaiHai', 'price' => 275000, 'color' => 'Grey'],
            
            // Koko
            ['name' => 'Koko Nibras NK 101', 'category' => 'Koko', 'brand' => 'Nibras', 'price' => 188000, 'color' => 'White'],
            ['name' => 'Koko Nibras NK 102', 'category' => 'Koko', 'brand' => 'Nibras', 'price' => 198000, 'color' => 'Blue'],
            ['name' => 'Koko Alnita AK 01', 'category' => 'Koko', 'brand' => 'Alnita', 'price' => 175000, 'color' => 'Black'],
            ['name' => 'Koko Inspire K 02', 'category' => 'Koko', 'brand' => 'Inspire', 'price' => 165000, 'color' => 'Brown'],
            ['name' => 'Koko Nibras NK 105', 'category' => 'Koko', 'brand' => 'Nibras', 'price' => 195000, 'color' => 'Maroon'],
            
            // Sarimbit
            ['name' => 'Sarimbit Nibras 2024 Keluarga A', 'category' => 'Sarimbit', 'brand' => 'Nibras', 'price' => 950000, 'color' => 'Purple'],
            ['name' => 'Sarimbit Nibras 2024 Keluarga B', 'category' => 'Sarimbit', 'brand' => 'Nibras', 'price' => 1100000, 'color' => 'Navy'],
            ['name' => 'Sarimbit Lebaran Inspire 01', 'category' => 'Sarimbit', 'brand' => 'Inspire', 'price' => 850000, 'color' => 'Green'],
            ['name' => 'Sarimbit Alnita Family 02', 'category' => 'Sarimbit', 'brand' => 'Alnita', 'price' => 780000, 'color' => 'Red'],
            ['name' => 'Sarimbit Nibras Eksklusif 01', 'category' => 'Sarimbit', 'brand' => 'Nibras', 'price' => 1250000, 'color' => 'Gold'],
            
            // Tunik
            ['name' => 'Tunik Nibras NT 01', 'category' => 'Tunik', 'brand' => 'Nibras', 'price' => 178000, 'color' => 'Pink'],
            ['name' => 'Tunik Nibras NT 02', 'category' => 'Tunik', 'brand' => 'Nibras', 'price' => 188000, 'color' => 'Blue'],
            ['name' => 'Tunik Inspire T 05', 'category' => 'Tunik', 'brand' => 'Inspire', 'price' => 155000, 'color' => 'White'],
            ['name' => 'Tunik Alnita AT 03', 'category' => 'Tunik', 'brand' => 'Alnita', 'price' => 165000, 'color' => 'Yellow'],
            ['name' => 'Tunik Nibras Casual 01', 'category' => 'Tunik', 'brand' => 'Nibras', 'price' => 198000, 'color' => 'Black'],
            
            // Hijab
            ['name' => 'Khimar Nibras Pad 01', 'category' => 'Hijab', 'brand' => 'Nibras', 'price' => 85000, 'color' => 'Black'],
            ['name' => 'Pashmina Inspire 02', 'category' => 'Hijab', 'brand' => 'Inspire', 'price' => 65000, 'color' => 'Grey'],
            ['name' => 'Bergo Alnita 03', 'category' => 'Hijab', 'brand' => 'Alnita', 'price' => 75000, 'color' => 'Navy'],
            ['name' => 'Khimar Syari Nibras 05', 'category' => 'Hijab', 'brand' => 'Nibras', 'price' => 125000, 'color' => 'Maroon'],
            
            // Pakaian Anak
            ['name' => 'Gamis Anak Nibras NSA 01', 'category' => 'Pakaian Anak', 'brand' => 'Nibras', 'price' => 188000, 'color' => 'Pink'],
            ['name' => 'Koko Anak Nibras NKA 02', 'category' => 'Pakaian Anak', 'brand' => 'Nibras', 'price' => 168000, 'color' => 'Blue'],
            ['name' => 'Setelan Anak Inspire 01', 'category' => 'Pakaian Anak', 'brand' => 'Inspire', 'price' => 145000, 'color' => 'Green'],
            ['name' => 'Gamis Anak Alnita AA 03', 'category' => 'Pakaian Anak', 'brand' => 'Alnita', 'price' => 155000, 'color' => 'Yellow'],
        ];

        // Some unsplash fashion images to simulate products
        $images = [
            'https://images.unsplash.com/photo-1596245084920-f5a608fc1c76?auto=format&fit=crop&q=80&w=600',
            'https://images.unsplash.com/photo-1589156229687-496a31ad1d1f?auto=format&fit=crop&q=80&w=600',
            'https://images.unsplash.com/photo-1607598852330-fb744f4e24eb?auto=format&fit=crop&q=80&w=600',
            'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&q=80&w=600',
            'https://images.unsplash.com/photo-1620799140408-edc6dcb6d633?auto=format&fit=crop&q=80&w=600',
            'https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&q=80&w=600',
            'https://images.unsplash.com/photo-1532453288672-3a27e9be9efd?auto=format&fit=crop&q=80&w=600',
            'https://images.unsplash.com/photo-1502716119720-b23a93e5fe1b?auto=format&fit=crop&q=80&w=600'
        ];

        foreach ($dummyProducts as $idx => $item) {
            $product = Product::create([
                'name' => $item['name'],
                'description' => 'Ini adalah deskripsi produk ' . $item['name'] . '. Produk ini dibuat dengan bahan berkualitas tinggi, nyaman dipakai, dan cocok untuk berbagai acara.',
                'price' => $item['price'],
                'color' => $item['color'],
                'category_id' => $categoryIds[$item['category']],
                'brand_id' => $brandIds[$item['brand']],
                'weight' => rand(300, 800),
            ]);

            // Add variants
            $sizes = ['S', 'M', 'L', 'XL', 'XXL'];
            foreach ($sizes as $size) {
                // Sometime out of stock
                $stock = rand(0, 50);
                
                ProductVariant::create([
                    'product_id' => $product->id,
                    'size' => $size,
                    'price' => $item['price'],
                    'discount_price' => rand(0, 1) ? $item['price'] - rand(10000, 30000) : null,
                    'purchase_price' => $item['price'] - 50000,
                    'stock' => $stock
                ]);
            }

            // Add images (1 to 3 images)
            $imgCount = rand(1, 3);
            for ($i = 0; $i < $imgCount; $i++) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $images[array_rand($images)]
                ]);
            }
        }
    }
}
