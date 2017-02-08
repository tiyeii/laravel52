<?php

namespace dioVentas\Http\Controllers;

use Illuminate\Http\Request;

use dioVentas\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use dioVentas\Http\Requests\PedidoFormRequest;
use dioVentas\Pedido;
use dioVentas\DetallePedido;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class PedidoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
    	if($request)
    	{
    		$query=trim($request->get('searchText'));
            
    		$pedidos=DB::table('pedido as p')
    		->join ('persona as pe','p.idcliente','=','pe.idpersona')
    		->join ('detalle_pedido as dp','p.idpedido','=','dp.idpedido')
    		->select('p.idpedido','p.fecha_hora','pe.nombre','p.observacion','p.estado')
            ->where('p.estado','=','P')
    		->where('p.observacion','LIKE','%'.$query.'%')
    		->orderBy('p.idpedido','desc')
    		->groupBy('p.idpedido','p.fecha_hora','pe.nombre','p.estado')
    		->paginate(10);
            
    		return view('ventas.pedido.index',["pedidos"=>$pedidos,"searchText"=>$query]);
    	}
    }

   

    public function create(){

    	$personas=DB::table('persona')->where('tipo_persona','=','Cliente')->get();
    	$articulos=DB::table('articulo as art')
    	->join ('detalle_ingreso as di','art.idarticulo','=','di.idarticulo')
    		->select(DB::raw('CONCAT(art.codigo, " ",art.nombre) AS articulo'),'art.idarticulo','art.stock',DB::raw('AVG(di.precio_venta) AS precio_promedio'))
    		->where('art.estado','=','Activo')
    		->where('art.stock','>','0')
    		->groupBy('articulo','art.idarticulo','art.stock')
    		->get();
    		return view('ventas.pedido.create',["personas"=>$personas,"articulos"=>$articulos]);


    }

    public function store(PedidoFormRequest $request)
    {
    	//transacion por si hay algun error
    	try{
    		DB::beginTransaction();
    		$pedido=new Pedido;
    		$pedido->idcliente=$request->get('idcliente');
    		$mytime = Carbon::now('America/Tijuana');
    		$pedido->fecha_hora=$mytime->toDateTimeString();
    		$pedido->observacion=$request->get('observacion');
    		$pedido->estado='P';
    		$pedido->save();
    		//array de detalles
    		$idarticulo = $request->get('idarticulo');
    		$cantidad = $request->get('cantidad');
    		$precio_venta = $request->get('precio_venta');

            $cont = 0;

    		while($cont < count($idarticulo)){
    			$detalle = new DetallePedido();
    			$detalle->idpedido=$pedido->idpedido;
    			$detalle->idarticulo=$idarticulo[$cont];
    			$detalle->cantidad=$cantidad[$cont];
    			$detalle->precio_venta=$precio_venta[$cont];
    			$detalle->save();
    			$cont=$cont+1;
    		}
    		DB::commit();

    	}catch(\Exception $e)
    	{
    		DB::rollback();
    	}

    	return Redirect::to('ventas/pedido');
	}

	public function show($id)
	{
		$pedido=DB::table('pedido as p')
    		->join ('persona as pe','p.idcliente','=','pe.idpersona')
    		->join ('detalle_pedido as dp','p.idpedido','=','dp.idpedido')
    		->select('p.idpedido','p.fecha_hora','pe.nombre','p.observacion')
    		->where('p.idpedido','=',$id)
    		->first();
// se unen tablas
    	$detalles=DB::table('detalle_pedido as d')
    		->join('articulo as a','d.idarticulo','=','a.idarticulo')
    		->select('a.nombre as articulo','d.cantidad','d.precio_venta')
    		->where('d.idpedido','=',$id)
    		->get();
    	return view('ventas.pedido.show',["pedido"=>$pedido,"detalles"=>$detalles]);

	}

	public function destroy($id)
	{
		$pedido=Pedido::findOrFail($id);
        $pedido->estado='T';
        $pedido->update();
        return Redirect::to('ventas/pedido');
	}
}
