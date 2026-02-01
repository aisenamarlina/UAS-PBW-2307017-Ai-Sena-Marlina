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
        'phone',
        'address',
        'role', 
        'loyalty_points',
        // --- TAMBAHKAN KOLOM BERIKUT AGAR BISA DISIMPAN ---
        'avatar',
        'birthday',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date', // Otomatis mengubah string tgl menjadi objek Carbon
    ];

    /**
     * Relasi Pesanan
     */
    public function orders() { 
        return $this->hasMany(Order::class); 
    }

    /**
     * Relasi Chat
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