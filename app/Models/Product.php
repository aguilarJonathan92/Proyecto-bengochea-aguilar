<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected static function booted()
    {
        static::addGlobalScope('active', function ($builder) {
            $builder->where('active', true);
        });
    }
    protected $fillable = [
        'category_id',
        'brand_id',
        'title',
        'subtitle',
        'description',
        'stock',
        'price',
        'installments',
        'installment_price',
        'on_sale',
        'discount',
        'active',
        'specs',
        'image_1',
        'image_2',
        'image_3',
    ];
    protected $casts = [
        'specs' => 'array',  // para no hacer json_decode a mano
        'on_sale' => 'boolean',
        'active' => 'boolean',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function getFinalPriceAttribute()
    {
        if ($this->on_sale) {
            return $this->price - ($this->price * $this->discount / 100);
        }

        return $this->price;
    }
}
