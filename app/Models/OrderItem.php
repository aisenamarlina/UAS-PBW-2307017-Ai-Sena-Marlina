<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * Nama tabel (opsional jika nama tabel Anda order_items)
     */
    protected $table = 'order_items';

    /**
     * Kolom yang boleh diisi
     */
    protected $fillable = [
        'order_id', 
        'product_id', 
        'quantity', 
        'price'
    ];

    /**
     * Relasi ke Produk: Setiap item merujuk ke satu produk
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Relasi ke Order: Setiap item adalah bagian dari satu pesanan
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Accessor untuk menghitung subtotal per item (Membantu di tampilan admin)
     */
    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->price;
    }
}