<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'id' => 1,
                'name' => 'Dompet Panjang Pria',
                'category' => 'Dompet',
                'price' => 200000,
                'stock' => 50, // Menambahkan stock
                'image' => 'https://assets.kompasiana.com/items/album/2025/10/19/dompetp-68f4b246ed64152b57732dd2.jpg',
                'description' => 'Dompet kulit asli desain elegan.'
            ],
            [
                'id' => 2,
                'name' => 'Dompet Pria Pendek',
                'category' => 'Dompet',
                'price' => 150000,
                'stock' => 50,
                'image' => 'https://assets.kompasiana.com/items/album/2025/10/19/dompppet-68f4b2a5ed64152e8c73adf2.jpg',
                'description' => 'Dompet saku minimalis.'
            ],
            [
                'id' => 3,
                'name' => 'ID Card Kulit',
                'category' => 'ID Card',
                'price' => 85000,
                'stock' => 100,
                'image' => 'https://assets.kompasiana.com/items/album/2025/10/19/id-68f4b2f434777c3d8a5035a2.jpg',
                'description' => 'Lanyard kulit berkualitas.'
            ],
            [
                'id' => 4,
                'name' => 'Gantungan Kunci STNK',
                'category' => 'Aksesoris',
                'price' => 55000,
                'stock' => 100,
                'image' => 'https://assets.kompasiana.com/items/album/2025/10/19/dompettt-68f4b34934777c43a6172872.jpg',
                'description' => 'Dompet STNK anti hilang.'
            ],
            [
                'id' => 5,
                'name' => 'Card Holder Unisex',
                'category' => 'Aksesoris',
                'price' => 120000,
                'stock' => 75,
                'image' => 'https://assets.kompasiana.com/items/album/2025/10/19/dompetk-68f4b43ec925c47cd01e3082.jpg',
                'description' => 'Penyimpan kartu praktis.'
            ],
            [
                'id' => 6,
                'name' => 'Gantungan Kunci',
                'category' => 'Aksesoris',
                'price' => 35000,
                'stock' => 200,
                'image' => 'https://assets.kompasiana.com/items/album/2025/10/19/gantungann-68f4b51dc925c404b611bfc3.jpg',
                'description' => 'Aksesoris kunci kulit.'
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(['id' => $product['id']], $product);
        }
    }
}