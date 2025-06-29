@extends('layout.plantilla')


@section('titulo', 'Listado de Clientes')

@section('contenido')

    <!-- Default box -->
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Listado de Clientes</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>


        </div>
        <div class="card-body">
            <br>
            <a href="{{ route('clientes.create') }}" class="btn btn-primary"><i class="fas faplus"></i> Nuevo Registro</a>
            <nav class="navbar navbar-light float-right">
                <form class="form-inline my-2 my-lg-0" method="GET">
                    <input name="buscarpor" class="form-control mr-sm2" type="search"
                        placeholder="Busqueda por descripcion" arialabel="Search" value="{{ $buscarpor }}">
                    <button class="btn btn-success my-2 my-sm0" type="submit">Buscar</button>
                </form>

            </nav>

            <div id="mensaje">
                @if (session('datos'))
                    <div class="alert alert-warning alert-dismissible fade show mt3" role="alert">
                        {{ session('datos') }}
                        <button type="button" class="close" data-dismiss="alert" arialabel="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Operador</th>

                        <th scope="col">Direccion</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">RUC / DNI</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($cliente) <= 0)
                        <tr>
                            <td>No hay registros</td>
                        </tr>
                    @else
                        @foreach ($cliente as $item)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $item->nomcliente }}</td>
                                <td>{{ $item->apecliente }}</td>
                                <td>{{ $item->operador->descripcion }}</td>
                                <td>{{ $item->dircliente }}</td>
                                <td>{{ $item->telefono }}</td>
                                <td>{{ $item->ruc_dni }}</td>
                                <td>{{ $item->estado }}</td>
                                <td><a href="{{ route('clientes.edit', $item->idcliente) }}" class="btn btn-info btnsm"><i
                                            class="fas fa-edit"></i> Editar</a>
                                    <a href="{{ route('clientes.confirmar', $item->idcliente) }}"
                                        class="btn btn-danger btnsm"><i class="fas fa-trash"></i>
                                        Eliminar</a>
                                </td>

                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
            {{ $cliente->links() }}
        </div>
        <!-- /.card-body -->
        <div class="card-footer">

        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->



@endsection

@section('js')
    <script>
        setTimeout(function() {
            document.querySelector('#mensaje').remove();
        }, 2000);
    </script>
@endsection
