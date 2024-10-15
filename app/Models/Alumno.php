<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    // Specify the name of the table
    protected $table = 'alumno';

    // Disable timestamps
    public $timestamps = false;

    // Define the fillable attributes
    protected $fillable = [
        'no_registro',
        'clave_unica',
        'nombre_alumno',
        'apellido_paterno',
        'apellido_materno',
        'correo',
        'clave_carrera',
        'telefono',
        'fecha_ingreso',
    ];
}
