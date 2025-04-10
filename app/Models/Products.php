<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = "products";
    use HasFactory;

    protected $fillable = [
        'manufacturer_id', 'category_id', 'currency_id', 'tax_id',
        'price', 'reference', 'title', 'description','category_id',
        'file_type','active','available_for_order','display_price',
        'green_tax','manufacturer_reference','ean13','weight',
        'short_description','created_at','updated_at',
    ];

    public function manufacturer_id()
    {
        return $this->belongsTo(Manufacturer_id::class);
    }

    public function default_category_id()
    {
        return $this->belongsTo(Category::class);
    }

    public function reference()
    {
        return $this->belongsTo(Reference::class);
    }

    public function manufacturer_reference()
    {
        return $this->belongsTo(Manufacturer_reference::class);
    }

    public function ean13()
    {
        return $this->belongsTo(Ean13::class);
    }

    public function tax_id()
    {
        return $this->belongsTo(Tax_id::class);
    }

    public function currency_id()
    {
        return $this->belongsTo(Currency_id::class);
    }

}
