<?php

namespace App\Http\Controllers;

use App\Custom\Modal;
use App\Models\Empleado;
use App\Models\Incapacidad;
use App\Models\TipoIncapacidad;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IncapacidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaTipoIncapacidad = TipoIncapacidad::all();
        return view('incapacidad.incapacidad', compact('listaTipoIncapacidad'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Modal $modal, Incapacidad $incapacidad)
    {
        $validator = Validator::make($request->all(), [
            'cedula' => 'required',
            'tipoIncapacidad' => 'required',
            'fechaInicio' => 'required',
            'fechaFinal' => 'required',
            'prorroga' => 'required',
            'numero_incapacidad' => 'required',
            'quincena_nominas' => 'required',
        ]);

        if ($validator->fails()) {
            return ["modal" => $modal->modalAlerta('vinotinto', 'Informacion', 'Todos los campos son requeridos.'), "status" => 404];
        }

        //Id empleado
        $empleado = Empleado::where('cedula', $request->cedula)->take(1)->get();
        $incapacidad->fkEmpleado = $empleado[0]['id'];
        $incapacidad->fkTipo = $request->tipoIncapacidad;
        $incapacidad->fechaInicio = $request->fechaInicio;
        $incapacidad->fechaFin = $request->fechaFinal;
        $incapacidad->totalDias = $request->totalDias;
        $incapacidad->diasEmpresa = $request->diasEmpresa;
        $incapacidad->diasEps = $request->diasMedio;
        $incapacidad->prorroga = $request->prorroga;
        $incapacidad->incapacidad_prorroga = $request->incapacidad_prorroga;
        $incapacidad->numero_incapacidad = $request->numero_incapacidad;
        $incapacidad->quincenas_nomina = $request->quincena_nominas;
        $incapacidad->observacion_id = 1;
        $incapacidad->transcrita = "No";
        $incapacidad->estado_id = 1;
        $incapacidad->save();

        return ["modal" => $modal->modalAlerta('vinotinto', 'Informacion', 'Incapacidad creada exitosamente.'), "status" => 201];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cedula)
    {
        $empleado = Empleado::join('cargos', 'cargos.id', '=', 'empleados.fkCargo')
            ->join('co', 'co.id', '=', 'empleados.fkCo')
            ->join('companias', 'companias.id', '=', 'co.compania_id')
            ->select('empleados.*', 'co.nombre as centro_operaciones', 'co.codigo', 'companias.nombre as empresa', 'cargos.cargo')
            ->where('cedula', $cedula)->get();

        return  $empleado;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
