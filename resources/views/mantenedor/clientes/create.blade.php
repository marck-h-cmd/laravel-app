@extends('layout.plantilla')


@section('titulo', 'Listado de Unidades de Medida')

@section('contenido')


    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Crear Cliente</h3>
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

            <form method="POST" action="{{ route('clientes.store') }}">
                @csrf
                <h4 class="form-title">Crear Cliente</h4>
                <div class="form-group">
                    <label class="control-label">Nombre:</label>
                    <div class="input-icon">

                        <input class="form-control @error('nomcliente') is-invalid @enderror" type="text"
                            placeholder="Ingrese usuario" id="name" name="nomcliente"
                            value="{{ old('nomcliente') }}" />
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
                            value="{{ old('apecliente') }}" />
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
                            value="{{ old('dircliente') }}" />
                        @error('dircliente')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label">RUC / DNI:</label>
                    <div class="input-icon">

                        <input class="form-control @error('ruc_dni') is-invalid @enderror" type="text"
                            placeholder="Ingrese ruc / dni" id="ruc_dni" name="ruc_dni" value="{{ old('ruc_dni') }}" />
                        @error('ruc_dni')
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
                            placeholder="Ingrese telefono" id="name" name="telefono" value="{{ old('telefono') }}" />
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
                            <option value="{{ $item['idoperador'] }}">{{ $item['descripcion'] }}
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
