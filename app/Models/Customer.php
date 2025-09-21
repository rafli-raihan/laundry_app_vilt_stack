<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $filable = [
        'customer_name',
        'phone',
        'address'
    ];
}
