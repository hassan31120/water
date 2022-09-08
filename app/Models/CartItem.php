<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'amount',
        'image',
        'old_price',
        'new_price',
        'cart_id'
    ];

    public function carts(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }
}
