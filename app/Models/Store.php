<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'store';
    protected $fillable = [
        'name',
        'subdomain',
        'domain',
        'logo',
        'description',
        'type',
        'status',
        'storeowner_id'
    ];
}
