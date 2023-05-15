<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Customer;
use App\Models\Order_Item;
use App\Models\Shipment;
use App\Models\Shipping_address;
use App\Models\Shipping;
use App\Models\Promo;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['id', 'customer_id', 'shiping_address_id', 'shipping_id', 'promo_id', 'code', 'status', 'del_flg'];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime:Y-m-d'
    ];

    public function order_items(): HasMany
    {
    	return $this->hasMany(Order_Item::class, 'order_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function shipping_address(): BelongsTo
    {
        return $this->belongsTo(Shipping_address::class, 'shiping_address_id', 'id');
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class, 'shipping_id', 'id');
    }

    public function promo(): BelongsTo
    {
        return $this->belongsTo(Promo::class, 'promo_id', 'id');
    }
}
