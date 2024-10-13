<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesor extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'profesor';

    // Desactivar el uso de timestamps
    public $timestamps = false;

    // Define los atributos que se pueden llenar
    protected $fillable = [
        'RPE_Profesor',
        'nombre_profesor',
        'primer_apellido',
        'segundo_apellido',
        'correo_institucional',
        'telefono_emergencia',
        'grado_maximo',
        'Activo'
    ];
}
