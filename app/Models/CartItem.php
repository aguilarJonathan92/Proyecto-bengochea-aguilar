<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_item',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    public function cart(){
        return $this->hasMany(Cart::class);
    }
}
