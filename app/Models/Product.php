<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_Item;
use App\Enum\ProductStatusEnum;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $guarded = [];

    public function orderItems()
    {
        return $this->hasMany(Order_Item::class);
    }

    public function getStatusAttribute(): ProductStatusEnum
    {
        if ($this->stock <= 0) {
            return ProductStatusEnum::SOLD_OUT;
        }

        if ($this->stock < 10) {
            return ProductStatusEnum::LOW_STOCK;
        }

        return ProductStatusEnum::IN_STOCK;
    }

}
