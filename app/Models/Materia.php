<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $table = 'materia';

    protected $fillable = [
        'clave_materia',
        'nombre_materia',
        'lleva_laboratorio',
        'clave_ingenieria',
        'creditos_ingenieria',
        'clave_quimica',
        'creditos_quimica',
    ];
}
