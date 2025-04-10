<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'default_address_id',
        'email',
        'firstname',
        'lastname',
        'sex',
        'phone',
        'birth_date',
        'status',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'created_at',
        'updated_at',
    ];

    public function defaultAddress()
    {
        return $this->belongsTo(ClientAddress::class, 'default_address_id');
    }

    public function addresses()
    {
        return $this->hasMany(ClientAddress::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
