<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Product::truncate();

        $products = [
            [
                'id' => 1, 'name' => 'Dompet Panjang Pria', 'category' => 'Dompet',
                'price' => 200000, 'stock' => 10, 'seller_id' => 1,
                'image' => 'dompetp-68f4b246ed64152b57732dd2.jpg',
                'description' => 'Dompet kulit asli model panjang dengan jahitan tangan yang rapi.'
            ],
            [
                'id' => 2, 'name' => 'Dompet Pendek Pria', 'category' => 'Dompet',
                'price' => 125000, 'stock' => 15, 'seller_id' => 1,
                'image' => 'dompppet-68f4b2a5ed64152e8c73adf2.jpg',
                'description' => 'Dompet kulit lipat standar, simpel dan elegan untuk penggunaan harian.'
            ],
            [
                'id' => 3, 'name' => 'ID Card', 'category' => 'ID Card',
                'price' => 100000, 'stock' => 20, 'seller_id' => 1,
                'image' => 'id-68f4b2f434777c3d8a5035a2.jpg',
                'description' => 'Tempat kartu identitas (ID Card) kulit premium untuk tampilan profesional.'
            ],
            [
                'id' => 4, 'name' => 'Gantungan Kunci, Tempat STNK', 'category' => 'Aksesoris',
                'price' => 125000, 'stock' => 12, 'seller_id' => 1,
                'image' => 'dompettt-68f4b34934777c43a6172872.jpg',
                'description' => 'Gantungan kunci multifungsi yang dilengkapi tempat penyimpanan STNK.'
            ],
            [
                'id' => 5, 'name' => 'Tempat Kartu', 'category' => 'Aksesoris',
                'price' => 80000, 'stock' => 30, 'seller_id' => 1,
                'image' => 'dompetk-68f4b43ec925c47cd01e3082.jpg',
                'description' => 'Card holder minimalis untuk menyimpan kartu ATM dan kartu nama.'
            ],
            [
                'id' => 6, 'name' => 'Gantungan Kunci', 'category' => 'Aksesoris',
                'price' => 50000, 'stock' => 50, 'seller_id' => 1,
                'image' => 'gantungann-68f4b51dc925c404b611bfc3.jpg',
                'description' => 'Aksesoris gantungan kunci handmade dari sisa potongan kulit asli berkualitas.'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        Schema::enableForeignKeyConstraints();
    }
}