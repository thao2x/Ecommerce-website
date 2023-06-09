<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Variant;
use App\Models\Order;

class OrderItem extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'order_items';

    protected $guarded = [];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime:Y-m-d'
    ];

    public function variant(): BelongsTo
    {
        return $this->belongsTo(Variant::class, 'variant_id', 'id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
