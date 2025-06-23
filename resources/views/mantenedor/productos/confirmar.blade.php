@extends('layout.plantilla')
@section('contenido')
    <div class="container">
        <h1>Desea eliminar registro ? Codigo : {{ $producto->idproducto }} - Descripcion : {{ $producto->descripcion }}
        </h1>
        <form method="POST" action="{{ route('productos.destroy', $producto->idproducto) }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fas facheck-square"></i> SI</button>
            <a href="{{ route('cancelar1') }}" class="btn btnprimary"><i class="fas fa-times-circle"></i>
                NO</button></a>
        </form>
    </div>
@endsection
