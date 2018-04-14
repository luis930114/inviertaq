<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudReserva extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'solicitudreserva';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'telefono',
        'correo',
        'solicitud',
        'fecha_ingreso',
        'fecha_salida',
        'detalles'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
       'solicitud' => 'array',
    ];

    public function setFechaIngresoAttribute($value)
    {
        $this->attributes['fecha_ingreso'] = date('Y-m-d', strtotime($value));
    }

    public function setFechaSalidaAttribute($value)
    {
        $this->attributes['fecha_salida'] = date('Y-m-d', strtotime($value));
    }


}
