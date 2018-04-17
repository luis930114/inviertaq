<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroEmpresa extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'registroempresa';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'reem_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reem_nit',
        'reem_nombre',
        'reem_telefono',
        'reem_direccion',
        'reem_correo',
        'reem_codigo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
