<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre', 
        'cuit',
        'direccion', 
        'localidad',
        'telefono',
        'email',
        'latitud',
        'longitud',
        'zona',
        'estado',
        'id_matriculado', 
        'condicion_iva', 
    ];
}
