<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function verificalogin(Request $request)
    {
        //return dd($request->all());
        $data = request()->validate(
            [
                'name' => 'required',
                'password' => 'required'
            ],
            [
                'name.required' => 'Ingrese Usuario',
                'password.required' => 'Ingrese contraseña',
            ]
        );
        if (Auth::attempt($data)) {
            $con = 'OK';
        }
        $name = $request->get('name');
        $query = User::where('name', '=', $name)->get();
        if ($query->count() != 0) {
            $hashp = $query[0]->password;
            $password = $request->get('password');
            if (password_verify($password, $hashp)) {
                return redirect()->route('home');
            } else {
                return back()->withErrors(['password' => 'Contraseña no válida'])
                    ->withInput(request(['name', 'password']));
            }
        } else {
            return back()->withErrors(['name' => 'Usuario no válido'])
                ->withInput(request(['name']));
        } 
    }
    public function salir()
    {
        Auth::logout();
        return redirect('/identificacion');
    }

    const PAGINATION = 8;
    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        $user = User::paginate($this::PAGINATION);

        return view('mantenedor.users.index', compact('user', 'buscarpor'));
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'name' => 'required|max:40',
                 'password' => 'required|max:40'
            ],
            [
                'descripcion.required' => 'Ingrese descripción de categoria',
                'descripcion.max' => 'Maximo 30 caracteres para la descripción'
            ]
        );
       
       
            $user = new User();
            $user->name = $request->name;
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('users.index')->with('datos', 'Registro Nuevo Guardado...!');
           
        }



    

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('mantenedor.users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $data = request()->validate(
            [
                'name' => 'required|max:30',
                'password' => 'required|max:60',
        
            ],
            [
                'name.required' => 'Ingrese el nombre de usuario',
                'name.max' => 'Maximo 30 caracteres para la descripción',
                'password.max' => 'Maximo 60 caracteres para la descripción',
            ]
        );
        $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->password =Hash::make($request->password) ;
            $user->save();
       

    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
          $user->delete();
        return redirect()->route('users.index')->with('datos', 'Registro Eliminado...!');

    }

    public function confirmar($id)
    {
        $categoria = User::findOrFail($id);
        return view('mantenedor.users.confirmar', compact('user'));
    }


    public function create()
    {
        return view('mantenedor.users.create');
    }



}