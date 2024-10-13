<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoEmergencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'profesor_id',
        'telefono',
        'descripcion',
    ];

    public function profesor()
    {
        return $this->belongsTo(Profesor::class);
    }
}
