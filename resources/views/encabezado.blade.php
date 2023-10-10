
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Celuweb</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{route('home.index')}}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('producto.index')}}">Producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('cliente.index')}}">Cliente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('pedido.index')}}">Pedido</a>
                </li>
            
            </ul>
        </div>
    </div>
</nav>
    