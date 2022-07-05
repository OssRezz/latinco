<?php

namespace App\Http\Controllers;

use App\Custom\Modal;
use App\Models\EstadoIncapacidad;
use App\Models\Incapacidad;
use App\Models\TipoIncapacidad;
use App\Models\Transcripcion;
use Exception;
use Illuminate\Http\Request;
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
        $listaIncapacidades = Incapacidad::join('empleados', 'empleados.id', '=', 'incapacidades.fkEmpleado')
            ->join('observaciones', 'observaciones.id', '=', 'incapacidades.observacion_id')
            ->join('estado_incapacidades', 'estado_incapacidades.id', '=', 'incapacidades.estado_id')
            ->select('incapacidades.*', 'empleados.nombre', 'empleados.cedula', 'observaciones.observacion', 'estado_incapacidades.estado')->get();
        return view('incapacidad.incapacidades', compact('listaIncapacidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Modal $modal, Request $request)
    {
        $listaEstado = EstadoIncapacidad::all();
        $contenidoModal =  "<form id='frmTranscripcion'>";
        $contenidoModal .=  "<div class='row g-3'>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  name='fechaTranscripcion' type='date' class='form-control' placeholder='Fecha de la transcripcion'>";
        $contenidoModal .= "            <label for='fechaTranscripcion'>Fecha de la transcripcion <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  name='numeroIncapacidad' type='text' class='form-control'  placeholder='Numero de la incapacidad'>";
        $contenidoModal .= "            <label for='numeroIncapacidad'>Numero de la incapacidad</label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
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
        $contenidoModal .= "            <input  name='quincenasNomina' type='text' class='form-control' placeholder='Quincenas nomina'>";
        $contenidoModal .= "            <label for='quincenasNomina'>Quincenas nomina</label>";
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
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input name='valorPendiente' type='number' class='form-control' placeholder='Restante por recuperar'>";
        $contenidoModal .= "            <label for='valorPendiente'>Restante por recuperar</label>";
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
        $contenidoModal .= "        <button class='btn btn-danger' id='btn-update-class' value='$request->id' onclick='ingresarTranscripcion(this)'>Transcribir</button>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "</div>";
        $contenidoModal .= "</form>";

        return $modal->modalAlerta("vinotinto", "Transcibir incapacidad", $contenidoModal);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Modal $modal, Transcripcion $transcripcion)
    {
        $validator = Validator::make($request->all(), [
            'fechaTranscripcion' => 'required',
        ]);
        if ($validator->fails()) {
            return $modal->modalAlertaReaload('vinotinto', 'Informacion', 'Todos los campos son requeridos.');
        }

        $incapacidad = Incapacidad::find($request->id);
        $incapacidad->transcrita = "Si";
        $incapacidad->observacion_id = 2;
        $incapacidad->estado_id = $request->estado;
        if (!$incapacidad->update()) {
            return  $modal->modalAlertaReaload('vinotinto', 'Informacion', 'No se puede transcribir esta incapacidad.');
        }

        $transcripcion->incapacidad_id = $request->id;
        $transcripcion->fechaTranscripcion = $request->fechaTranscripcion;
        $transcripcion->numeroIncapacidad = $request->numeroIncapacidad;
        $transcripcion->fechaPago = $request->fechaPago;
        $transcripcion->quincenasNomina = $request->quincenasNomina;
        $transcripcion->valorRecuperado = $request->valorRecuperado;
        $transcripcion->valorPendiente = $request->valorPendiente;

        if ($transcripcion->save()) {
            return  $modal->modalAlertaReaload('vinotinto', 'Informacion', 'Incapacidad transcripta.');
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
        $Incapacidad = Incapacidad::where('id', $id)->get();
        foreach ($Incapacidad as $Incapacidad) {
            $fechaInicio = $Incapacidad['fechaInicio'];
            $fechaFin = $Incapacidad['fechaFin'];
            $totalDias = $Incapacidad['totalDias'];
            $diasEmpresa = $Incapacidad['diasEmpresa'];
            $diasEps = $Incapacidad['diasEps'];
            $prorroga = $Incapacidad['prorroga'];
            $transcrita = $Incapacidad['transcrita'];
        }

        foreach ($Transcripcion as $Transcripcion) {
            $fechaTranscripcion = $Transcripcion['fechaTranscripcion'];
            $numeroIncapacidad = $Transcripcion['numeroIncapacidad'];
            $fechaPago = $Transcripcion['fechaPago'];
            $quincenasNomina = $Transcripcion['quincenasNomina'];
            $valorRecuperado = $Transcripcion['fechaPago'];
            $valorPendiente = $Transcripcion['valorPendiente'];
        }

        $contenidoModal =  "<div class='row g-3'>";
        $contenidoModal .=  "<div><p class='m-0 p-0'><em>Incapacidad</em></p></div>";
        //
        $contenidoModal .= "    <div class='col-12'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <select class='form-select' id='tipo'>";
        foreach ($tipoIncapacidades as $tipo) {
            $idTipo = $tipo['id'];
            $tipoIncapacidad = $tipo['tipo'];

            $contenidoModal .= "                <option value='$idTipo'>$tipoIncapacidad</option>";
        }
        $contenidoModal .= "            </select>";
        $contenidoModal .= "            <label for=''>Estado <b class='text-danger'>*</b></label>";
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
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='totalDias' type='number' value='$totalDias' class='form-control' placeholder='Total dias'>";
        $contenidoModal .= "            <label for='totalDias'>Total dias <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='diasEmpresa' type='number' value='$diasEmpresa' class='form-control' placeholder='Total empresa'>";
        $contenidoModal .= "            <label for='diasEmpresa'>Total empresa <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //
        $contenidoModal .= "    <div class='col-12 col-lg-6'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='diasEps' type='number' value='$diasEps' class='form-control' placeholder='Total eps'>";
        $contenidoModal .= "            <label for='diasEps'>Total eps <b class='text-danger'>*</b></label>";
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
        if ($transcrita == "Si") {
            $contenidoModal .= "    <hr>";
            $contenidoModal .=  "<div class='mt-0 pt-0'><p class='m-0 p-0'><em>Transcripcion</em></p></div>";
            //
            $contenidoModal .= "    <div class='col-12 col-lg-6'>";
            $contenidoModal .= "        <div class='form-floating'>";
            $contenidoModal .= "            <input  id='fechaTranscripcion' type='date' value='$fechaTranscripcion' class='form-control' placeholder='Fecha de la transcripcion'>";
            $contenidoModal .= "            <label for='fechaTranscripcion'>Fecha de la transcripcion <b class='text-danger'>*</b></label>";
            $contenidoModal .= "        </div>";
            $contenidoModal .= "    </div>";
            //
            $contenidoModal .= "    <div class='col-12 col-lg-6'>";
            $contenidoModal .= "        <div class='form-floating'>";
            $contenidoModal .= "            <input  id='numeroIncapacidad' type='text' value='$numeroIncapacidad' class='form-control'  placeholder='Numero de la incapacidad'>";
            $contenidoModal .= "            <label for='numeroIncapacidad'>Numero de la incapacidad</label>";
            $contenidoModal .= "        </div>";
            $contenidoModal .= "    </div>";
            //
            $contenidoModal .= "    <div class='col-12 col-lg-6'>";
            $contenidoModal .= "        <div class='form-floating'>";
            $contenidoModal .= "            <input  id='fechaPago' type='date' value='$fechaPago' class='form-control' placeholder='Fecha del pago'>";
            $contenidoModal .= "            <label for='fechaPago'>Fecha del pago</label>";
            $contenidoModal .= "        </div>";
            $contenidoModal .= "    </div>";
            //
            $contenidoModal .= "    <div class='col-12 col-lg-6'>";
            $contenidoModal .= "        <div class='form-floating'>";
            $contenidoModal .= "            <input  id='quincenasNomina' type='text' value='$quincenasNomina' class='form-control' placeholder='Quincenas nomina'>";
            $contenidoModal .= "            <label for='quincenasNomina'>Quincenas nomina</label>";
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
            $contenidoModal .= "            <input id='valorPendiente' type='number' value='$valorPendiente' class='form-control' placeholder='Restante por recuperar'>";
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
        foreach ($listaEstado as $estado) {
            $idEstado = $estado['id'];
            $estado = $estado['estado'];

            $contenidoModal .= "                <option value='$idEstado'>$estado</option>";
        }
        $contenidoModal .= "            </select>";
        $contenidoModal .= "            <label for=''>Estado <b class='text-danger'>*</b></label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        //

        $contenidoModal .= "    <div class='d-grid mt-3'>";
        $contenidoModal .= "        <button class='btn btn-danger' id='btn-update-class' value='$id' onclick='actualizarIncapacidad(this)'>Actualizar</button>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "</div>";

        return $modal->modalAlerta("vinotinto", "Actualizar incapacidad", $contenidoModal);
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
    public function update(Request $request, $id, Modal $modal)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required',
            'fechaInicio' => 'required',
            'fechaFin' => 'required',
            'totalDias' => 'required',
            'diasEmpresa' => 'required',
            'diasEps' => 'required',
            'estado' => 'required',
        ]);
        if ($validator->fails()) {
            return $modal->modalAlertaReaload('vinotinto', 'Informacion', 'Los campos marcados con <b class="text-danger">*</b> son requeridos.');
        }

        $incapacidad = Incapacidad::find($id);
        $incapacidad->fkTipo = $request->tipo;
        $incapacidad->fechaInicio = $request->fechaInicio;
        $incapacidad->fechaFin = $request->fechaFin;
        $incapacidad->totalDias = $request->totalDias;
        $incapacidad->diasEmpresa = $request->diasEmpresa;
        $incapacidad->diasEps = $request->diasEps;
        $incapacidad->prorroga = $request->prorroga;
        $incapacidad->estado_id = $request->estado;
        if (!$incapacidad->update()) {
            return $modal->modalAlertaReaload('vinotinto', 'Informacion', 'La incapacidad no se puede actualizar.');
        }

        $incapacidadTranscrita = Incapacidad::where('id', $id)->get();
        if ($incapacidadTranscrita[0]['transcrita'] == "Si") {
            
            $transcripcion = Transcripcion::where('incapacidad_id', $id)->get();
            $transcripcion = Transcripcion::find($transcripcion[0]['id']);
            $transcripcion->fechaTranscripcion = $request->fechaTranscripcion;
            $transcripcion->numeroIncapacidad = $request->numeroIncapacidad;
            $transcripcion->fechaPago = $request->fechaPago;
            $transcripcion->quincenasNomina = $request->quincenasNomina;
            $transcripcion->valorRecuperado = $request->valorRecuperado;
            $transcripcion->valorPendiente = $request->valorPendiente;
            if (!$transcripcion->update()) {
                return $modal->modalAlertaReaload('vinotinto', 'Informacion', 'La incapacidad no se puede actualizar.');
            }
        }


        return $modal->modalAlertaReaload('vinotinto', 'Informacion', 'Incapacidad actualizada exitosamente.');
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
                return $modal->modalAlertaReaload("vinotinto", "Informaci&#243;n", "Incapacidad eliminada exitosamente.");
            }
        } catch (Exception $e) {
            return $modal->modalAlerta("vinotinto", "Informaci&#243;n", "La incapacidad no se puede eliminar por que tiene transcripciones asociados.");
        }
    }
}
