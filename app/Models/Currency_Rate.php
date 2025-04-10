<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency_Rate extends Model
{
    protected $fillable = [
        'reference_currency_id',
        'currency_id',
        'valability_date',
        'conversion_rate'
    ];

    public function referenceCurrency()
    {
        return $this->belongsTo(Currency::class, 'reference_currency_id');
    }

    public function targetCurrency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
