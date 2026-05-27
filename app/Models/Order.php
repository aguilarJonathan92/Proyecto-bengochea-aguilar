<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'payment_method',
        'status',
        'customer_name',
        'customer_lastname',
        'customer_email',
        'delivery_street',
        'delivery_postal_code',
        'delivery_city_id',
    ];

    // Una orden tiene muchos ítems comprados
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Una orden pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Una orden se envía a una ciudad específica
    public function city()
    {
        return $this->belongsTo(City::class, 'delivery_city_id');
    }
}
