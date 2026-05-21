<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

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
        'price' => 'decimal:2',
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

    // Un producto solo se relaciona con un item del carrito
    public function cartItem(){
        return $this->belongsTo(CartItem::class);
    }

    //Esto falta crear los modelos aun
    public function orderItem(){
        
    }
    public function getFinalPriceAttribute()
    {
        if ($this->on_sale) {
            return $this->price - ($this->price * $this->discount / 100);
        }

        return $this->price;
    }
}
