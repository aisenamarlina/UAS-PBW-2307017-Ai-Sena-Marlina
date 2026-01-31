<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'user_id',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class,'seller_id');
    }
}
