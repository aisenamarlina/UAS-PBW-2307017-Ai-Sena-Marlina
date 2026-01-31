<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $blade) {
            $blade->id();
            $blade->foreignId('user_id')->constrained()->onDelete('cascade');
            $blade->string('customer_name');
            $blade->string('phone');
            $blade->text('address');
            $blade->decimal('total_price', 15, 2);
            $blade->string('status')->default('pending'); // pending, processing, completed, cancelled
            $blade->string('payment_method')->default('COD');
            $blade->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};