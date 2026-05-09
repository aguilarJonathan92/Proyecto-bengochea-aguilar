<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    protected $table = 'brands'; // esto es tabla de marcas

    protected $fillable = [
        'name',
        'activo',
    ];

    //una categoria puede tener muchos productos
    public function productos(): HasMany{
        return $this->hasMany(Product::class, 'brand_id');
    }
}
