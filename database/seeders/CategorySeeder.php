<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Bahan Pokok',
                'description' => '15 Produk Tersedia'
            ],
            [
                'name' => 'Bumbu Dapur',
                'description' => '22 Produk Tersedia'
            ],
            [
                'name' => 'Minuman',
                'description' => '10 Produk Tersedia'
            ],
            [
                'name' => 'Makanan Ringan',
                'description' => '26 Produk Tersedia'
            ],
            [
                'name' => 'Mie Instant',
                'description' => '22 Produk Tersedia'
            ],
            [
                'name' => 'Peralatan Mandi',
                'description' => '9 Produk Tersedia'
            ],
            [
                'name' => 'Deterjen & Baju',
                'description' => '13 Produk Tersedia'
            ],
            [
                'name' => 'Rokok',
                'description' => '28 Produk Tersedia'
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description']
            ]);
        }
    }
}
