<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subTotal',
        'total',
        'grandTotal'
    ];

    public function cartItems(){
        return $this->hasMany(CartItem::class, 'cart_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'cart_id');
    }
}
