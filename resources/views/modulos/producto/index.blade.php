@extends('plantilla')

@section('title','producto')

@section('content')

    <div class="col-md-12 row">
            <div class="col-md-4">
            </div>
        <div class="col-md-4 text-center">
            <h1>Modulo de Producto</h1>
        </div>
    </div>
    
    <form action="{{route('producto.index')}}" method="GET">
        @csrf
        <div class="card">
            <div class="card-footer ">                                   
                <a href="{{route('producto.create')}}" class="btn btn-primary">Creacion</a>                
                <a href="{{route('producatego.create')}}" class="btn btn-primary">Asignar categoria</a>
            </div>
        </div>
    </form>

    
    <div class="card card-primary">
        <div class="card-body">
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>producto</th>
                        <th>nombre</th>
                        <th>descripcion</th>
                        <th>precio</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $productos as $mat)
                        <tr>
                            
                            <td>{{$mat['pro_codigo']}}</td>
                            <td>{{$mat['pro_nombre']}}</td>
                            <td>{{$mat['pro_descripcion']}}</td>
                            <td>{{$mat['pro_precio']}}</td>
                            <td><a href="{{route('producto.edit',$mat['pro_codigo'])}}" class="btn btn-warning" id="">Editar</button></td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>
@endsection