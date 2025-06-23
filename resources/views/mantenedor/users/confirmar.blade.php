@extends('layout.plantilla')
@section('contenido')
    <div class="container">
        <h1>Desea eliminar registro ? Codigo : {{ $user->id }} - Descripcion : {{ $user->name }}
        </h1>
        <form method="POST" action="{{ route('users.destroy', $user->id) }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger"><i class="fas facheck-square"></i> SI</button>
            <a href="{{ route('users.cancelar') }}" class="btn btnprimary"><i class="fas fa-times-circle"></i>
                NO</button></a>
        </form>
    </div>
@endsection
