<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client_Address extends Model
{
    protected $fillable = [
        'client_id',
        'country_id',
        'state_id',
        'active',
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
        'website_address_id',
        'created_at',
        'updated_at',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
