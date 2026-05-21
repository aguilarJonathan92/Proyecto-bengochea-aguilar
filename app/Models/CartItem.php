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

    //Un item de carrito solo se relaciona con un carrito
    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
