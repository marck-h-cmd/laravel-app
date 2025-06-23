<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Unidad;
use App\Models\Categoria;

class ProductoController extends Controller
{
    const PAGINATION = 8;
    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $producto = Producto::where('estado', '=', '1')->where('descripcion', 'like', '%' . $buscarpor . '%')->paginate($this::PAGINATION);

        return view('mantenedor.productos.index', compact('producto', 'buscarpor'));
    }


    public function create()
    {

        //
        $categoria = Categoria::where('estado', '=', '1')->get();
        $unidad = Unidad::where('estado', '=', '1')->get();
        return view('mantenedor.productos.create', compact('categoria', 'unidad'));
    }


    public function store(Request $request)
    {
        $data = request()->validate([
            'descripcion' => 'required|max:30',
            'precio' => 'required|min:0',
            'stock' => 'required|min:0',

        ], [
            'descripcion.required' => 'Ingrese descripción de producto',
            'descripcion.max' => 'Maximo 30 de caracteres para la descripcion',
            'precio.required' => 'Ingrese precio de producto',
            'precio.min' => 'Precio no puede ser negativo',
            'stock.required' => 'Ingrese stock de producto',
            'stock.min' => 'Stock no puede ser negativo',
        ]);

        $producto = new Producto();
        $producto->descripcion = $request->descripcion;
        $producto->idcategoria = $request->idcategoria;
        $producto->idunidad = $request->idunidad;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->estado = '1';
        $producto->save();
        return redirect()->route('productos.index')->with('datos', 'Registro Nuevo Guardado!');
    }

    public function update(Request $request, $producto_id)
    {


        $data = request()->validate([
            'descripcion' => 'required|max:30',
            'precio' => 'required|min:0',
            'stock' => 'required|min:0',

        ], [
            'descripcion.required' => 'Ingrese descripción de producto',
            'descripcion.max' => 'Maximo 30 de caracteres para la descripcion'
        ]);

        $producto = Producto::findOrFail($producto_id);
        $producto->descripcion = $request->descripcion;
        $producto->idcategoria = $request->idcategoria;
        $producto->idunidad = $request->idunidad;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->save();
        return redirect()->route('productos.index')->with('datos', 'Registro Actualizado!');
    }



    public function edit($producto_id)
    {

        $producto = producto::findOrFail($producto_id);
        $categoria = Categoria::where('estado', '=', '1')->get();
        $unidad = Unidad::where('estado', '=', '1')->get();
        return view('mantenedor.productos.edit', compact('producto', 'categoria', 'unidad'));
    }

    public function destroy($id)
    {
        $pro = Producto::findOrFail($id);
        $pro->estado = '0';
        $pro->save();
        return redirect()->route('productos.index')->with('datos', 'Registro Eliminado...!');

    }
     public function confirmar($id)
    {
        $producto = Producto::findOrFail($id);
        return view('mantenedor.productos.confirmar', compact('producto'));
    }
}
