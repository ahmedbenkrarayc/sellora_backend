<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductVariant;

class Size extends Model
{
    protected $table = 'size';
    protected $fillable = [
        'name',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productvariants(){
        return $this->hasMany(ProductVariant::class, 'size_id');
    }
}
