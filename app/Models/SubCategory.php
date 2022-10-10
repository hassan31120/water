<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cat_id',
        'is_special'
    ];

    public function categories(){
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function products(){
        return $this->hasMany(Product::class, 'sub_id');
    }
}
