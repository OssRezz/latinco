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
        $cos = Co::all();

        return view('co.index', compact('cos'));
    }

    public function create()
    {
        $companias = Compania::all();

        return view('co.create',compact('companias'));
    }

    public function store(CreateCoRequest $request)
    {        
        Co::create($request->validated());

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
        $companias = Compania::all();

        return view('co.edit', compact('co','companias'));
    }

    public function update(UpdateCoRequest $request,Co $co)
    {

        $co->update($request->validated());

        return redirect()->route('admin.co.index');
    }
    
    public function destroy($id)
    {
        //
    }
}
