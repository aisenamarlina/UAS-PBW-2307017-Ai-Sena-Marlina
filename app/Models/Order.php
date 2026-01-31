<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     */
    protected $table = 'orders';

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        'user_id', 
        'customer_name', 
        'phone', 
        'address', 
        'total_price', 
        'status', 
        'payment_method'
    ];

    /**
     * RELASI PENTING: Satu pesanan memiliki banyak item produk
     * Inilah yang memperbaiki error "undefined relationship [items]"
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    /**
     * Relasi ke User (Satu pesanan dimiliki oleh satu user)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor untuk memformat harga (Gunakan format getXAttribute)
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }
}