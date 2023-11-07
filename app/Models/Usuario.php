<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable  = [
        'numero_di',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'direccion',
        'telefono',
        'correo',
        'contrasena',
        'tipo_di_id',
        'ciudad_id',
        'estado_id',
    ];
}

/*class registro extends Model{

    protected $table = 'usuarios';


    protected $PK = 'id';
}*/


