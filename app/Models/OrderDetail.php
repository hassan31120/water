<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'old_price',
        'new_price',
        'quantity',
        'order_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
