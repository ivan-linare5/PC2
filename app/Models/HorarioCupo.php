<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorarioCupo extends Model
{
    use HasFactory;

    // Si la tabla no sigue la convención de pluralización, puedes especificar el nombre de la tabla:
    protected $table = 'horario_cupo';

    // Si la tabla no tiene timestamps, puedes desactivar esto:
    public $timestamps = false;

    // Definir los atributos que se pueden llenar en masa (mass assignable)
    protected $fillable = [
        'clave_facultad',
        'clave_horario',
        'cupo',
    ];

    
}
