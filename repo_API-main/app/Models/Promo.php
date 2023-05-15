<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Order;

class Promo extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['id', 'name', 'percentage', 'description', 'active_flg', 'published_at', 'del_flg'];

    protected $casts = [
        'id' => 'string',
        'published_at' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'promo_id', 'id');
    }
}
