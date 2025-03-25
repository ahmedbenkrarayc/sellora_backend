<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;
use App\Models\Payment;
use App\Models\Customer;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'status',
        'country',
        'city',
        'address',
        'postalcode',
        'price',
        'customer_id'
    ];

    public function productvariants(){
        return $this->belongsToMany(ProductVariant::class, 'order_productvariant', 'order_id', 'productvariant_id')
                ->withPivot('quantity');
    }

    public function payment(){
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
