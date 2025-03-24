<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductDetails extends Model
{
    protected $table = 'productdetails';
    protected $fillable = [
        'key', 
        'value',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
