<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'amount',
        'image',
        'old_price',
        'new_price',
        'sub_id'
    ];

    public function subcategories(){
        return $this->belongsTo(SubCategory::class, 'sub_id');
    }
}
