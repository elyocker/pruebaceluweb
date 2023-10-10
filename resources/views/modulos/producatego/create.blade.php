@extends('plantilla')

@section('title','categoria')

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
            <h1>Modulo de Asignacion de categoria</h1>
        </div>
    </div>

    <form action="{{route('producatego.store')}}" method="POST">
        @csrf
        <div class="card">
            <div class="card-header text-left">
                <h4>Asignacion de categoria</h4>
            </div>
            <div class="card-body col-md-12 row">

                <div class="form-group col-md-4">
                    <label for="valor">Producto:</label>                   
                    <select name="prod_producto" id="prod_producto" class="form-control" required>
                        <option value="">-</option> 
                        @foreach ($productos as $pro)                            
                            <option value="{{$pro['pro_codigo']}}">{{$pro['pro_nombre']}}</option> 
                        @endforeach
                    </select>                    
                </div>

                <div class="form-group col-md-4">
                    <label for="valor">Categoria:</label>
                    <select name="prod_categoria" id="prod_categoria" class="form-control" required>
                        <option value="">-</option> 
                        @foreach ($categorias as $cat)                            
                            <option value="{{$cat['cat_codigo']}}">{{$cat['cat_nombre']}}</option> 
                        @endforeach
                    </select>                  
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