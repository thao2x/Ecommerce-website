<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Variant;
use App\Models\Order;

class Order_Item extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'order_items';

    protected $fillable = ['id', 'variant_id', 'order_id', 'quantity'];

    protected $casts = [
        'id' => 'string'
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
