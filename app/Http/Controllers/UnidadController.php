<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Unidad;
class UnidadController extends Controller
{
    const PAGINATION = 8;
    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $unidad = Unidad::where('estado', '=', '1')->where('descripcion', 'like', '%' . $buscarpor . '%')->paginate($this::PAGINATION);

        return view('mantenedor.unidades.index', compact('unidad', 'buscarpor'));
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                
                'descripcion' => 'required|unique:unidades|max:30',
               
            ],
            [
                'descripcion.required' => 'Ingrese descripción de categoria',
                'descripcion.max' => 'Maximo 30 caracteres para la descripción',
                 'descripcion.unique' => 'El dato ya existe'
            ]
        );
       // $u = Unidad::where('descripcion', '=', $request->descripcion)->first();
      //  if ($u !== null) {
      //        return redirect()->route('unidades.index')->with('datos', 'El dato ya existe...!');
      //  }else{
             $unidad = new Unidad();
            $unidad->descripcion = $request->descripcion;
            $unidad->estado = '1';
            $unidad->save();
            return redirect()->route('unidades.index')->with('datos', 'Registro Nuevo Guardado...!');
           
       // }



    }

    public function edit($id)
    {
        $unidad = Unidad::findOrFail($id);
        return view('mantenedor.unidades.edit', compact('unidad'));
    }
    public function update(Request $request, $id)
    {
        $data = request()->validate(
            [
                'descripcion' => 'required|unique:unidades|max:30'
            ],
            [
                'descripcion.required' => 'Ingrese descripción de categoria',
                'descripcion.max' => 'Maximo 30 caracteres para la descripción',
                'descripcion.unique' => 'El dato ya existe'

            ]
        );
        $unidad = Unidad::findOrFail($id);
       // $u = Unidad::where('descripcion', '=', $request->descripcion)->first();
      //  if ($u !== null)
           //   return redirect()->route('unidades.index')->with('datos', 'El dato ya existe...!');
       // else {
            $unidad->descripcion = $request->descripcion;
            $unidad->save();
            return redirect()->route('unidades.index')->with('datos', 'Registro Actualizado...!');
      //  }

    }

    public function destroy($id)
    {
        $unidad = Unidad::findOrFail($id);
        $unidad->estado = '0';
        $unidad->save();
        return redirect()->route('unidades.index')->with('datos', 'Registro Eliminado...!');

    }

    public function confirmar($id)
    {
        $categoria = Unidad::findOrFail($id);
        return view('mantenedor.unidades.confirmar', compact('unidad'));
    }


    public function create()
    {
        return view('mantenedor.unidades.create');
    }


}
