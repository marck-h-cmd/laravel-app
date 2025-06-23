<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Log;
class CategoriaController extends Controller
{

    const PAGINATION = 8;
    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $categoria = Categoria::where('estado', '=', '1')->where('descripcion', 'like', '%' . $buscarpor . '%')->paginate($this::PAGINATION);

        return view('mantenedor.categorias.index', compact('categoria', 'buscarpor'));
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'descripcion' => 'required|max:30'
            ],
            [
                'descripcion.required' => 'Ingrese descripción de categoria',
                'descripcion.max' => 'Maximo 30 caracteres para la descripción'
            ]
        );
        $categoria = new Categoria();
        $categoria->descripcion = $request->descripcion;
        $categoria->estado = '1';
        $categoria->save();
        return redirect()->route('categorias.index')->with('datos', 'Registro Nuevo Guardado...!');


    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('mantenedor.categorias.edit', compact('categoria'));
    }
    public function update(Request $request, $id)
    {
        $data = request()->validate(
            [
                'descripcion' => 'required|max:30'
            ],
            [
                'descripcion.required' => 'Ingrese descripción de categoria',
                'descripcion.max' => 'Maximo 30 caracteres para la descripción'
            ]
        );
        $categoria = Categoria::findOrFail($id);
        $categoria->descripcion = $request->descripcion;
        $categoria->save();
        return redirect()->route('categorias.index')->with('datos', 'Registro Actualizado...!');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->estado = '0';
        $categoria->save();
        return redirect()->route('categorias.index')->with('datos', 'Registro Eliminado...!');

    }

    public function confirmar($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('mantenedor.categorias.confirmar', compact('categoria'));
    }


    public function create()
    {
        return view('mantenedor.categorias.create');
    }


}
