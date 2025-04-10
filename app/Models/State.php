<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'country_id',
        'name',
        'iso_code',
        'active',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function clientAddresses()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function orderAddresses()
    {
        return $this->hasMany(OrderAddress::class);
    }
}
