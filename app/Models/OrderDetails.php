<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Service;

class OrderDetails extends Model
{
    protected $table = 'order_details';

    protected $fillable = [
        'id_order',
        'id_service',
        'qty',
        'subtotal',
        'note',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }
}
