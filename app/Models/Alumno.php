<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'alumno';

    // Desactivar el uso de timestamps
    public $timestamps = false;

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'clave_Unica';

     // Si tu clave primaria no es autoincrementable, desactiva el auto incremento
     public $incrementing = false;
     

    // Define los atributos que se pueden llenar
    protected $fillable = [
        'clave_Unica',
        'nombre_alumno',
        'primer_apellido',
        'segundo_apellido',
        'correo_institucional',
        'clave_carrera',
        'generacion'
    ];

    public function telefonosAlumno()
    {
        // Relación uno a muchos (un profesor puede tener varios teléfonos de emergencia)
        return $this->hasMany(TelefonoAlumno::class, 'clave_Unica', 'clave_Unica');
    }

   
    public function horarios()
    {
        return $this->belongsToMany(Horario::class, 'inscripcion', 'clave_Unica', 'clave_horario'); 
    }
    
}
