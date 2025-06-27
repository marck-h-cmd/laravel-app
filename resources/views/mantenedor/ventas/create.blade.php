@extends('layouts.plantilla')
@section('estilos')
    <link rel="stylesheet" href="/assets/calendario/css/bootstrap-datepicker.standalone.css">
    <link rel="stylesheet" href="/assets/select2/bootstrap-select.min.css">
@endsection
@section('contenido')
    <div class="container">
        <h1>Registrar Venta</h1>
        <div class="alert hidden" role="alert"></div>
        <form method="POST" action="{{ route('venta.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-1">
                    <label for="">Fecha</label>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <div class="input-group date form_date " data-date-format="dd/mm/yyyy" dataprovide="datepicker">
                            <input type="text" class="form-control" name="fecha" id="fecha"
                                value="{{ Carbon\Carbon::now()->format('d/m/Y') }}" style="textalign:center;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary dateset" type="button"><i
                                        class="fa fa-calendar"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                    <label for="">Tipo</label>
                </div>
                <div class="col-md-2">
                    <select class="formcontrol" id="seltipo" name="seltipo" onchange="mostrarTipo()">
                        @foreach ($tipo as $itemtipo)
                            <option value="{{ $itemtipo['idtipo'] }}" selected>{{ $itemtipo[
                                'descripcion'
                            ] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                    <label for="">No Doc. :</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="formcontrol" name="nrodoc" id="nrodoc"
                        value="{{ $parametros->numeracion }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                    <label for="">Cliente </label>
                </div>
                <div class="col-md-7">
                    <select class="form-control select2 select2-hiddenaccessible selectpicker" style="width: 100%;"
                        data-select2-id="1" tabindex="-1" ariahidden="true" id="cliente_id" name="idcliente"
                        data-live-search="true">
                        <option value="0" selected>- Seleccione Cliente -</option>
                        @foreach ($cliente as $itemcliente)
                            <option
                                value="{{ $itemcliente->idcliente }}_{{ $itemcliente->ruc_dni }}_{{ $itemcliente->dircliente }}">
                                {{ $itemcliente->nomcliente }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                    <label for="">RUC/DNI</label>
                </div>
                <div class="col-md-2">
                    <div class="input-group">
                        <input type="text" class="form-control" name="ruc" id="ruc">
                    </div>
                </div>
            </div>
            <div class="row pt-2">
                <div class="col-md-1">
                    <label for="">Dirección </label>
                </div>
                <div class="col-md-11">
                    <input type="text" class="form-control" name="dircliente" id="direccion">
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-1">
                    <label for="">Producto </label>
                </div>
                <div class="col-md-6">
                    <select class="form-control select2 select2-hiddenaccessible selectpicker" style="width: 100%;"
                        data-select2-id="1" tabindex="-1" ariahidden="true" id="producto_id" name="idproducto"
                        data-live-search="true">
                        <option value="0" selected>- Seleccione Producto -</option>
                        @foreach ($producto as $itemproducto)
                            <option value="{{ $itemproducto->idproducto }}">{{ $itemproducto->descripcion }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1" style="text-align:right;">
                    <label for="">Unidad :</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="formcontrol" name="unidad" id="unidad">
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-1">
                </div>
                <div class="col-md-1">
                    <label for="">Precio </label>
                </div>
                <div class="col-md-2">
                    <input type="text" class="formcontrol" name="precio" id="precio">
                </div>
                <div class="col-md-1">
                    <label for="">Cantidad </label>
                </div>
                <div class="col-md-2">
                    <input type="text" class="formcontrol" name="cantidad" id="cantidad">
                </div>
                <div class="col-md-3">
                    <button type="button" id="btnadddet" class="btn btn-success"><i class="fas fashopping-cart"></i>
                        Agregar al carrito</button>
                </div>
                <div class="col-md-2">
                    <input type="text" class="formcontrol" name="stock" id="stock" hidden>
                </div>
            </div>
            <div class="col-md-12 pt-3">
                <div class="table-responsive">
                    <table id="detalles" class="table table-striped table-bordered tablecondensed table-hover"
                        style='background-color:#FFFFFF;'>
                        <thead class="thead-default" style="background-color:#3c8dbc;color: #fff;">
                            <th width="10" class="textcenter">OPCIONES</th>
                            <th class="text-center">CODIGO</th>
                            <th>DESCRIPCIÓN</th>
                            <th>UNIDAD</th>
                            <th class="textcenter">CANTIDAD</th>
                            <th class="text-center">P.VENTA</th>
                            <th>IMPORTE</th>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-2">
                        <label for="">Total : </label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control textright" name="total" id="total"
                            readonly="readonly">
                    </div>
                </div>

            </div>
            <div class="col-md-12 text-center">
                <div id="guardar">
                    <div class="form-group">
                        <button class="btn btn-primary" id="btnRegistrar"
                            data-loadingtext="<i class='fa a-spinner fa-spin'></i> Registrando">
                            <i class='fas fa-save'></i> Registrar</button>

                        <a href="{{ URL::to('venta') }}" class='btn btn-danger'><i class='fas faban'></i> Cancelar</a>
                    </div>
                </div>
            </div>
        @endsection
        @section('js')
            <script src="/assets/select2/bootstrap-select.min.js"></script>
            <script src="/assets/calendario/dist/js/bootstrap-datepicker.min.js"></script>
            <script src="/assets/calendario/dist/locales/bootstrap-datepicker.es.min.js"></script>
            <script src="/archivos/js/createdoc.js"></script>
        @endsection
