@extends('layout.plantilla')
@section('contenido')
    <div class="container">
        <h1>Desea eliminar registro ? Codigo : {{ $categoria->idcategoria }} - Descripcion : {{ $categoria->descripcion }}
        </h1>
        <form method="POST" action="{{ route('categorias.destroy', $categoria->idcategoria) }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fas facheck-square"></i> SI</button>
            <a href="{{ route('categorias.cancelar') }}" class="btn btnprimary"><i class="fas fa-times-circle"></i>
                NO</button></a>
        </form>
    </div>
@endsection
