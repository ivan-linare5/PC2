<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    // Definir la tabla que utiliza este modelo
    protected $table = 'horarios';

    // Definir la clave primaria, si no es 'id' por defecto
    protected $primaryKey = 'clave_horario';

    // Indicar que la tabla no tiene timestamps (created_at y updated_at)
    public $timestamps = false;

    // Especificar los atributos que se pueden asignar masivamente
    protected $fillable = [
        'clave_materia',
        'fecha_registro',
        'id_configuracionsemestre',
        'ID_salon',
        'jue_Fin',
        'jue_Ini',
        'lun_Fin',
        'lun_Ini',
        'mar_Fin',
        'mar_Ini',
        'mie_Fin',
        'mie_Ini',
        'numero_grupo',
        'RPE_profesor',
        'RPE_registro',
        'sab_Fin',
        'sab_Ini',
        'tipo_materia',
        'vie_Fin',
        'vie_Ini',
    ];

   
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'clave_materia', 'clave_materia');
    }
    // Relación con el modelo Profesor
    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'RPE_profesor');
    }

    // Relación con el modelo Salon
    public function salon()
    {
        return $this->belongsTo(Salon::class, 'ID_salon', 'id_salon');
    }

    // Relación con el modelo HorarioCupo (si lo necesitas)
    public function horarioCupo()
    {
        return $this->hasMany(HorarioCupo::class, 'clave_horario', 'clave_horario');
    }

    public function configuracion()
    {
        return $this->belongsTo(ConfiguracionSemestre::class, 'id_configuracionsemestre'); 
    }

    public function inscripcion()
    {
    return $this->hasMany(Inscripcion::class, 'clave_horario', 'clave_horario'); 
    
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'inscripcion', 'clave_horario', 'clave_Unica'); 
    }


}
