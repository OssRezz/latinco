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
        $empleado = Empleado::where('cedula', $request->cedula)->take(1)->get();
        $acumulado = $request->totalDias;
        if ($request->prorroga == "Si") {
            $acumulado = 0;
            $prorrogaIncapacidad = Incapacidad::where('empleado_id', $empleado[0]['id'])
                ->where('numero_incapacidad', $request->incapacidad_prorroga)
                ->where('prorroga', "No")->take(1)->get();

            if (count($prorrogaIncapacidad) == 0) {
                return ["modal" => $modal->modalAlerta('vinotinto', 'Informacion', 'No existe una prorroga con este numero de incapacidad'), "status" => 404];
            }

            $total = $prorrogaIncapacidad[0]['acumulado_prorroga'] + $request->totalDias;
            $prorrogaIncapacidad = Incapacidad::find($prorrogaIncapacidad[0]['id']);
            $prorrogaIncapacidad->acumulado_prorroga = $total;
            $prorrogaIncapacidad->update();
        }

        if ($request->tipoIncapacidad == 1) {
            $valorPorRecuperar = number_format((($empleado[0]['salario'] / 30) * $request->diasMedio) * 0.6667);
        } else {
            $valorPorRecuperar = number_format(($empleado[0]['salario'] / 30) * $request->diasMedio);
        }

        //Id empleado
        $incapacidad->empleado_id = $empleado[0]['id'];
        $incapacidad->fkTipo = $request->tipoIncapacidad;
        $incapacidad->fechaInicio = $request->fechaInicio;
        $incapacidad->fechaFin = $request->fechaFinal;
        $incapacidad->totalDias = $request->totalDias;
        $incapacidad->diasEmpresa = $request->diasEmpresa;
        $incapacidad->diasEps = $request->diasMedio;
        $incapacidad->prorroga = $request->prorroga;
        $incapacidad->incapacidad_prorroga = $request->incapacidad_prorroga;
        $incapacidad->acumulado_prorroga = $acumulado;
        $incapacidad->numero_incapacidad = $request->numero_incapacidad;
        $incapacidad->quincenas_nomina = $request->quincena_nominas;
        $incapacidad->observacion_id = 1;
        $incapacidad->transcrita = "No";
        $incapacidad->estado_incapacidad_id = 1;
        $incapacidad->valor_pendiente = intval(str_replace(',', '', $valorPorRecuperar));
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
