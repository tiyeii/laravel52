<?php

namespace dioVentas\Http\Controllers;

use dioVentas\Http\Requests;
use Illuminate\Http\Request;
use dioVentas\Venta;
use DB;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request)
        {
            
            $compras=DB::table('detalle_ingreso')->select(DB::raw('SUM(cantidad*precio_compra) AS totales'))
            ->first();
            $ventas=DB::table('venta')->select(DB::raw('SUM(total_venta) AS totales'))
            ->first();
            return view('home',["ventas"=>$ventas,"compras"=>$compras]);
        }
        
    }
}
