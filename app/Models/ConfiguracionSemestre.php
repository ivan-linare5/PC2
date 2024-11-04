<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionSemestre extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_configuracionsemestre'; 
    protected $table = 'configuracion_semestre';

    protected $fillable = [
        'id_configuracionsemestre',
        'fecha_inicio',
        'fecha_final',
        'tipo_semestre',
        'ciclo_escolar',
        'fecha_hora',
    ];

    public function horarios()
    {
        return $this->hasMany(Horario::class, 'id_configuracionsemestre'); 
    }

}
