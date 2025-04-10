<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'name',
        'iso_code',
        'language_code',
        'date_format_lite',
        'date_format_full',
        'display_order',
        'active',
        'is_rtl',
    ];

    
}
