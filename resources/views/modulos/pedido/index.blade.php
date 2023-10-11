@extends('plantilla')

@section('title','Pedidos')

@section('content')

    <script>
        function getDetalle(ped_codigo) {
          
            console.log('codigo',ped_codigo);
            
            var detPedido =document.getElementById('detPed').innerTxt;
            var detPedido = JSON.parse(document.getElementById('detPed').innerText);   
            
            $("#body_detalle").empty();
            let claves = Object.keys(detPedido);
            for(let i=0; i< claves.length; i++){
                let clave = claves[i];
                
                let element = detPedido[clave];    
                
                if (element.ped_codigo===ped_codigo) {
                    var tabla ="";
                    tabla+=`<tr><td>${element.ped_codigo}</td>`;
                    tabla+=`<td>${element.producto}</td>`;
                    tabla+=`<td>${element.ped_cantidad}</td>`;
                    tabla+=`<td>${element.ped_vlruni}</td></tr>`;
                    pro_nombre =  element.pro_nombre;
                    $( "#body_detalle" ).append(tabla);
                  
                }
                
            }
                       

        }
    </script>

        
    <textarea style="display: none;" id="detPed" cols="30" rows="10">{{$detPedido}}</textarea>     

    <div class="col-md-12 row">
            <div class="col-md-4">
            </div>
        <div class="col-md-4 text-center">
            <h1>Modulo de Pedidos</h1>
        </div>
    </div>
    
    <form action="{{route('pedido.index')}}" method="GET">
        @csrf
        <div class="card">
            <div class="card-footer ">                                   
                <a href="{{route('pedido.create')}}" class="btn btn-primary">Creacion</a>            
            </div>
        </div>
    </form>

    <div class="card card-primary">
        <div class="card-body">
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Pedido</th>
                        <th>Cliente</th>
                        <th>Descuento</th>
                        <th>Valor total</th>
                        <th>Fecha</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $pedidos as $ped)
                        <tr>                            
                            <td>{{$ped->ped_codigo}}</td>
                            <td>{{$ped->ped_cliente}}</td>
                            <td>{{$ped->ped_descuento}}%</td>
                            <td>{{$ped->ped_vlrtotal}}</td>
                            <td>{{$ped->ped_fecha}}</td>
                            <td>
                                <button type="button" id="btnDetalle" onclick="getDetalle({{$ped->ped_codigo}})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" >Detalle</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
        
        
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalle del pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Valor unitario</th>
                            </tr>
                        </thead>
                        <tbody id="body_detalle">                            
                        </tbody>
                    
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    
@endsection