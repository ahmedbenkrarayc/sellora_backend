<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariantImage extends Model
{
    protected $table = 'productvariantimage';
    protected $fillable = [
        'path',
        'productvariant_id'
    ];
}
