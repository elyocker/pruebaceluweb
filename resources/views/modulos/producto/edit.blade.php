@extends('plantilla')

@section('title','producto')

@section('content')

    @if (session('status') !="")        
        <div class="alert alert-success" role="alert">
            {{session('status')}}
        </div>
    @endif

    <script>
        function valiDatos(){
            const form =document.querySelector('#form'); 
            form.addEventListener('submit',(e)=>{
                e.preventDefault();
            });

            var precios = parseInt(document.getElementById('pro_precios').value);

            let descuento = (precios-((precios *10 )/100));
            let promocion = (precios-((precios *15 )/100));
            
            if (descuento<5000 || promocion<5000) {
                alert('El precio del material es menor 5000 por favor inserte otro precio');
                return;
            }
           
            form.submit();
        }
    </script>

    <div class="col-md-12 row">
            <div class="col-md-4">
            </div>
        <div class="col-md-4 text-center">
            <h1>Modulo de Producto</h1>
        </div>
    </div>

    <form action="{{route('producto.update',$producto[0]->pro_codigo)}}" method="POST" id="form">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-header text-left">
                <h4>Editar de producto</h4>
            </div>
            <div class="card-body col-md-12 row">
                <div class="form-group col-md-4">
                    <label for="valor">Nombre:</label>
                    <input type="text" class="form-control" id="pro_nombre" name="pro_nombre" value="{{$producto[0]->pro_nombre}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="valor">Descripcion:</label>
                    <input type="text" class="form-control" id="pro_descripcion" name="pro_descripcion" value="{{$producto[0]->pro_descripcion}}">
                </div>
                <div class="form-group col-md-4">
                    <label for="valor">Precio:</label>
                    <input type="number" class="form-control" id="pro_precios" name="pro_precios" value="{{$producto[0]->pro_precio}}">
                </div>
            </div>

            <div class="card-footer row">
                <div class="col-md-4"> </div>
                <div class="col-md-4"> 
                    <button type="submit" class="btn btn-success" onclick="valiDatos();">Editar</button>                
                    <a href="{{route('producto.index')}}" class="btn btn-primary" >regresar</a>                    
                </div>
                
            </div>
        </div>
    </form>
@endsection