<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'productvariant';
    protected $fillable = [
        'name',
        'stock',
        'price',
        'available',
        'product_id',
        'color_id',
        'size_id'
    ];
}
