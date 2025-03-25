<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ProductVariant;

class Color extends Model
{
    protected $table = 'color';
    protected $fillable = [
        'name',
        'product_id'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productvariants(){
        return $this->hasMany(ProductVariant::class, 'color_id');
    }
}
