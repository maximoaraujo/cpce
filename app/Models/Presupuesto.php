<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'presupuesto_id',
        'fecha',
        'codigo_cliente',
        'matriculado_id',
    ];

    public function clientes()
    {
        return $this->belongsTo(Cliente::class, 'codigo_cliente', 'codigo');
    }
    
    public function matriculados()
    {
        return $this->belongsTo(Matriculado::class, 'matriculado_id');
    }
}
