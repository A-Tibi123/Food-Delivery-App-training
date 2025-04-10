<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    use HasFactory;

    protected $fillable = [
        'currency_id',
        'client_id',
        'address_invoice',
        'address_delivery',
        'carrier_id',
        'payment_id',
        'total_products',
        'total_taxes',
        'total_discounts',
        'total_delivery',
        'total',
        'active',
        'identifier',
        'client_name',
        'client_email',
        'client_phone',
        'created_at',
        'updated_at',
    ];

    public function currency_id()
    {
        return $this->belongsTo(Currency::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function invoice_Address()
    {
        return $this->belongsTo(ClientAddress::class, 'address_invoice');
    }

    public function delivery_Address()
    {
        return $this->belongsTo(ClientAddress::class, 'address_delivery');
    }

    public function carrier_id()
    {
        return $this->belongsTo(Carrierid::class);
    }

    public function payment_id()
    {
        return $this->belongsTo(Paymentid::class);
    }
}
