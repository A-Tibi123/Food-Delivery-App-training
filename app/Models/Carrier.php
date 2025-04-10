<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    protected $fillable = [
        'currency_id',
        'tax_id',
        'position',
        'is_free',
        'active',
        'deleted',
        'max_width',
        'max_height',
        'max_depth',
        'max_weight',
        'price',
        'name',
        'description',
        'created_at',
        'updated_at',
    ];

    // 🔗 Relationships

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }
}