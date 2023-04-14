<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    protected $fillable = [
        'id',
        'full_name',
        'dob',
        'email',
        'password',
        'avatar',
        'del_flg'
    ];

    protected $casts = [
        'id' => 'string'
    ];

    public function products(): HasMany
    {
    	return $this->hasMany(Product::class, 'user_id', 'id');
    }
}
