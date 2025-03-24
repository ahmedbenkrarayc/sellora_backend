<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Customer;
use App\Models\Category;

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

    public function customers(){
        return $this->hasMany(Customer::class, 'store_id');
    }

    public function storeowner(){
        return $this->belongsTo(User::class, 'storeowner_id');
    }

    public function categories(){
        return $this->hasMany(Category::class, 'store_id');
    }
}
