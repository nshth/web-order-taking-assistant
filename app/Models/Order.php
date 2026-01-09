<?php

namespace App\Models;

use App\Enum\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItems;
use App\Models\Customer;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected $casts = [
            'status' => OrderStatusEnum::class,
        ];

    public function calculateTotal(): void
    {
        $total = $this->orderItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        
        $this->update(['total' => $total]);
    }
    //if i want to multiple order items from same order,
    // make a subtotal column for order item and insert it and then use this logic or just add the subtotal and calculate order total
}
