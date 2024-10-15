<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'alumnos';

    // Desactivar el uso de timestamps
    public $timestamps = false;

    // Define los atributos que se pueden llenar
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
        'Activo'
    ];

    // Relación con otros modelos si es necesario
    // public function carrera()
    // {
    //     return $this->belongsTo(Carrera::class, 'clave_carrera', 'clave');
    // }
}
