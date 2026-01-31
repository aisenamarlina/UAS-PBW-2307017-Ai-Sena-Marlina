<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    // Ini wajib ada agar pesan bisa tersimpan!
    protected $fillable = ['sender_id', 'receiver_id', 'message'];
}