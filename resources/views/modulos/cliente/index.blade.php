@extends('plantilla')

@section('title','Cliente')

@section('content')

    <div class="col-md-12 row">
            <div class="col-md-4">
            </div>
        <div class="col-md-4 text-center">
            <h1>Modulo de Clientes</h1>
        </div>
    </div>
    
    <form action="{{route('cliente.index')}}" method="GET">
        @csrf
        <div class="card">
            <div class="card-footer row">
                <div class="col-md-2">                     
                    <a href="{{route('cliente.create')}}" class="btn btn-primary">Creacion</a>
                </div>
            </div>
        </div>
    </form>

    <div class="card card-primary">
        <div class="card-body">
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Correo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $clientes as $cli)
                        <tr>
                            
                            <td>{{$cli['cli_codigo']}}</td>
                            <td>{{$cli['cli_nombre']}}</td>
                            <td>{{$cli['cli_direccion']}}</td>
                            <td>{{$cli['cli_correo']}}</td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>

        
    </div>
@endsection