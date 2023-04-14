<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Order;

class Shipping extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['id', 'name', 'description', 'price', 'del_flg'];

    protected $casts = [
        'id' => 'string'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'shipping_id', 'id');
    }
}
