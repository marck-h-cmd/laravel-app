@extends('layout.plantilla')


@section('titulo', 'Editar User')

@section('contenido')


    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Editar user</h3>
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

                    <form method="POST" action="{{route('users.update',$user->id)}}">
                        @csrf
                         @method('PUT')
                         <h4 class="form-title">Editar Usuario</h4>
                        <h4 class="form-title">Editar Usuario {{$user->id}}</h4>
                                  <div class="form-group">
                            <label class="control-label">Name:</label>
                            <div class="input-icon">
                
                                <input class="form-control " type="text"
                                    id="id" name="idcat" value="{{$user->id}}"
                                    value="{{ old('id') }}" disabled />
                                 <input class="form-control " type="text"
                                    id="id" name="idcata" value="{{$user->password}}"
                                    value="{{ old('password') }}" disabled />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Password:</label>
                            <div class="input-icon">
                
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    placeholder="Ingrese usuario" id="name" name="name" value="{{$user->name}}"
                                    value="{{ old('name') }}" />
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                             <div class="input-icon">
                
                                <input class="form-control @error('password') is-invalid @enderror" type="text"
                                    placeholder="Ingrese usuario" id="password" name="password" 
                                    value="{{ old('raw_password') }}" />
                                @error('password')
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
                              <a type="button" href="{{route('users.cancelar')}}" class="btn btn-danger btn-block">
                                Cancelar </a>
                                
                        </div>
                        <hr />
                    </form>
              
         
        </div>


        <!-- /.card-footer-->
    </div>

@endsection
