<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;

class Variant extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['id', 'product_id', 'size', 'del_flg'];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime:Y-m-d'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function cart_items(): HasMany
    {
    	return $this->hasMany('cart_items', 'variant_id');
    }

    public function order_items(): HasMany
    {
    	return $this->hasMany('order_items', 'variant_id');
    }
}
