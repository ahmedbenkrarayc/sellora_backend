<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductVariantImage;
use App\Models\Wishlist;
use App\Models\Order;

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

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color(){
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function size(){
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function images(){
        return $this->hasMany(ProductVariantImage::class, 'productvariant_id');
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class, 'productvariant_id');
    }

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_productvariant', 'productvariant_id', 'order_id')
                ->withPivot('quantity');
    }
}
