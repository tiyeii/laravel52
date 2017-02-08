<?php

namespace dioVentas;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
     protected	$table='pedido';

    protected $primaryKey='idpedido';

    public $timestamps=false;

    protected $fillable =[

    	'idcliente',
    	'fecha_hora',
    	'observacion',
    	'estado'
    	];
}
