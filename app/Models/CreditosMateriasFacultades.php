<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditosMateriasFacultades extends Model
{
    use HasFactory;

    protected $table = 'creditos_materias_facultades'; // Nombre de la tabla
    // Indicar que la tabla no tiene timestamps (created_at y updated_at)
    public $timestamps = false;

    // Columnas que se pueden asignar masivamente
    protected $fillable = [
        'clave_materia',
        'clave_facultad',
        'clave_materia_facultad',
        'creditos',
    ];

    // Indicar que no se usará una columna `id` automática
    public $incrementing = false;

    // Indicar el tipo de las claves primarias compuestas
    protected $primaryKey = ['clave_materia', 'clave_facultad'];
    protected $keyType = 'string';

    /**
     * Configuración de relaciones
     */

    // Relación con la tabla de materias
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'clave_materia', 'clave_materia');
    }

    // Relación con la tabla de facultades
    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'clave_facultad', 'clave_facultad');
    }
}
