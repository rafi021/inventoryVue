<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_code',
        'product_description',
        'product_root',
        'buying_price',
        'selling_price',
        'product_quantity',
        'alert_quantity',
        'buying_date',
        'product_image',
    ];
}
