<?php

namespace dioVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    protected	$table='detalle_venta';

    protected $primaryKey='iddetalle_vente';

    public $timestamps=false;

    protected $fillable =[

    	'idventa',
    	'idarticulo',
    	'cantidad',
    	'precio_venta',
    	'descuento'
    	
    	];
}
