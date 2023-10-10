@extends('plantilla')

@section('title','Pedidos')

@section('content')

<script >
    const getMaterial = function (producto) {
        
        var prodGeneral = JSON.parse(document.getElementById('consultaProd').innerText);
    
        var precio =0;

        let claves = Object.keys(prodGeneral);
        for(let i=0; i< claves.length; i++){
            let clave = claves[i];
            let element = prodGeneral[clave];       
            if (element.pro_codigo==producto) {
                precio =  parseFloat(element.pro_precio);
                
            }
        }
    
        document.getElementById('ped_precio').value=precio;
        document.getElementById('ped_cantidad').disabled=false;

    }

    function agregaProducto(){

        var ped_precio = document.getElementById('ped_precio');
        var ped_cantidad = document.getElementById('ped_cantidad');
        var ped_cliente = document.getElementById('ped_cliente');
        var ped_producto = document.getElementById('ped_producto');
    
        if (ped_precio.value=="") {
            alert('El precio es obligatorio');
            return;
        }
        if (ped_cantidad.value=="") {
            alert('la cantidad es obligatorio');
            return;
        }
        if (ped_cliente.value=="") {
            alert('el cliente es obligatorio');
            return;
        }

        if (ped_producto.value=="") {
            alert('el producto es obligatorio');
            return;
        }

        var contador = document.getElementById('ped_contador');
        var vlrTotal = document.getElementById('ped_total');
        let conta =parseInt(contador.value);
        let tabla="";
        var entro =false;

        for (let i = 0; i <=conta ; i++) {
            
            if (conta>0) {
                console.log('i',i);
                if (document.getElementById(`pro_codigo_${i}`)) {                
                    if (document.getElementById(`pro_codigo_${i}`).value ===ped_producto.value ) {                
                        entro =true;
                        ped_producto.value="";
                        ped_cantidad.value="";
                        ped_precio.value="";
                    }
                }                  
                
            }

        }

        if (entro) {        
            alert(`El material que intentas agregar, ya esta agregado`);
            return ;
        }

        if (!entro) {     
            var prodGeneral = JSON.parse(document.getElementById('consultaProd').innerText);   
            var pro_nombre ="";
            let claves = Object.keys(prodGeneral);
            for(let i=0; i< claves.length; i++){
                let clave = claves[i];
                let element = prodGeneral[clave];       
                if (element.pro_codigo==ped_producto.value) {
                    pro_nombre =  element.pro_nombre;
                    
                }
            }

            let vlr_total=ped_precio.value * ped_cantidad.value;
            tabla+=`<tr><td>${pro_nombre} <input type="hidden" name="pro_codigo_${conta+1}" id="pro_codigo_${conta+1}" value="${ped_producto.value}"></td>`;
            tabla+=`<td>${ped_cantidad.value} <input type="hidden" name="pro_cantidad_${conta+1}" id="pro_cantidad_${conta+1}" value="${ped_cantidad.value}"></td>`;
            tabla+=`<td>${ped_precio.value} <input type="hidden" name="pro_precio_${conta+1}" id="pro_precio_${conta+1}" value="${ped_precio.value}"></td>`;
            tabla+=`<td>${vlr_total.toFixed(2)} <input type="hidden" name="pro_total_${conta+1}" id="pro_total_${conta+1}" value="${vlr_total.toFixed(2)}"></td></tr>`;
            $( "#body_pedidos" ).append(tabla);
            contador.value= parseInt(contador.value)+1;
            vlrTotal.value= parseInt(vlrTotal.value)+vlr_total;
        }


        ped_producto.value="";
        ped_cantidad.value="";
        ped_precio.value="";
    }

    function validatabla(){
        const form =document.querySelector('#form'); 
        form.addEventListener('submit',(e)=>{
            e.preventDefault();
        });

        var contador = document.getElementById('ped_contador').value;
        if (document.getElementById('ped_cliente').value=="") {
            alert('El cliente no esta seleccionado');
            return;
        }
        if (contador==0) {
            alert('No hay materiales registrados en el pedido');
            return;
        }

        form.submit();
    }


</script>

    @if (session('status') !="")        
        <div class="alert alert-success" role="alert">
            {{session('status')}}
        </div>
    @endif

    <div class="col-md-12 row">
            <div class="col-md-4">
            </div>
        <div class="col-md-4 text-center">
            <h1>Modulo de Pedidos</h1>
        </div>
    </div>

    <form action="{{route('pedido.store')}}" method="POST" id="form">
        @csrf
        <div class="card">
            <div class="card-header text-left">
                <h4>Asignacion de Pedido</h4>
            </div>
            <div class="card-body col-md-12 row">
                <div class="form-group col-md-4">
                    <label for="valor">Producto:</label>                   
                    <select name="ped_producto" id="ped_producto" class="form-control"  onchange="getMaterial(this.value);" >
                        <option value="">-</option> 
                        @foreach ($productos as $pro)                            
                            <option value="{{$pro['pro_codigo']}}">{{$pro['pro_nombre']}}</option>
                        @endforeach
                    </select>     
                    <textarea style="display: none;" id="consultaProd" cols="30" rows="10">{{$productos}}</textarea>               
                </div>

                <div class="form-group col-md-4">
                    <label for="valor">Cliente:</label>
                    <select name="ped_cliente" id="ped_cliente" class="form-control" >
                        <option value="">-</option> 
                        @foreach ($clientes as $cli)                            
                            <option value="{{$cli['cli_codigo']}}">{{$cli['cli_nombre']}}</option> 
                        @endforeach
                    </select>                  
                </div>  
                <div class="form-group col-md-4">
                    <label for="valor">Cantidad:</label>
                   <input type="text" disabled name="ped_cantidad" id="ped_cantidad" class="form-control" value="" >               
                </div>
                <div class="form-group col-md-4">
                    <label for="valor">Precio:</label>
                   <input type="text" readonly name="ped_precio" id="ped_precio" class="form-control" value="" >               
                </div>                
            </div>

            <div class="card-footer row">    
                <div class="col-md-4"></div>            
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary" onclick="validatabla();">Crear registro</button>               
                    <button type="button" class="btn btn-primary" onclick="agregaProducto();">Agregar producto</button>               
                    <a href="{{route('pedido.index')}}" class="btn btn-primary">regresar</a>                 
                </div>            
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>productos agregados</h4>
            </div>

            <input type="hidden"  name="ped_contador" id="ped_contador" value="0">
            <input type="hidden"  name="ped_total" id="ped_total" value="0">

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>cantidad</th>
                            <th>valor unitario</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="body_pedidos">
                        
                    </tbody>
                    {{-- <tfoot>
                        <tr>
                            <td>Total</td>
                            <td>$180</td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </form>
@endsection