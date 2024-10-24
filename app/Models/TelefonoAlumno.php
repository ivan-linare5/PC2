<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoAlumno extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'telefonos_alumnos';

    // Especificar la clave primaria personalizada
    protected $primaryKey = 'id_Tel_Al';

    // Desactivar el uso de timestamps
    public $timestamps = false;

    protected $fillable = [
        'clave_unica',        
        'descripcion',
        'telefono',
    ];

    public function alumno()
    {
        // Especifica la relación con la clave foránea y la clave primaria
        return $this->belongsTo(Alumno::class, 'clave_unica', 'clave_Unica');
    }
}
