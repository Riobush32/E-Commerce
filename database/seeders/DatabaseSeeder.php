<?php

namespace Database\Seeders;

use App\Models\Icon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Models\ProductPhoto;
use Illuminate\Database\Seeder;
use Database\Factories\IconFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $factory = new IconFactory();
        try {
            $factory->insertAll();
            echo "Data berhasil dimasukkan";
        } catch (\Exception $e) {
            dd('Gagal menyisipkan data: ', $e->getMessage());
        }

        
        $products = Product::factory(200)->recycle([
            Category::factory(15)->create(),
            Brand::factory(30)->create()
        ])->create();

        // Gunakan produk yang sudah dibuat untuk Variant dan ProductPhoto
        $variants = Variant::factory(500)->create([
            'product_id' => $products->random()->id,
        ]);

        // Gunakan variant yang sudah dibuat untuk ProductPhoto
        ProductPhoto::factory(600)->create([
            'product_id' => $products->random()->id,
        ]);




    }
}
