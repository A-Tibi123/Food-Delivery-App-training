<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Address extends Model
{
    protected $fillable = [
        'order_id',
        'country_id',
        'state_id',
        'client_address_id',
        'district',
        'city',
        'street',
        'street_nb',
        'other',
        'postcode',
        'pj_pf',
        'company_name',
        'cui',
        'nr_reg',
        'bank',
        'iban',
        'observations',
        'created_at',
        'updated_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function clientAddress()
    {
        return $this->belongsTo(ClientAddress::class);
    }
}
