@extends('layout.plantilla')


@section('titulo', 'Editar Cliente')

@section('contenido')


    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Editar Cliente</h3>
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

            <form method="POST" action="{{ route('clientes.update', $cliente->idcliente) }}">
                @csrf
                @method('PUT')
                <h4 class="form-title">Editar Cliente</h4>
                <h4 class="form-title">Editar Cliente {{ $cliente->idcliente }}</h4>
                <div class="form-group">
                    <label class="control-label">Codigo:</label>
                    <div class="input-icon">

                        <input class="form-control " type="text" id="id" name="idcliente"
                            value="{{ $cliente->idcliente }}" value="{{ old('id') }}" disabled />
                    </div>
                </div>
                    <div class="form-group">
                    <label class="control-label">Nombre:</label>
                    <div class="input-icon">

                        <input class="form-control @error('nomcliente') is-invalid @enderror" type="text"
                            placeholder="Ingrese usuario" id="name" name="nomcliente"
                            value="{{$cliente->nomcliente}}" />
                        @error('nomcliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                  <div class="form-group">
                    <label class="control-label">Apellidos:</label>
                    <div class="input-icon">

                        <input class="form-control @error('apecliente') is-invalid @enderror" type="text"
                            placeholder="Ingrese apellido" id="name" name="apecliente"
                           value="{{$cliente->apecliente}}" />
                        @error('apecliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                   <div class="form-group">
                    <label class="control-label">Direccion:</label>
                    <div class="input-icon">

                        <input class="form-control @error('dircliente') is-invalid @enderror" type="text"
                            placeholder="Ingrese direccion" id="name" name="dircliente"
                            value="{{$cliente->dircliente}}" />
                        @error('dircliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                               <div class="form-group">
                    <label class="control-label">Telefono:</label>
                    <div class="input-icon">

                        <input class="form-control @error('telefono') is-invalid @enderror" type="text"
                            placeholder="Ingrese telefono" id="name" name="telefono"
                            value="{{$cliente->telefono}}" />
                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label">Operadores:</label>

                    <select class="form-control" id="idoperador" name="idoperador">
                        @foreach ($operador as $item)
                            <option value="{{ $item->idoperador }}"
                                {{ $item->idoperador== $cliente->idoperador ? 'selected' : '' }}>
                                {{ $item->descripcion }}
                            </option>
                        @endforeach
                    </select>

                </div>



                <hr />
                <div class="form-actions">
                    <button type="submit" class="btn btn-success btn-block">
                        Guardar </button>
                    <a type="button" href="{{ route('cancelar2') }}" class="btn btn-danger btn-block">
                        Cancelar </a>

                </div>
                <hr />
            </form>


        </div>


        <!-- /.card-footer-->
    </div>

@endsection
