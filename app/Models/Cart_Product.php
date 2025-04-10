<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_Product extends Model
{
    protected $table = 'cart_product'; 

    protected $fillable = [
        'cart_id',
        'product_id',
        'tax_id',
        'quantity',
        'price',
        'green_tax',
        'identifier',
        'created_at',
        'updated_at'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function tax()
    {
        return $this->belongsTo(Tax::class);
    }
}
