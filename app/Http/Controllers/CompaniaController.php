<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCompaniaRequest;
use App\Models\Compania;
use Illuminate\Http\Request;

class CompaniaController extends Controller
{

    public function index()
    {
        $companias = Compania::select(
            'id',
            'nombre',
            'tipo_compania',
        )->get();

        return view('companias.index', compact('companias'));
    }

    public function create()
    {
        return view('companias.create');
    }

    public function store(Request $request)
    {

        Compania::create($request->all());

        return redirect()->route('admin.compania.index');
    }

    public function show($id)
    {
        $compania = Compania::find($id);
        return view('companias.show', compact('compania'));
    }

    public function edit($id)
    {
        $compania = Compania::find($id);
        return view('companias.edit', compact('compania'));
    }

    public function update(UpdateCompaniaRequest $request, Compania $compania)
    {
        $compania->where("id", $request->id)->update(
            [
                'nombre' => $request['nombre'],
                'tipo_compania' => $request['tipo_compania'],
            ]
        );

        return redirect()->route('admin.compania.index');
    }

    // public function destroy($id)
    // {

    // }
}
