<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCoRequest;
use App\Http\Requests\UpdateCoRequest;
use App\Models\Co;
use App\Models\Compania;
use Illuminate\Http\Request;

class CoController extends Controller
{

    public function index()
    {
        $cos = Co::select(
            'id',
            'nombre',
            'codigo',
            'compania_id',
        )->get();

        return view('co.index', compact('cos'));
    }

    public function create()
    {
        $companias = Compania::select(
            'id',
            'nombre',
        )->get();

        return view('co.create',compact('companias'));
    }

    public function store(CreateCoRequest $request)
    {        
        Co::create($request->all());

        return redirect()->route('admin.co.index');
    }
    

    public function show($id)
    {
        $co = Co::find($id);
        return view('co.show', compact('co'));
    }

    public function edit($id)
    {
        $co = Co::find($id);
        $companias = Compania::select('id','nombre')->get();

        return view('co.edit', compact('co','companias'));
    }

    public function update(UpdateCoRequest $request,Co $co)
    {
        $co->where("id", $request->id)->update(
            [
                'nombre' => $request['nombre'],
                'codigo' => $request['codigo'],
                'compania_id' => $request['compania_id'],
            ]
        );

        return redirect()->route('admin.co.index');
    }
    
    public function destroy($id)
    {
        //
    }
}
