<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable =[
        'name',
        'email',
        'phone',
        'address',
        'photo',
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
