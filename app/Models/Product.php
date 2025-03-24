<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Subcategory;
use App\Models\Color;
use App\Models\Size;
use App\Models\ProductDetails;
use App\Models\ProductVariant;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'title',
        'description',
        'baseprice',
        'subcategory_id'
    ];

    public function subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function colors(){
        return $this->hasMany(Color::class, 'product_id');
    }

    public function sizes(){
        return $this->hasMany(Size::class, 'product_id');
    }

    public function productdetails(){
        return $this->hasMany(ProductDetails::class, 'product_id');
    }

    public function productvariants(){
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
}
