<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Cart_Item;
use App\Models\Shipping_address;
use App\Models\Order;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $guard = 'api-customer';

    
    protected $fillable = ['id', 'full_name', 'nick_name', 'dob', 'email', 'password', 'phone', 'gender', 'avatar', 'pin', 'del_flg'];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime:Y-m-d'
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
