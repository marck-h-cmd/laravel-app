@extends('layout.plantilla')


@section('titulo', 'Listado de Unidades de Medida')

@section('contenido')


    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Crear Producto</h3>
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

            <form method="POST" action="{{ route('productos.store') }}">
                @csrf
                <h4 class="form-title">Crear Producto</h4>
                <div class="form-group">
                    <label class="control-label">Descripción:</label>
                    <div class="input-icon">

                        <input class="form-control @error('descripcion') is-invalid @enderror" type="text"
                            placeholder="Ingrese usuario" id="name" name="descripcion"
                            value="{{ old('descripcion') }}" />
                        @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Categorias:</label>

                    <select class="form-control" id="idcategoria" name="idcategoria">
                        @foreach ($categoria as $itemcategoria)
                            <option value="{{ $itemcategoria['idcategoria'] }}">{{ $itemcategoria['descripcion'] }}
                            </option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label class="control-label">Unidades:</label>

                    <select class="form-control" id="categoria_id" name="idunidad">
                        @foreach ($unidad as $itemunidad)
                            <option value="{{ $itemunidad['idunidad'] }}">{{ $itemunidad['descripcion'] }}
                            </option>
                        @endforeach
                    </select>

                </div>
                 <div class="form-group">
                    <label class="control-label">Precio:</label>
                    <div class="input-icon">

                        <input class="form-control @error('precio') is-invalid @enderror" type="text"
                            placeholder="Ingrese usuario" id="precio" name="precio"
                            value="{{ old('precio') }}" />
                        @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                 <div class="form-group">
                    <label class="control-label">Stock:</label>
                    <div class="input-icon">

                        <input class="form-control @error('stock') is-invalid @enderror" type="text"
                            placeholder="Ingrese usuario" id="stock" name="stock"
                            value="{{ old('stock') }}" />
                        @error('descripcion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>


                <hr />
                <div class="form-actions">
                    <button type="submit" class="btn btn-success btn-block">
                        Guardar </button>
                    <a type="button" href="{{ route('cancelar1') }}" class="btn btn-danger btn-block">
                        Cancelar </a>

                </div>
                <hr />
            </form>


        </div>


        <!-- /.card-footer-->
    </div>

@endsection
