<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\detallepedido;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query ="SELECT 
                    p.ped_codigo,
                    CONCAT(ped_cliente,' - ',c.cli_nombre) AS ped_cliente ,
                    p.ped_vlrtotal,
                    p.ped_fecha
                    
                FROM pedido p
                
                LEFT JOIN cliente c ON (c.cli_codigo=p.ped_cliente) 
                where 1=1";
        $pedidos = DB::select($query);

        $sqlDep=" SELECT 
                    dp.ped_codigo,
                    dp.ped_cantidad,
                    dp.ped_vlruni,        
                    CONCAT(dp.id_producto,' - ',pr.pro_nombre) AS producto
                    FROM detallepedido dp
                    LEFT JOIN producto pr ON (pr.pro_codigo=dp.id_producto)
                    WHERE 1=1 ";
        $detPedido = DB::select($sqlDep);
        $detPedido = json_encode($detPedido);
        
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
