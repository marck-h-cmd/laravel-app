@extends('layout.plantilla')
@section('contenido')
    <div class="container">
        <h1>Desea eliminar registro ? Codigo : {{ $unidad->idunidad }} - Descripcion : {{ $unidad->descripcion }}
        </h1>
        <form method="POST" action="{{ route('unidades.destroy', $unidad->idunidad) }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fas facheck-square"></i> SI</button>
            <a href="{{ route('unidades.cancelar') }}" class="btn btnprimary"><i class="fas fa-times-circle"></i>
                NO</button></a>
        </form>
    </div>
@endsection
