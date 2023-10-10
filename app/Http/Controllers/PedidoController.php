<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\detallepedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::all();
        $detPedido = detallepedido::all();
        return view("modulos.pedido.index",compact('pedidos','detPedido'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos =Producto::all();
        $clientes =Cliente::all();       
        return view("modulos.pedido.create",compact('productos','clientes'));
    }

    /* public function get()
    {
        $productos =Producto::all();
        $clientes =Cliente::all();
        return view("modulos.pedido.create",compact('productos','clientes'));
    } */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pedidos =$request->all();
        $pedidos =$request->except('_token');
        
        $ped = New Pedido();
        $ped->ped_cliente = $pedidos['ped_cliente'];
        $ped->ped_vlrtotal =  $pedidos['ped_total'];
        $ped->ped_fecha = date('Y-m-d');
        $ped->save();

        $numeroPedido= Pedido::select('ped_codigo')->orderBy('ped_codigo', 'desc')->first();
        $valor_total=0;
        $det_ped=array();
        for ($i=1; $i <= $pedidos['ped_contador']; $i++) { 
            $det_ped['ped_codigo']=$numeroPedido->ped_codigo;
            $det_ped['id_producto'] = $pedidos['pro_codigo_'.$i];
            $det_ped['ped_cantidad'] = $pedidos['pro_cantidad_'.$i];
            $det_ped['ped_vlruni'] = $pedidos['pro_precio_'.$i];
            $det_ped['ped_fechac'] = date('Y-m-d');
            detallepedido::insert($det_ped);
        }

        session()->flash('status','Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
