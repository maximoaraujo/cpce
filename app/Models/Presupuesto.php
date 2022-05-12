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
        'cliente',
        'matriculado_id',
        'observaciones'
    ];

    public function matriculados()
    {
        return $this->belongsTo(Matriculado::class, 'matriculado_id');
    }
}
