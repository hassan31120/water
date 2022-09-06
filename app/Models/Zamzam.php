<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zamzam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'amount',
        'image',
        'old_price',
        'new_price'
    ];
}
