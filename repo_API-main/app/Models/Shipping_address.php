<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Customer;
use App\Models\Order;

class Shipping_address extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'shipping_addresses';

    protected $fillable = ['id', 'customer_id', 'name', 'details', 'default_flg', 'del_flg'];

    protected $casts = [
        'id' => 'string'
    ];

    public function customers(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'shiping_address_id', 'id');
    }
}
