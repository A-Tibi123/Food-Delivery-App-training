<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Status extends Model
{
    protected $fillable = [
        'active',
        'name',
        'color',
        'validated',
        'invoiced',
        'shipped',
        'finalised',
        'created_at',
        'updated_at'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
