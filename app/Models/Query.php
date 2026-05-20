<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Query extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'asunto',
        'mensaje'
    ];

    /**
     * Accesor para el Asunto: Transforma el número en texto.
     */
    protected function getAsuntoTextoAttribute()
    {
        $tipos = [
            1 => 'Formas de pago',
            2 => 'Modos/costos de envío',
            3 => 'Devolución',
            4 => 'Cuenta',
            5 => 'Otros',
        ];
        return $tipos[$this->asunto] ?? 'No especificado';
    }

    protected $casts = [
        'asunto' => 'integer'
    ];

    /**
     * Accesor para la Fecha: Pasa de UTC a Horario Argentina (ART).
     */
    public function getFechaArgentinaAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])
            ->timezone('America/Argentina/Buenos_Aires')
            ->format('d/m/Y H:i');
    }
}
