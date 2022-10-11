<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'name',
        'number',
        'governorate',
        'city',
        'city_id',
        'lat',
        'long'
    ];

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'address_id');
    }

    public function cities(){
        return $this->belongsTo(City::class, 'city_id');
    }
}
