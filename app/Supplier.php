<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'photo',
        'shopname',
    ];

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
