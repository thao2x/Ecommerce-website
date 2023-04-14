<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Variant;
use App\Models\Customer;

class Cart_Item extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'cart_items';

    protected $fillable = ['id', 'customer_id', 'variant_id', 'quantity'];

    protected $casts = [
        'id' => 'string'
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
