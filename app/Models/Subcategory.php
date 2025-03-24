<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Product;

class Subcategory extends Model
{
    protected $table = 'subcategory';
    protected $fillable = [
        'name',
        'status',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function products(){
        return $this->hasMany(Product::class, 'subcategory_id');
    }
}
