<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Honorarios_presupuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'presupuesto_id',
        'valor_id',
        'tipo',
        'cantidad',
        'precio',
        'total',
        'user_id'
    ];

    public function valores()
    {
        return $this->belongsTo(Valores::class, 'valor_id');
    }
}
