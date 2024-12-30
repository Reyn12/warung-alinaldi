<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $makananRingan = Category::where('name', 'Makanan Ringan')->first()->id;
        $minuman = Category::where('name', 'Minuman')->first()->id;
        $bahanPokok = Category::where('name', 'Bahan Pokok')->first()->id;
        $peralatanMandi = Category::where('name', 'Peralatan Mandi')->first()->id;
        $mieInstant = Category::where('name', 'Mie Instant')->first()->id;
        $deterjen = Category::where('name', 'Deterjen & Baju')->first()->id;

        $products = [
            [
                'name' => 'Hatari Biskuit',
                'description' => 'Biskuit dengan rasa cokelat',
                'price' => 7500,
                'stock' => 50,
                'barcode' => '8997025913038',
                'image' => 'images/products/hatari.jpg',
                'category_id' => $makananRingan
            ],
            [
                'name' => 'Indomie Goreng',
                'description' => 'Mie instant goreng original',
                'price' => 3500,
                'stock' => 100,
                'barcode' => '8998866200012',
                'image' => 'images/products/indomie-goreng.jpg',
                'category_id' => $mieInstant
            ],
            [
                'name' => 'Beras Pandan Wangi 5kg',
                'description' => 'Beras premium kualitas terbaik',
                'price' => 68000,
                'stock' => 30,
                'barcode' => '8995678100013',
                'image' => 'images/products/beras.jpg',
                'category_id' => $bahanPokok
            ],
            [
                'name' => 'Rinso Cair 800ml',
                'description' => 'Deterjen cair untuk mesin cuci',
                'price' => 25000,
                'stock' => 40,
                'barcode' => '8995678500030',
                'image' => 'images/products/rinso.jpg',
                'category_id' => $deterjen
            ],
            [
                'name' => 'Teh Pucuk Harum 350ml',
                'description' => 'Minuman teh dalam kemasan',
                'price' => 5000,
                'stock' => 120,
                'barcode' => '8995678300012',
                'image' => 'images/products/teh-pucuk.jpg',
                'category_id' => $minuman
            ],
            [
                'name' => 'Sabun Lifebuoy 250ml',
                'description' => 'Sabun mandi cair',
                'price' => 25000,
                'stock' => 40,
                'barcode' => '8995678500016',
                'image' => 'images/products/lifebuoy.jpg',
                'category_id' => $peralatanMandi
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
