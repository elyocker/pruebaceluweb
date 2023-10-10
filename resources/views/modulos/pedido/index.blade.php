@extends('plantilla')

@section('title','Pedidos')

@section('content')

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
                        <th>Valor total</th>
                        <th>Fecha</th>
                        <th>Detalle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $pedidos as $ped)
                        <tr>
                            
                            <td>{{$ped['ped_codigo']}}</td>
                            <td>{{$ped['ped_cliente']}}</td>
                            <td>{{$ped['ped_vlrtotal']}}</td>
                            <td>{{$ped['ped_fecha']}}</td>
                            <td><button type="button" class="btn btn-primary">Detalle</button></td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>

        
    </div>
@endsection