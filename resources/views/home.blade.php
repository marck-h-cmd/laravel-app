@extends('layout.plantilla')


@section('titulo','Bienvenido')

@section('contenido')

  <!-- Default box -->
  <div class="card card-success">
    <div class="card-header">
      <h3 class="card-title">Iniciaste sesion</h3>

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
        <h1>Ingresaste correctamente</h1>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
      Footer
    </div>
    <!-- /.card-footer-->
  </div>
  <!-- /.card -->


@endsection