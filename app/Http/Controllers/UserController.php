<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        $usuarios = User::select(
            'id',
            'nombres',
            'apellidos',
            'email',
            'rol_id',
        )->get();

        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::select('id', 'rol')->get();

        return view('usuarios.create', compact('roles'));
    }

    public function store(CreateUsuarioRequest $request)
    {
        User::create($request->all());

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
        $roles = Rol::select('id','rol')->get();

        return view('usuarios.edit', compact('usuario','roles'));
    }

    public function update(UpdateUsuarioRequest $request, User $usuario)
    {

        $usuario->where("id", $request->id)->update(
            [
                'nombres' => $request['nombres'],
                'apellidos' => $request['apellidos'],
                'email' => $request['email'],
                'rol_id' => $request['rol_id'],
            ]
        );

        return redirect()->route('admin.usuario.index');
    }

    public function destroy($id)
    {
        //
    }
}
