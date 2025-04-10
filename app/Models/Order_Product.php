<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Product extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'tax_id',
        'quantity',
        'price',
        'green_tax',
        'product_name',
        'created_at',
        'updated_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
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
