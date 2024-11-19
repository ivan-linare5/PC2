<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'materia';
    
     //  clave primaria
     protected $primaryKey = 'clave_materia'; 

    protected $fillable = [
        'clave_materia',
        'nombre_materia',
        'lleva_laboratorio',
        'clave_ingenieria',
        'creditos_ingenieria',
        'clave_quimica',
        'creditos_quimica',
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'RPE_Profesor');
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'grupo_alumno', 'clave_materia', 'clave_Unica');
    }

    public function salon()
    {
        return $this->belongsTo(Salon::class, 'id_salon'); 
    }

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'clave_materia', 'clave_materia');
    }

    public function creditosMateriasFacultade()
    {
        return $this->hasMany(CreditosMateriasFacultades::class, 'clave_materia', 'clave_materia');
    }
    


    
}

