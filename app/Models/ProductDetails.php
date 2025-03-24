<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $table = 'productdetails';
    protected $fillable = [
        'key', 
        'value',
        'product_id'
    ];
}
