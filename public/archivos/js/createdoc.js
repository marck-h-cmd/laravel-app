var cont = 0;
var total = 0;
var detalleventa = [];
var subtotal = [];
var controlproducto = [];
$(document).ready(function () {

    $('#cliente_id').change(function () {
        mostrarCliente();
    });
    $('#producto_id').change(function () {
        mostrarProducto();
    });
    $('#btnadddet').click(function () {
        agregarDetalle();
    });
    $('#seltipo').change(function () {
        mostrarTipo();
    });
    $('form').submit(function() {
        $('#total').val(cleanNumber($('#total').val()));
        $('input[name="pventa[]"]').each(function() {
            $(this).val(cleanNumber($(this).val()));
        });
        $('input[name^="cantidad"]').each(function() {
        $(this).val(cleanNumber($(this).val()));
    });
        return true;
    });
});
function mostrarCliente() {
    datosCliente = document.getElementById('cliente_id').value.split('_');
    $('#ruc').val(datosCliente[1]);
    $('#direccion').val(datosCliente[2]);
}
function mostrarProducto() {
    producto_id = $("#producto_id").val();
    $.get('/EncontrarProducto/' + producto_id, function (data) {

        $('input[name=idproducto]').val(data[0].idproducto);
        $('input[name=unidad]').val(data[0].unidad);
        $('input[name=precio]').val(data[0].precio);
        $('input[name=stock]').val(data[0].stock);
    });
}
function mostrarTipo() {
    descripcion = $("#seltipo").val();
    $.get('/EncontrarTipo/' + descripcion, function (data) {

        $('input[name=nrodoc]').val(data[0].numeracion);
    });
}
/* Mostrar Mensajes de Error */
function mostrarMensajeError(mensaje) {
    $(".alert").css('display', 'block');
    $(".alert").removeClass("hidden");
    $(".alert").addClass("alert-danger");
    $(".alert").html("<button type='button' class='close' dataclose='alert'>×</button>" +
        "<span><b>Error!</b> " + mensaje + ".</span>");
    $('.alert').delay(5000).hide(400);
}
function agregarDetalle() {
    ruc = $("#ruc").val();
    if (ruc == '') {
        mostrarMensajeError("Por favor seleccione el Cliente");
        return false;
    }
    descripcion = $('#producto_id option:selected').text();
    if (descripcion == 'Seleccione Producto') {
        mostrarMensajeError("Por favor seleccione el Producto");
        return false;
    }
    let cantidad = $("#cantidad").val();
    let stock = $("#stock").val();
    if (cantidad == '' || Number(cantidad) == 0 || cantidad == null) {
        mostrarMensajeError("Por favor ingrese cantidad del producto");
        return false;
    }
    if (cantidad <= 0) {
        mostrarMensajeError("Por favor debe escribir cantidad del producto mayor a 0");
        return false;
    }
    if (Number(cantidad) > Number(stock)) {
        mostrarMensajeError("No se tiene tal cantidad de producto solo hay " + stock);
        return false;
    }
    pventa = $("#precio").val();
    if (pventa == '' || pventa == 0) {
        mostrarMensajeError("Por favor ingrese precio de venta del producto"
        );
        return false;
    }
    cod_producto = $("#producto_id").val();
    /* Buscar que codigo de producto no se repita */
    var i = 0;
    var band = false;
    while (i < cont) {
        if (controlproducto[i] == cod_producto) {
            band = true;
        }
        i = i + 1;
    }
    if (band == true) {
        mostrarMensajeError("No puede volver a vender el mismo producto");

        return false;
    }
    else {
        limpiar();
        unidad = $("#unidad").val();
        subtotal[cont] = cantidad * pventa;
        controlproducto[cont] = cod_producto;
        total = total + subtotal[cont];

        var fila = '<tr class="selected" id="fila' + cont + '"><td style="textalign:center;"><button type="button" class="btn btn-danger btnxs" onclick="eliminardetalle(' + cod_producto + ',' + cont + ');"><i class="fa fa-times" aria-hidden="true"></i></button></td><td style="textalign:right;"><input type="text" name="cod_producto[]" value="' + cod_producto + '" readonly style="width:50px; textalign:right;"></td><td>' + descripcion + '</td><td><input type="text" name="unidad[]" value="' + unidad + '" style="width: 140px; textalign: left; "></td><td style="textalign: right; "><input type="number" name="cantidad[]" value="' + cantidad + '"style = "width:80px; text-align:right;" readonly ></td ><td style="textalign:right;"><input type="number" name="pventa[]" value="' + pventa + '" style="width:80px; text-align:right;" readonly></td><td style="textalign:right;">' + number_format(subtotal[cont], 2) + '</td></tr > ';
        $('#detalles').append(fila);
        detalleventa.push({
            codigo: cod_producto,
            unidad: unidad,
            cantidad: cantidad,
            pventa: pventa,
            subtotal: subtotal
        });
        cont++;
    }
    $('#total').val(number_format(total, 2));
}
function limpiar() {
    $("#cantidad").val(0);
    $("#precio").val(0);
}
/* Eliminar productos */
function eliminardetalle(codigo, index) {
    total = total - subtotal[index];
    tam = detalleventa.length;
    var i = 0;
    var pos;
    while (i < tam) {
        if (detalleventa[i].codigo == codigo) {
            pos = i;
            break;
        }
        i = i + 1;
    }
    detalleventa.splice(pos, 1);
    $('#fila' + index).remove();
    controlproducto[index] = "";
    $('#total').val(number_format(total, 2));
}
function number_format(amount, decimals) {
    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto
    decimals = decimals || 0; // por si la variable no fue fue pasada
    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);
    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);
    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;
    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');
    return amount_parts.join('.');
}


function cleanNumber(num) {
    return num.toString().replace(/[^0-9.-]/g, '');
}