<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $fillable = [
        'name',
        'active',
    ];

    //una marca puede tener muchos productos
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
