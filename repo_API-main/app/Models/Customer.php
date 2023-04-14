<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Cart_Item;
use App\Models\Shipping_address;
use App\Models\Order;

class Customer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['id', 'full_name', 'nick_name', 'dob', 'email', 'password', 'phone', 'gender', 'avatar', 'pin', 'del_flg'];

    protected $casts = [
        'id' => 'string'
    ];

    public function cart_items(): HasMany
    {
    	return $this->hasMany(Cart_Item::class, 'customer_id', 'id');
    }

    public function orders(): HasMany
    {
    	return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function shipping_address(): HasMany
    {
    	return $this->hasMany(Shipping_address::class, 'customer_id', 'id');
    }
}
