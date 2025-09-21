<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Customer;

class OrderPickup extends Model
{
    protected $table = 'order_pickups';

    protected $fillable = [
        'id_order',
        'id_customer',
        'pickup_date',
        'note',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
