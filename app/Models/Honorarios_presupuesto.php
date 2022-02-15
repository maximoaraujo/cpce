<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Honorarios_presupuesto extends Model
{
    use HasFactory;

    protected $fillable = [
        'presupuesto_id',
        'impositivos',
        'laborales',
        'otros',
        'user_id'
    ];
}
