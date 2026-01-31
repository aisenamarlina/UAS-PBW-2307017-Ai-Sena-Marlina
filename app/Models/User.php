<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone', // Penting untuk koordinasi pesanan
        'address',
        'role', 
        'loyalty_points', // Sesuai logika OrderController Anda sebelumnya
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi Pesanan
     */
    public function orders() { 
        return $this->hasMany(Order::class); 
    }

    /**
     * Relasi Chat (Penting untuk adminInbox di ChatController)
     */
    public function sentMessages() {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages() {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * Relasi Lainnya
     */
    public function wishlist() { 
        return $this->hasMany(Wishlist::class); 
    }

    // Jika user juga bisa jadi penjual (Seller)
    public function products() { 
        return $this->hasMany(Product::class, 'seller_id'); 
    }

    /**
     * Helper: Cek apakah user adalah admin
     */
    public function isAdmin() {
        return $this->role === 'admin';
    }
}