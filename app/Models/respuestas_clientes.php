<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class respuestas_clientes extends Model
{
    use HasFactory;
    protected $fillable=['idUser','idPregunta','respuesta'];
}
