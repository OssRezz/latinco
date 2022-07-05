<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $usuarios = User::all();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::select('id', 'rol')->get();

        return view('usuarios.create', compact('roles'));
    }

    public function store(CreateUsuarioRequest $request)
    {

        return User::create([
            'nombres' => $request['nombres'],
            'apellidos' => $request['apellidos'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'rol_id' =>  $request['rol_id'],
            'remember_token'     => null,
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        return redirect()->route('admin.usuario.index');
    }

    public function show($id)
    {
        $usuario = User::find($id);

        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Rol::select('id', 'rol')->get();

        return view('usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(UpdateUsuarioRequest $request, User $usuario)
    {

        $usuario->update($request->validated());
        return redirect()->route('admin.usuario.index');
    }

    public function destroy($id)
    {
        //
    }
}
