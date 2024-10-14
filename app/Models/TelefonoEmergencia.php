<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoEmergencia extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'telefonos_emergencia';

    // Desactivar el uso de timestamps
    public $timestamps = false;

    protected $fillable = [
        'RPE',        
        'descripcion',
        'numero',
    ];

    public function profesor()
    {
        // Especifica la relación con la clave foránea y la clave primaria
        return $this->belongsTo(Profesor::class, 'RPE', 'RPE_Profesor');
    }
}
