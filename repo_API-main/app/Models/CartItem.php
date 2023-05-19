<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Variant;
use App\Models\Customer;

class CartItem extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'cart_items';

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime:Y-m-d'
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
