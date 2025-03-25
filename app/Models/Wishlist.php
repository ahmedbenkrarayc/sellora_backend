<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductVariant;
use App\Models\Customer;

class Wishlist extends Model
{
    protected $table = 'wishlist';
    protected $fillable = [
        'customer_id',
        'productvariant_id'
    ];

    public function productvariant(){
        return $this->belongsTo(ProductVariant::class, 'productvariant_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
