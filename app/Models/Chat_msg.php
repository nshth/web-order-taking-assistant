<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat_msg extends Model
{
    /** @use HasFactory<\Database\Factories\ChatMsgFactory> */
    use HasFactory;

    protected $guarded = [];

    public function convo()
    {
        return $this->belongsTo(Chat_Convo::class);
    }
}
