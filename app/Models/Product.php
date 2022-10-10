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
        'image2',
        'image3',
        'image4',
        'image5',
        'old_price',
        'new_price',
        'sub_id',
        'is_special'
    ];

    public function subcategories(){
        return $this->belongsTo(SubCategory::class, 'sub_id');
    }
}
