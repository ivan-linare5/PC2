<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_inscripcion';
    protected $table = 'inscripcion';

    protected $fillable = [
        'id_inscripcion',
        'clave_unica',
        'fecha_hora',
        'estado',
        'clave_horario',
        'fecha_alta',
        'fecha_baja',
        'RPE_bajaM',
        'RPE_altaM',
    ];


    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'inscripcion', 'id_inscripcion', 'clave_Unica'); 
    }

     
    public function horarios()
    {
        return $this->belongsTo(Horario::class, 'clave_horario', 'clave_horario'); 
    }

    public function calificacion()
        {
    return $this->hasMany(Calificacion::class, 'id_inscripcion', 'id_inscripcion');
    }

    
}
