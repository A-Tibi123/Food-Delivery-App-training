<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'iso_code',
        'name',
        'call_prefix',
        'zip_code_format',
        'need_zip_code',
        'active',
        'contains_states',
    ];

    public function states()
    {
        return $this->hasMany(State::class);
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
