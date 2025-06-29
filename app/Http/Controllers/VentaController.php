<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CabeceraVenta;
use App\Models\DetalleVenta;
use DB;
use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Tipo;
use App\Models\Parametro;
use Carbon\Carbon;
use Exception;
class VentaController extends Controller
{
    const PAGINATION = 4;
    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $venta = CabeceraVenta::where('estado', '=', '1')->where('nrodoc', 'like', '%' . $buscarpor . '%')->paginate($this::PAGINATION);
        return view('mantenedor.ventas.index', compact('venta', 'buscarpor'));
    }


    public function create()
    {
        $cliente = DB::table('clientes')->get();
        $producto = DB::table('productos')->get();
        $tipo = Tipo::all();
        $tipou = Tipo::select('idtipo', 'descripcion')->orderBy('idtipo', 'DESC')->get();
        $parametros = Parametro::findOrFail($tipou[0]->idtipo);
        return view('mantenedor.ventas.create', compact('tipo', 'parametros', 'cliente', 'producto'));
    }


    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            /* Grabar Cabecera */
            /* Obtiene codigo cliente a partir del dni */
            $total = str_replace(',', '', $request->total);
            $cliente = Cliente::where('ruc_dni', '=', $request->ruc)->get();
            $idcliente = $cliente[0]->idcliente;
            $venta = new CabeceraVenta();
            $venta->idcliente = $idcliente;
            $venta->nrodoc = $request->get('nrodoc');
            $venta->idtipo = $request->seltipo;
            $arr = explode('/', $request->fecha);
            $nFecha = $arr[2] . '-' . $arr[1] . '-' . $arr[0];
            $venta->fecha_venta = $nFecha;
            if ($request->seltipo == '2') {
                $venta->total = (float) $total;
                $venta->subtotal = '0';
                $venta->igv = '0';
            } else {
                $venta->total = '100';
                $venta->subtotal = '0';
                $venta->igv = '0';
            }
            $venta->estado = '1';
            $venta->save();
            /* Grabar Detalle */
            $producto_id = $request->cod_producto;
            $cantidad = $request->cantidad;
            $pventa = $request->pventa;

            $cont = 0;
            while ($cont < count($producto_id)) {
                $detalle = new DetalleVenta();
                $detalle->idventa = $venta->idventa;
                $detalle->idproducto = $producto_id[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio = $pventa[$cont];
                $detalle->save();
                Producto::ActualizarStock($detalle->idproducto, $detalle->cantidad);
                $cont++;
            }
            DB::commit();
            return redirect()->route('venta.index')->with('datos', 'Venta Nueva Realizada!');
        } catch (Exception $e) {
            DB::rollback();
            \Log::error('Sale failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Error al registrar la venta: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    /* Para select2 Buscar Productos */
    public function ProductoCodigo($producto_id)
    {
        return DB::table('productos as p')->join('unidades as u', 'p.idunidad', '=', 'u.idunidad')->where('p.estado', '=', '1')->where('p.idproducto', '=', $producto_id)->select(
            'p.idproducto',
            'p.descripcion',
            'u.descripcion as unidad',
            'p.precio',
            'p.stock'
        )->get();
    }
    public function PorTipo($descripcion)
    {
        //return Tipo::where('descripcion','=',$descripcion)->get();
        return DB::table('tipos as t')->join('parametros as p', 'p.idtipo', '=', 't.idtipo')->where('t.idtipo', '=', $descripcion)->select('t.idtipo', 't.descripcion', 'p.serie', 'p.numeracion')->get();
    }
}


