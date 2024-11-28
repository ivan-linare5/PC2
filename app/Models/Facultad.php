<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    use HasFactory;

    protected $table = 'facultad';
    public $timestamps = false;
    protected $primaryKey = 'clave_facultad';
    protected $fillable = ['clave_facultad', 'nombre_facultad'];

}