<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Store;
use App\Models\Wishlist;
use App\Models\Order;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'store_id'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id');
    }

    public function store(){
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class, 'customer_id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'customer_id');
    }
}
