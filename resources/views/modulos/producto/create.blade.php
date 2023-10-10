@extends('plantilla')

@section('title','producto')

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
            <h1>Modulo de Producto</h1>
        </div>
    </div>

    <form action="{{route('producto.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header text-left">
                <h4>Creacion de producto</h4>
            </div>
            <div class="card-body col-md-12 row">
                <div class="form-group col-md-4">
                    <label for="valor">Nombre:</label>
                    <input type="text" class="form-control" id="pro_nombre" name="pro_nombre" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="valor">Descripcion:</label>
                    <input type="text" class="form-control" id="pro_descripcion" name="pro_descripcion" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="valor">Precio:</label>
                    <input type="number" class="form-control" id="pro_precios" name="pro_precios" required>
                </div>
            </div>

            <div class="card-footer row">
                <div class="col-md-4"> </div>
                <div class="col-md-2"> 
                    <button type="submit" class="btn btn-primary">Nuevo registro</button>
                </div>
                <div class="col-md-2">
                    <a href="{{route('producto.index')}}" class="btn btn-primary">regresar</a>                    
                </div>
            </div>
        </div>
    </form>
@endsection