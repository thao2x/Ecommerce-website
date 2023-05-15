<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Variant;
use App\Models\Image;
use App\Models\Category;
use App\Models\User;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['id', 'category_id', 'user_id', 'name', 'type', 'price', 'description', 'rating', 'del_flg'];

    protected $casts = [
        'id' => 'string',
        'created_at' => 'datetime:Y-m-d'
    ];

    public function variants(): HasMany
    {
    	return $this->hasMany(Variant::class, 'product_id');
    }

    public function images(): HasMany
    {
    	return $this->hasMany(Image::class, 'product_id');
    }

    public function user(): BelongsTo
    {   
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
