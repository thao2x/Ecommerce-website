<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Cart_Item;
use App\Models\ShippingAddress;
use App\Models\Order;

class Customer extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasUuids;

    protected $guard = 'api-customer';

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime:Y-m-d'
    ];

    public function cartItems(): HasMany
    {
        return $this->hasMany(Cart_Item::class, 'customer_id', 'id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function shippingAddress(): HasMany
    {
        return $this->hasMany(ShippingAddress::class, 'customer_id', 'id');
    }
}
