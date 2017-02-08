<?php

namespace dioVentas;

use Illuminate\Database\Eloquent\Model;

class DetallePedido extends Model
{
    protected	$table='detalle_pedido';

    protected $primaryKey='iddetalle_pedido';

    public $timestamps=false;

    protected $fillable =[

    	'idpedido',
    	'idarticulo',
    	'cantidad',
    	'precio_venta'
    	
    	];
}
