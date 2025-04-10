<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = "orders";
    use HasFactory;

    protected $fillable = [
        'currency_id',
        'cart_id',
        'client_id',
        'address_invoice',
        'address_delivery',
        'carrier_id',
        'payment_id',
        'order_status_id',
        'total_products',
        'total_taxes',
        'total_discounts',
        'total_delivery',
        'total',
        'client_name',
        'client_email',
        'client_phone',
        'created_at',
        'updated_at'
    ];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function invoiceAddress()
    {
        return $this->belongsTo(ClientAddress::class, 'address_invoice');
    }

    public function deliveryAddress()
    {
        return $this->belongsTo(ClientAddress::class, 'address_delivery');
    }

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }
}
