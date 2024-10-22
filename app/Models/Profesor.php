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

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'RPE_Profesor';

     // Si tu clave primaria no es autoincrementable, desactiva el auto incremento
     public $incrementing = false;
     

    // Define los atributos que se pueden llenar
    protected $fillable = [
        'RPE_Profesor',
        'nombre_profesor',
        'primer_apellido',
        'segundo_apellido',
        'correo_institucional',
        'telefono_personal',
        'grado_maximo',
        'Activo'
    ];

    public function telefonosEmergencia()
    {
        // Relación uno a muchos (un profesor puede tener varios teléfonos de emergencia)
        return $this->hasMany(TelefonoEmergencia::class, 'RPE', 'RPE_Profesor');
    }
}
