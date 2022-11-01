<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subTotal',
        'total',
        'grandTotal',
        'cart_id',
        'address_id',
        'pay_status',
        'status'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address(){
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function cart(){
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

}
