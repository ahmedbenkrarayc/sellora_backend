<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SubscriptionHistory extends Model
{
    protected $fillable = [
        'user_id', 
        'status', 
        'message', 
        'recorded_at'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
