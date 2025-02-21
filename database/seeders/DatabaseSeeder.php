<?php

namespace Database\Seeders;

use App\Models\Icon;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductPhoto;
use Illuminate\Database\Seeder;
use Database\Factories\IconFactory;
use Illuminate\Support\Facades\Hash;

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

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory(5)->create();

        // $products = Product::factory(200)->recycle([
        //     Category::factory(15)->create(),
        //     Brand::factory(30)->create()
        // ])->create();

        // Gunakan produk yang sudah dibuat untuk Variant dan ProductPhoto
        // foreach ($products as $product) {
        //     Variant::factory(2)->create([
        //         'product_id' => $product->id,
        //     ]);
        // }

        // Gunakan variant yang sudah dibuat untuk ProductPhoto
        // foreach ($products as $product) {
        //     ProductPhoto::factory(3)->create([
        //         'product_id' => $product->id,
        //     ]);
        // }


        Category::factory(15)->create();
        Brand::factory(30)->create();
    }
}