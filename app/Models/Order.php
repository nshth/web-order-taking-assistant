<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_Item;
use App\Models\Customer;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(Order_Item::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
