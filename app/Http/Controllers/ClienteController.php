<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Operador;
class ClienteController extends Controller
{

    const PAGINATION = 8;
    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $cliente = Cliente::where('estado', '=', '1')->where('nomcliente', 'like', '%' . $buscarpor . '%')->paginate($this::PAGINATION);

        return view('mantenedor.clientes.index', compact('cliente', 'buscarpor'));
    }


    public function create()
    {

        //
        $cliente = Cliente::where('estado', '=', '1')->get();
        $operador = Operador::get();
        return view('mantenedor.clientes.create', compact('cliente', 'operador'));
    }


    public function store(Request $request)
    {
        $data = request()->validate([
            'nomcliente' => 'required|max:50',
            'apecliente' => 'required|max:100',
            'dircliente' => 'required|max:100',
            'telefono' => 'required|max:10',
            'ruc_dni' => 'required|max:11'

        ], [
            'nomcliente.required' => 'Ingrese nombre cliente',
            'nomcliente.max' => 'Maximo 50 de caracteres para nombre cliente',
            'apecliente.required' => 'Ingrese apellido  de cliente',
            'apecliente.max' => 'Maximo 100 de caracteres para apellido cliente',
            'dircliente.required' => 'Ingrese direccion',
            'dircliente.max' => 'Maximo 100 de caracteres para la direccion',
            'telefono.required' => 'Ingrese telefono',
            'telefono.max' => 'Maximo 10 de caracteres para el telefono',
            'ruc_dni.required' => 'Ingrese ruc o dni',
            'ruc_dni.max' => 'Maximo 11 de caracteres para el ruc o dni',

        ]);

        $cli = new Cliente();
        $cli->nomcliente = $request->nomcliente;
        $cli->idoperador = $request->idoperador;
        $cli->apecliente = $request->apecliente;
        $cli->dircliente = $request->dircliente;
        $cli->telefono = $request->telefono;
        $cli->ruc_dni = $request->ruc_dni;
        $cli->estado = '1';
        $cli->save();
        return redirect()->route('clientes.index')->with('datos', 'Registro Nuevo Guardado!');
    }

    public function update(Request $request, $cli_id)
    {


        $data = request()->validate([
            'nomcliente' => 'required|max:50',
            'apecliente' => 'required|max:100',
            'dircliente' => 'required|max:100',
            'telefono' => 'required|max:10',
            'ruc_dni' => 'required|max:11'

        ], [
            'nomcliente.required' => 'Ingrese nombre cliente',
            'nomcliente.max' => 'Maximo 50 de caracteres para nombre cliente',
            'apecliente.required' => 'Ingrese apellido  de cliente',
            'apecliente.max' => 'Maximo 100 de caracteres para apellido cliente',
            'dircliente.required' => 'Ingrese direccion',
            'dircliente.max' => 'Maximo 100 de caracteres para la direccion',
            'telefono.required' => 'Ingrese telefono',
            'telefono.max' => 'Maximo 10 de caracteres para el telefono',
            'ruc_dni.required' => 'Ingrese ruc o dni',
            'ruc_dni.max' => 'Maximo 11 de caracteres para el ruc o dni',

        ]);
        $cli = Cliente::findOrFail($cli_id);
        $cli->nomcliente = $request->nomcliente;
        $cli->idoperador = $request->idoperador;
        $cli->apecliente = $request->apecliente;
        $cli->dircliente = $request->dircliente;
        $cli->telefono = $request->telefono;
        $cli->ruc_dni = $request->ruc_dni;
        $cli->save();
        return redirect()->route('clientes.index')->with('datos', 'Registro Actualizado!');
    }



    public function edit($cli_id)
    {

        $cliente = Cliente::findOrFail($cli_id);
        $operador = Operador::get();
        return view('mantenedor.clientes.edit', compact('cliente', 'cliente', 'operador'));
    }

    public function destroy($id)
    {
        $pro = Cliente::findOrFail($id);
        $pro->estado = '0';
        $pro->save();
        return redirect()->route('clientes.index')->with('datos', 'Registro Eliminado...!');

    }
    public function confirmar($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('mantenedor.clientes.confirmar', compact('cliente'));
    }
}
