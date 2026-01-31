<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder {
    public function run(){
        // Admin
        User::create([
            'name'=>'Admin Leather',
            'email'=>'admin@leather.com',
            'password'=>Hash::make('password'),
            'role'=>'admin'
        ]);

        // User
        User::create([
            'name'=>'Ai Hilma',
            'email'=>'user@leather.com',
            'password'=>Hash::make('password'),
            'role'=>'user'
        ]);

        // Dummy Products
        $admin = User::where('role','admin')->first();
        Product::create([
            'name'=>'Leather Wallet',
            'category'=>'wallet',
            'price'=>50,
            'stock'=>10,
            'description'=>'Premium handmade leather wallet from Garut.',
            'seller_id'=>$admin->id
        ]);

        Product::create([
            'name'=>'Leather Bag',
            'category'=>'bag',
            'price'=>120,
            'stock'=>5,
            'description'=>'Elegant leather bag, perfect for daily use.',
            'seller_id'=>$admin->id
        ]);

        Product::create([
            'name'=>'Leather Belt',
            'category'=>'belt',
            'price'=>35,
            'stock'=>20,
            'description'=>'Durable leather belt handcrafted in Garut.',
            'seller_id'=>$admin->id
        ]);
    }
}
