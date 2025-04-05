<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Store;
use App\Models\Subcategory;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'name',
        'status',
        'store_id'
    ];
    public $timestamps = false;

    public function store(){
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function subcategories(){
        return $this->hasMany(Subcategory::class, 'category_id');
    }
}
