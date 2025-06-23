@extends('layout.plantilla')
@section('contenido')
    <div class="container">
        <h1>Desea eliminar registro ? Codigo : {{ $cliente->idcliente }} - Nombre : {{ $cliente->nomcliente }}
        </h1>
        <form method="POST" action="{{ route('clientes.destroy', $cliente->idcliente) }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fas facheck-square"></i> SI</button>
            <a href="{{ route('cancelar2') }}" class="btn btnprimary"><i class="fas fa-times-circle"></i>
                NO</button></a>
        </form>
    </div>
@endsection
