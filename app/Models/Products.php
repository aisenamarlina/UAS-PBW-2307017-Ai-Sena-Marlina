<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'name','category','price','stock','description','image','seller_id'
    ];

    public function seller(){
        return $this->belongsTo(User::class,'seller_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
