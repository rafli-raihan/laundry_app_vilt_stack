<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Customer;
use App\Models\OrderDetails;
use App\Models\OrderPickup;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_customer',
        'order_date',
        'order_end_date',
        'order_status',
        'order_pay',
        'order_change',
        'total',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function details()
    {
        return $this->hasMany(OrderDetails::class, 'id_order');
    }

    public function pickups()
    {
        return $this->hasMany(OrderPickup::class, 'id_order');
    }
}
