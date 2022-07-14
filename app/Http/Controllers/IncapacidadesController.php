<?php

namespace App\Http\Controllers;

use App\Custom\Modal;
use App\Models\Empleado;
use App\Models\EstadoIncapacidad;
use App\Models\Incapacidad;
use App\Models\TipoIncapacidad;
use App\Models\Transcripcion;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use ReturnTypeWillChange;

class IncapacidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('incapacidad.incapacidades');
    }

    public function table()
    {
        
        $listaIncapacidades = Incapacidad::with('Empleado')->with('Observacion')->with('EstadoIncapacidad')->get();
        $table = "";
        foreach ($listaIncapacidades->chunk(1000) as $chunk) {
            foreach ($chunk as  $value) {
                # code...
                $fechaIncapacidad = new DateTime(date('Y-m-d', strtotime($value->fechaInicio)));
                $fechaActual = new DateTime(date('Y-m-d'));
                $intvl = $fechaActual->diff($fechaIncapacidad);
                $backgroundColor = '';

                if ($intvl->days >= 90 && $value->estado_incapacidad_id == 1) {
                    $backgroundColor = 'bg-amarillo';
                }

                if ($value->acumulado_prorroga >= 120) {
                    $backgroundColor = 'bg-rojo';
                }


                $table .= "<tr class='$backgroundColor'>";
                $table .= "<td>{$value->empleado->nombre}</td>";
                $table .= "<td class='text-center'>{$value->empleado->cedula}</td>";
                $table .= "<td class='text-center'>{$value->empleado->eps}</td>";
                $table .= "<td class='text-center'>{$value->fechaInicio}</td>";
                $table .= "<td class='text-center'>{$value->fechaFin}</td>";
                $table .= "<td class='text-center'>{$value->totalDias}</td>";
                $table .= "<td class='text-center'>{$value->prorroga}</td>";
                $table .= "<td class='text-center'> <span class='badge bg-white text-dark border border-info border-2'>{$value->observacion->observacion}</span></td>";
                $table .= "<td class='text-center'> <span class='badge bg-{$value->EstadoIncapacidad->color}'>{$value->EstadoIncapacidad->estado}</span></td>";
                $table .= "<td class='text-center'>";
                if ($value->transcrita  == "No") {
                    $table .= "<button class='btn btn-danger btn-sm mx-1' value='{$value->id}' onclick='modalTranscribir(this)'><i class='fas fa-dollar-sign'></i></button>";
                }
                $table .= "<button class='btn btn-danger btn-sm mx-1' value='{$value->id}' onclick='modalEditar(this)'><i class='fas fa-edit'></i></button>";
                $table .= "<button class='btn btn-danger btn-sm mx-1' value='{$value->id}' onclick='elimiarIncapacidad(this)'><i class='fas fa-trash'></i></button>";
                $table .= "</td>";
                $table .= "</tr>";
            }
        }

        return $table;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Modal $modal, Request $request)
    {
        $incapacidad = Incapacidad::where('id', $request->id)->get();
        $empleado = Empleado::where('id', $incapacidad[0]['empleado_id'])->get();
        if ($incapacidad[0]['fkTipo'] == 1) {
            $valorPorRecuperar = number_format((($empleado[0]['salario'] / 30) * $incapacidad[0]['diasEps']) * 0.6667);
        } else {
            $valorPorRecuperar = number_format(($empleado[0]['salario'] / 30) * $incapacidad[0]['diasEps']);
        }
        $listaEstado = EstadoIncapacidad::all();
        $contenidoModal =  "<form id='frmTranscripcion'>";
        $contenidoModal .=  "<div class='row g-3'>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  name='fechaPago' type='date' class='form-control' placeholder='Fecha del pago'>";
        $contenidoModal .= "            <label for='fechaPago'>Fecha del pago</label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input name='valorRecuperado' type='number' class='form-control' placeholder='Valor recuperado'>";
        $contenidoModal .= "            <label for='valorRecuperado'>Valor recuperado</label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-12'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input name='valorPendiente'  value='$valorPorRecuperar' type='text' class='form-control' placeholder='Restante por recuperar'>";
        $contenidoModal .= "            <label for='valorPendiente'>Restante por recuperar <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <select class='form-select' name='estado'>";
        foreach ($listaEstado as $estado) {
            $id = $estado['id'];
            $estado = $estado['estado'];

            $contenidoModal .= "                <option value='$id'>$estado</option>";
        }
        $contenidoModal .= "            </select>";
        $contenidoModal .= "            <label for=''>Estado</label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='d-grid mt-3'>";
        $contenidoModal .= "        <button class='btn btn-danger'  data-bs-dismiss='modal' aria-label='Close' id='btn-update-class' value='$request->id' onclick='ingresarTranscripcion(this)'>Recaudar</button>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "</div>";
        $contenidoModal .= "</form>";

        return $modal->modalAlerta("vinotinto", "Recaudar incapacidad", $contenidoModal);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Modal $modal, Transcripcion $transcripcion)
    {
        if ($request->estado == 1) {
            $oberservacion = 1;
        } else if ($request->estado == 4) {
            $oberservacion = 1;
        } else if ($request->estado == 7) {
            $oberservacion = 2;
        } else if ($request->estado == 8) {
            $oberservacion = 1;
        } else if ($request->estado == 9) {
            $oberservacion = 1;
        } else {
            $oberservacion = 3;
        }
        try {


            $incapacidad = Incapacidad::find($request->id);
            $incapacidad->transcrita = "Si";
            $incapacidad->observacion_id = $oberservacion;
            $incapacidad->estado_incapacidad_id = $request->estado;
            if (!$incapacidad->update()) {
                return  $modal->modalAlerta('vinotinto', 'Informacion', 'No se puede transcribir esta incapacidad.');
            }
            $fechaActual = date('Y-m-d');
            $transcripcionEnIncapacidad = Transcripcion::where('incapacidad_id', $request->id)->take(1)->get();
            if (count($transcripcionEnIncapacidad) > 0) {
                return  $modal->modalAlerta('vinotinto', 'Informacion', 'Error ya existe una transcripcion de este registro.');
            }
            $transcripcion->incapacidad_id = $request->id;
            $transcripcion->fechaActualizacion = $fechaActual;
            $transcripcion->fechaPago = $request->fechaPago;
            $transcripcion->valorRecuperado = $request->valorRecuperado;
            $transcripcion->valorPendiente = intval(str_replace(',', '', $request->valorPendiente));

            if ($transcripcion->save()) {
                return  $modal->modalAlerta('vinotinto', 'Informacion', 'Incapacidad transcripta.');
            }
        } catch (Exception $e) {
            return  $modal->modalAlerta('vinotinto', 'Informacion', 'Algo salio mal...');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Modal $modal)
    {
        $tipoIncapacidades = TipoIncapacidad::all();
        $listaEstado = EstadoIncapacidad::all();
        $Transcripcion = Transcripcion::where('incapacidad_id', $id)->get();
        $Incapacidad = Incapacidad::join('tipo_incapacidades', 'tipo_incapacidades.id', '=', 'incapacidades.fkTipo')
            ->join('estado_incapacidades', 'estado_incapacidades.id', '=', 'incapacidades.estado_incapacidad_id')
            ->select('incapacidades.*', 'tipo_incapacidades.tipo', 'estado_incapacidades.estado')
            ->where('incapacidades.id', $id)->get();

        foreach ($Incapacidad as $Incapacidad) {
            $fechaInicio = $Incapacidad['fechaInicio'];
            $fechaFin = $Incapacidad['fechaFin'];
            $totalDias = $Incapacidad['totalDias'];
            $diasEmpresa = $Incapacidad['diasEmpresa'];
            $diasEps = $Incapacidad['diasEps'];
            $prorroga = $Incapacidad['prorroga'];
            $transcrita = $Incapacidad['transcrita'];
            $numeroIncapacidad = $Incapacidad['numero_incapacidad'];
            $quincenas_nomina = $Incapacidad['quincenas_nomina'];
            $fkTipo = $Incapacidad['fkTipo'];
            $tipo = $Incapacidad['tipo'];
            $incapacidad_prorroga = $Incapacidad['incapacidad_prorroga'];
            $estado_incapacidad_id = $Incapacidad['estado_incapacidad_id'];
            $estadoIncapacidad = $Incapacidad['estado'];
        }
        if ($fkTipo == 2) {
            $medio = "ARL";
        } else {
            $medio = "EPS";
        }


        foreach ($Transcripcion as $recaudo) {
            $fechaPago = $recaudo['fechaPago'];
            $valorRecuperado = $recaudo['valorRecuperado'];
            $valorPendiente = $recaudo['valorPendiente'];
        }

        $contenidoModal =  "<div class='row g-3'>";
        $contenidoModal .=  "<div><p class='m-0 p-0'><em>Incapacidad</em></p></div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <select class='form-select' id='tipo'>";
        $contenidoModal .= "            <option value='$fkTipo' selected>$tipo</option>";
        foreach ($tipoIncapacidades as $tipo) {
            $idTipo = $tipo['id'];
            $tipoIncapacidad = $tipo['tipo'];
            if ($idTipo != $fkTipo) {
                $contenidoModal .= "                <option value='$idTipo'>$tipoIncapacidad</option>";
            }
        }
        $contenidoModal .= "            </select>";
        $contenidoModal .= "            <label for=''>Tipo de incapacidad <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='numeroIncapacidad' type='number' value='$numeroIncapacidad' class='form-control' placeholder='Fecha inicio'>";
        $contenidoModal .= "            <label for='numeroIncapacidad'>Numero incapacidad <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='fechaInicio' type='date' value='$fechaInicio' class='form-control' placeholder='Fecha inicio'>";
        $contenidoModal .= "            <label for='fechaInicio'>Fecha inicio <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='fechaFin' type='date' value='$fechaFin' class='form-control' placeholder='Fecha final'>";
        $contenidoModal .= "            <label for='fechaFin'>Fecha final <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-4'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='totalDias' type='number' value='$totalDias' class='form-control' placeholder='Total dias'>";
        $contenidoModal .= "            <label for='totalDias'>Total dias <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-4'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='diasEmpresa' type='number' value='$diasEmpresa' class='form-control' placeholder='Total empresa'>";
        $contenidoModal .= "            <label for='diasEmpresa'>Total empresa <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-4'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='diasEps' type='number' value='$diasEps' class='form-control' placeholder='Total eps'>";
        $contenidoModal .= "            <label for='diasEps'>Total $medio <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='quincenas_nomina' type='text' value='$quincenas_nomina' class='form-control' placeholder='Total eps'>";
        $contenidoModal .= "            <label for='quincenas_nomina'>Quincena <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <select id='prorroga' class='form-select'>";
        if ($prorroga == "Si") {
            $contenidoModal .= "            <option value='Si'>Si</option>";
            $contenidoModal .= "            <option value='No'>No</option>";
        } else {
            $contenidoModal .= "            <option value='Si'>No</option>";
            $contenidoModal .= "            <option value='No'>Si</option>";
        }
        $contenidoModal .= "            </select>";
        $contenidoModal .= "            <label for='valorPendiente'>Prorroga <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        if ($prorroga == "Si") {
            $hidden = "";
        } else {
            $hidden = "hidden";
        }
        $contenidoModal .= "    <div class='col-12' $hidden>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='incapacidad_prorroga' type='text' value='$incapacidad_prorroga' class='form-control' placeholder='Total eps'>";
        $contenidoModal .= "            <label for='incapacidad_prorroga'>Incapacidad que prorroga <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        if ($transcrita == "Si" && count($Transcripcion) > 0) {
            $contenidoModal .= "    <hr>";
            $contenidoModal .=  "<div class='mt-0 pt-0'><p class='m-0 p-0'><em>Recaudo</em></p></div>";
            //
            $contenidoModal .= "    <div class='col-12'>";
            $contenidoModal .= "        <div class='form-floating'>";
            $contenidoModal .= "            <input  id='fechaPago' type='date' value='$fechaPago' class='form-control' placeholder='Fecha del pago'>";
            $contenidoModal .= "            <label for='fechaPago'>Fecha del pago</label>";
            $contenidoModal .= "        </div>";
            $contenidoModal .= "    </div>";
            //
            $contenidoModal .= "    <div class='col-12 col-lg-6'>";
            $contenidoModal .= "        <div class='form-floating'>";
            $contenidoModal .= "            <input id='valorRecuperado' type='number' value='$valorRecuperado' class='form-control' placeholder='Valor recuperado'>";
            $contenidoModal .= "            <label for='valorRecuperado'>Valor recuperado</label>";
            $contenidoModal .= "        </div>";
            $contenidoModal .= "    </div>";
            //
            $contenidoModal .= "    <div class='col-12 col-lg-6'>";
            $contenidoModal .= "        <div class='form-floating'>";
            $contenidoModal .= "            <input id='valorPendiente' type='text' value='$valorPendiente' class='form-control' placeholder='Restante por recuperar'>";
            $contenidoModal .= "            <label for='valorPendiente'>Restante por recuperar</label>";
            $contenidoModal .= "        </div>";
            $contenidoModal .= "    </div>";
            //
        }
        $contenidoModal .= "    <hr>";
        $contenidoModal .=  "<div class='my-0 py-0'><p class='m-0 p-0'><em>Estado</em></p></div>";

        //
        $contenidoModal .= "    <div class='col-12'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <select class='form-select' id='estado'>";
        $contenidoModal .= "            <option value='$estado_incapacidad_id' selected>$estadoIncapacidad</option>";
        foreach ($listaEstado as $estado) {
            $idEstado = $estado['id'];
            $estado = $estado['estado'];
            if ($idEstado != $estado_incapacidad_id) {
                $contenidoModal .= "                <option value='$idEstado'>$estado</option>";
            }
        }
        $contenidoModal .= "            </select>";
        $contenidoModal .= "            <label for=''>Estado <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //

        $contenidoModal .= "    <div class='d-grid mt-3'>";
        $contenidoModal .= "        <button class='btn btn-danger' data-bs-dismiss='modal' aria-label='Close' id='btn-update-class' value='$id' onclick='actualizarIncapacidad(this)'>Actualizar</button>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "</div>";

        return $modal->modalAlerta("vinotinto", "Actualizar incapacidad", $contenidoModal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Modal $modal)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required',
            'numeroIncapacidad' => 'required',
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
            'totalDias' => 'required',
            'diasEmpresa' => 'required',
            'diasEps' => 'required',
            'estado' => 'required',
        ]);
        if ($validator->fails()) {
            return $modal->modalAlerta('vinotinto', 'Informacion', 'Los campos marcados con <b class="text-danger">*</b> son requeridos.');
        }

        if ($request->estado == 1) {
            $oberservacion = 1;
        } else if ($request->estado == 4) {
            $oberservacion = 1;
        } else if ($request->estado == 7) {
            $oberservacion = 2;
        } else if ($request->estado == 8) {
            $oberservacion = 1;
        } else if ($request->estado == 9) {
            $oberservacion = 1;
        } else {
            $oberservacion = 3;
        }


        $incapacidad = Incapacidad::find($id);
        $incapacidad->fkTipo = $request->tipo;
        $incapacidad->numero_incapacidad = $request->numeroIncapacidad;
        $incapacidad->fechaInicio = $request->fechaInicio;
        $incapacidad->fechaFin = $request->fechaFin;
        $incapacidad->totalDias = $request->totalDias;
        $incapacidad->diasEmpresa = $request->diasEmpresa;
        $incapacidad->diasEps = $request->diasEps;
        $incapacidad->quincenas_nomina = $request->quincenas_nomina;
        $incapacidad->prorroga = $request->prorroga;
        $incapacidad->incapacidad_prorroga = $request->incapacidad_prorroga;
        $incapacidad->observacion_id = $oberservacion;
        $incapacidad->estado_incapacidad_id = $request->estado;
        $incapacidad->valor_pendiente = intval(str_replace(',', '', $request->valorPendiente));
        if (!$incapacidad->update()) {
            return $modal->modalAlerta('vinotinto', 'Informacion', 'La incapacidad no se puede actualizar.');
        }

        $incapacidadTranscrita = Incapacidad::where('id', $id)->get();
        $Transcrita = Transcripcion::where('incapacidad_id', $id)->get();
        if ($incapacidadTranscrita[0]['transcrita'] == "Si"  && count($Transcrita) > 0) {

            $transcripcion = Transcripcion::where('incapacidad_id', $id)->get();
            $transcripcion = Transcripcion::find($transcripcion[0]['id']);
            $transcripcion->fechaPago = $request->fechaPago;
            $transcripcion->valorRecuperado = $request->valorRecuperado;
            $transcripcion->valorPendiente = intval(str_replace(',', '', $request->valorPendiente));
            if (!$transcripcion->update()) {
                return $modal->modalAlerta('vinotinto', 'Informacion', 'La incapacidad no se puede actualizar.');
            }
        }


        return $modal->modalAlerta('vinotinto', 'Informacion', 'Incapacidad actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Modal $modal)
    {
        $incapacidad = Incapacidad::find($id);

        try {
            if ($incapacidad->delete()) {
                return $modal->modalAlerta("vinotinto", "Informaci&#243;n", "Incapacidad eliminada exitosamente.");
            }
        } catch (Exception $e) {
            return $modal->modalAlerta("vinotinto", "Informaci&#243;n", "La incapacidad no se puede eliminar por que tiene transcripciones asociados.");
        }
    }
}
