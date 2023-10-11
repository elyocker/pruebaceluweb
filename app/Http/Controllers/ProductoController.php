<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos= Producto::all(); 

        return view('modulos.producto.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("modulos.producto.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $pro = New Producto();
        $pro->pro_nombre = $request->input('pro_nombre');
        $pro->pro_descripcion = $request->input('pro_descripcion');
        $pro->pro_precio = $request->input('pro_precios');
        $pro->save();

        session()->flash('status','Success');
        return redirect()->route('producto.create');
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
        $query = "SELECT 
                    pro_codigo,
                    pro_nombre,
                    pro_descripcion, 
                    pro_precio
                FROM producto 
                where pro_codigo='$id' ";
        $producto= DB::select($query);
       
        return view("modulos.producto.edit",compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $producto)
    {
        $query = "SELECT 
                    pro_nombre,
                    pro_descripcion, 
                    pro_precio
                FROM producto 
                where pro_codigo='$producto' ";
        $resProdu= DB::select($query);

        $pro_nombre= $request->input('pro_nombre');
        $pro_descripcion= $request->input('pro_descripcion');
        
        $pro_precio= $request->input('pro_precios');
        $pro_preciorig= $resProdu[0]->pro_precio;
      
        $up="UPDATE producto SET 
                                pro_nombre='$pro_nombre',
                                pro_descripcion='$pro_descripcion',
                                pro_precio='$pro_precio',
                                pro_preciorig='$pro_preciorig'        
                WHERE pro_codigo='$producto'";
        DB::update($up);        
        
        session()->flash('status','Success');

        return redirect()->route('producto.index');
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
