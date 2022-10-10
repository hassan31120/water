<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'is_special'
    ];

    public function subcategories(){
        return $this->hasMany(SubCategory::class, 'cat_id');
    }
}
