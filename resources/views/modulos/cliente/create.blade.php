@extends('plantilla')

@section('title','clientes')

@section('content')

    @if (session('status') !="")        
        <div class="alert alert-success" role="alert">
            {{session('status')}}
        </div>
    @endif

    <div class="col-md-12 row">
            <div class="col-md-4">
            </div>
        <div class="col-md-4 text-center">
            <h1>Modulo de Clientes</h1>
        </div>
    </div>

    <form action="{{route('cliente.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header text-left">
                <h4>Creacion de Cliente</h4>
            </div>
            <div class="card-body col-md-12 row">
                <div class="form-group col-md-4">
                    <label for="valor">Nombre:</label>
                    <input type="text" class="form-control" id="cli_nombre" name="cli_nombre" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="valor">Direccion:</label>
                    <input type="text" class="form-control" id="cli_direccion" name="cli_direccion" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="valor">Correo:</label>
                    <input type="email" class="form-control" id="cli_correo" name="cli_correo" required >
                </div>                
            </div>

            <div class="card-footer row">
                <div class="col-md-4"> </div>
                <div class="col-md-2"> 
                    <button type="submit" class="btn btn-primary">Nuevo registro</button>
                </div>
                <div class="col-md-2">
                    <a href="{{route('cliente.index')}}" class="btn btn-primary">regresar</a>                    
                </div>
            </div>
        </div>
    </form>
@endsection