<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Chat_msg;

class Chat_Convo extends Model
{
    /** @use HasFactory<\Database\Factories\ChatConvoFactory> */
    use HasFactory;

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function messages()
    {
        return $this->hasMany(Chat_msg::class);
    }
}
