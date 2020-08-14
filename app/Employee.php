<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'salary',
        'photo',
        'nid',
        'address',
        'joining_date'
    ];
}
