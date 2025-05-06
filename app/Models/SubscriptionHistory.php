<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionHistory extends Model
{
    protected $fillable = [
        'user_id', 
        'status', 
        'message', 
        'recorded_at'
    ];
}
