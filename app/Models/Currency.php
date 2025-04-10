<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'name',
        'code',
        'numerical_code',
        'sign',
        'active',
        'is_default',
    ];

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function carriers()
    {
        return $this->hasMany(Carrier::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
