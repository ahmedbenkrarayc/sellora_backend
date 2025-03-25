<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class payment extends Model
{
    protected $table = 'payment';
    protected $fillable = [
        'method',
        'order_id'
    ];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
}
