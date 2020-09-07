<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'product_quantity',
        'product_price',
        'sub_total',
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function products(){
        return $this->hasMany('App\Product','id','product_id');
    }
}
