<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCompaniaRequest;
use App\Http\Requests\UpdateCompaniaRequest;
use App\Models\Compania;
use Illuminate\Http\Request;

class CompaniaController extends Controller
{

    public function index()
    {
        $companias = Compania::all();

        return view('companias.index', compact('companias'));
    }

    public function create()
    {
        return view('companias.create');
    }

    public function store(CreateCompaniaRequest $request)
    {

        Compania::create($request->validated());

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
        $compania->update($request->validated());

        return redirect()->route('admin.compania.index');
    }

    // public function destroy($id)
    // {

    // }
}
