<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email', 'phone',
        'address', 'city', 'zip_code', 'payment_method', 'delivery_method',
        'total_amount', 'status'
    ];

    // Relationship: An Order has many Items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}