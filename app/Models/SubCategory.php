<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    public function categories(){
        return $this->belongsTo(Category::class, 'cat_id');
    }
}
