<?php

namespace App\Http\Controllers;

use App\Custom\Modal;
use App\Models\Incapacidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReporteIncapacidadController extends Controller
{
    public function index()
    {
        $totalRecuperado = Incapacidad::join('transcripciones', 'transcripciones.incapacidad_id', '=', 'incapacidades.id')
            ->sum('valorRecuperado');

        $totalPorRecuperar = Incapacidad::sum('valor_pendiente');

        $totalPorRecuperadoARL = Incapacidad::leftjoin('transcripciones', 'transcripciones.incapacidad_id', '=', 'incapacidades.id')
            ->select(DB::raw('SUM(valorRecuperado) as total'))
            ->where('fkTipo', '=', 2)
            ->where('estado_incapacidad_id', '=', 7)->get();

        $recuperadoPorEPS = Incapacidad::leftjoin('transcripciones', 'transcripciones.incapacidad_id', '=', 'incapacidades.id')
            ->select(DB::raw('SUM(valorRecuperado) as total'))
            ->where('fkTipo', '<>', 2)
            ->where('estado_incapacidad_id', '=', 7)->get();

        $acumuladoProrrogas = Incapacidad::where('acumulado_prorroga', '>=', 120)->where('acumulado_prorroga', '<', 180)->where('cartaProrroga', '<>', 1)->count();
        $acumuladoPensiones = Incapacidad::where('acumulado_prorroga', '>=', 180)->where('estado_incapacidad_id', '<>', 8)->count();

        $acumuladoTutelas = Incapacidad::whereRaw('TIMESTAMPDIFF(DAY, fechaInicio, CURDATE()) >= 90  AND tutela <> 1')->count();


        return view('reportesincapacidad.reportes', compact('totalRecuperado', 'totalPorRecuperar', 'totalPorRecuperadoARL', 'recuperadoPorEPS', 'acumuladoProrrogas', 'acumuladoTutelas', 'acumuladoPensiones'));
    }
    public function dona()
    {
        $reporteDona = Incapacidad::join('empleados', 'empleados.id', '=', 'incapacidades.empleado_id')
            ->select('empleados.eps', DB::raw('SUM(valor_pendiente) as total'))
            ->where('estado_incapacidad_id', '=', 1)
            ->groupBy('empleados.eps')->get();

        return $reporteDona;
    }

    public function donaCo()
    {
        $reporteDonaCo = Incapacidad::join('empleados', 'empleados.id', '=', 'incapacidades.empleado_id')
            ->join('co', 'co.id', '=', 'empleados.fkCo')
            ->select('co.nombre', DB::raw('count(empleados.fkCo) as total'))
            ->where('estado_incapacidad_id', '=', 1)
            ->groupBy('co.nombre')->get();

        return $reporteDonaCo;
    }
    public function linea()
    {
        $reporteLineaChart = Incapacidad::leftjoin('transcripciones', 'transcripciones.incapacidad_id', '=', 'incapacidades.id')
            ->select(DB::raw('MONTH(incapacidades.created_at) as mes'), DB::raw('SUM(transcripciones.valorRecuperado) AS valorRecuperado'), DB::raw('SUM(incapacidades.valor_pendiente) AS valor_pendiente'))
            ->groupBy('mes')->get();

        return $reporteLineaChart;
    }

    public function tableTutela(Modal $modal)
    {
        $acumuladoTutelas = Incapacidad::join('empleados', 'empleados.id', '=', 'incapacidades.empleado_id')
            ->join('co', 'co.id', '=', 'empleados.fkCo')
            ->join('companias', 'companias.id', '=', 'co.compania_id')
            ->select('incapacidades.*', 'empleados.nombre as empleado', 'empleados.eps', 'empleados.cedula', 'co.nombre as co', 'companias.nombre as compania')
            ->whereRaw('TIMESTAMPDIFF(DAY, fechaInicio, CURDATE()) >= 90 AND tutela <> 1')->take(10)->get();

        $contador = count($acumuladoTutelas->toArray());

        if ($contador == 0) {
            $mensaje = "<small class='m-3'><em>No hay alertas disponibles</em></small>";
            return $modal->modalReporte('latinco', 'fa-solid fa-gavel', 'Tutelas', $mensaje, 0);
        }

        $accordion = "<div class='accordion accordion-flush' id='accordionFlushExample'>";
        foreach ($acumuladoTutelas as  $tutela) {
            $accordion .= "     <div class='accordion-item'>";
            $accordion .= "         <h2 class='accordion-header' id='flush-heading$tutela->id'>";
            $accordion .= "             <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse-$tutela->id' aria-expanded='false' aria-controls='flush-collapse-$tutela->id'>";
            $accordion .= "             {$tutela->empleado}";
            $accordion .= "             </button>";
            $accordion .= "         </h2>";
            $accordion .= "         <div id='flush-collapse-$tutela->id' class='accordion-collapse collapse' aria-labelledby='flush-heading$tutela->id' data-bs-parent='#accordionFlushExample'>";
            $accordion .= "             <div class='accordion-body'>";
            $accordion .= "                 <ul class='list-group list-group-flush'>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Cedula</b>: {$tutela->cedula}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>EPS</b>: {$tutela->eps}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Compañía</b>: {$tutela->compania}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Co</b>: {$tutela->co}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Acción</b>:";
            $accordion .= "                     <button class='btn btn-danger btn-sm' value='$tutela->id' onclick='actualizarTutela(this)'>Eliminar</button>";
            $accordion .= "                     </li>";
            $accordion .= "                 </ul>";
            $accordion .= "             </div>";
            $accordion .= "         </div>";
            $accordion .= "     </div>";
        }
        $accordion .= "</div>";

        return $modal->modalReporte('latinco', 'fa-solid fa-gavel', 'Tutelas', $accordion, $contador);
    }
    public function tableProrroga(Modal $modal)
    {
        $acumuladoProrrogas = Incapacidad::join('empleados', 'empleados.id', '=', 'incapacidades.empleado_id')
            ->join('co', 'co.id', '=', 'empleados.fkCo')
            ->join('companias', 'companias.id', '=', 'co.compania_id')
            ->select('incapacidades.*', 'empleados.nombre as empleado', 'empleados.eps', 'empleados.cedula', 'co.nombre as co', 'companias.nombre as compania')
            ->where('acumulado_prorroga', '>=', 120)
            ->where('acumulado_prorroga', '<', 180)
            ->where('cartaProrroga', '<>', 1)->get();

        $contador = count($acumuladoProrrogas->toArray());

        if ($contador == 0) {
            $mensaje = "<small class='m-3'><em>No hay alertas disponibles</em></small>";
            return $modal->modalReporte('latinco', 'fa-solid fa-triangle-exclamation', 'Alerta', $mensaje, 0);
        }

        $accordion = "<div class='accordion accordion-flush' id='accordionFlushExample'>";
        foreach ($acumuladoProrrogas as  $incapacidad) {
            $accordion .= "     <div class='accordion-item'>";
            $accordion .= "         <h2 class='accordion-header' id='flush-heading$incapacidad->id'>";
            $accordion .= "             <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse-$incapacidad->id' aria-expanded='false' aria-controls='flush-collapse-$incapacidad->id'>";
            $accordion .= "             {$incapacidad->empleado}";
            $accordion .= "             </button>";
            $accordion .= "         </h2>";
            $accordion .= "         <div id='flush-collapse-$incapacidad->id' class='accordion-collapse collapse' aria-labelledby='flush-heading$incapacidad->id' data-bs-parent='#accordionFlushExample'>";
            $accordion .= "             <div class='accordion-body'>";
            $accordion .= "                 <ul class='list-group list-group-flush'>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Cedula</b>: {$incapacidad->cedula}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>EPS</b>: {$incapacidad->eps}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Compañía</b>: {$incapacidad->compania}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Co</b>: {$incapacidad->co}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Acción</b>:";
            $accordion .= "                     <button class='btn btn-danger btn-sm' value='$incapacidad->id' onclick='actualizarProrroga(this)'>Eliminar</button>";
            $accordion .= "                     </li>";
            $accordion .= "                 </ul>";
            $accordion .= "             </div>";
            $accordion .= "         </div>";
            $accordion .= "     </div>";
        }
        $accordion .= "</div>";
        return $modal->modalReporte('latinco', 'fa-solid fa-triangle-exclamation', 'Alerta', $accordion, $contador);
    }

    public function tablePensiones(Modal $modal)
    {
        $acumuladoProrrogas = Incapacidad::join('empleados', 'empleados.id', '=', 'incapacidades.empleado_id')
            ->join('co', 'co.id', '=', 'empleados.fkCo')
            ->join('companias', 'companias.id', '=', 'co.compania_id')
            ->select('incapacidades.*', 'empleados.nombre as empleado', 'empleados.eps', 'empleados.cedula', 'co.nombre as co', 'companias.nombre as compania')
            ->where('acumulado_prorroga', '>=', 180)
            ->where('estado_incapacidad_id', '<>', 8)->get();

        $contador = count($acumuladoProrrogas->toArray());

        if ($contador == 0) {
            $mensaje = "<small class='m-3'><em>No hay alertas disponibles</em></small>";
            return $modal->modalReporte('latinco', 'fa-solid fa-triangle-exclamation', 'Alerta', $mensaje, 0);
        }

        $accordion = "<div class='accordion accordion-flush' id='accordionFlushExample'>";
        foreach ($acumuladoProrrogas as  $incapacidad) {
            $accordion .= "     <div class='accordion-item'>";
            $accordion .= "         <h2 class='accordion-header' id='flush-heading$incapacidad->id'>";
            $accordion .= "             <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse-$incapacidad->id' aria-expanded='false' aria-controls='flush-collapse-$incapacidad->id'>";
            $accordion .= "             {$incapacidad->empleado}";
            $accordion .= "             </button>";
            $accordion .= "         </h2>";
            $accordion .= "         <div id='flush-collapse-$incapacidad->id' class='accordion-collapse collapse' aria-labelledby='flush-heading$incapacidad->id' data-bs-parent='#accordionFlushExample'>";
            $accordion .= "             <div class='accordion-body'>";
            $accordion .= "                 <ul class='list-group list-group-flush'>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Cedula</b>: {$incapacidad->cedula}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>EPS</b>: {$incapacidad->eps}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Compañía</b>: {$incapacidad->compania}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Co</b>: {$incapacidad->co}</li>";
            $accordion .= "                     <li class='list-group-item'><b class='text-latinco'>Acción</b>:";
            $accordion .= "                     <button class='btn btn-danger btn-sm' value='$incapacidad->id' onclick='actualizarFondo(this)'>Eliminar</button>";
            $accordion .= "                     </li>";
            $accordion .= "                 </ul>";
            $accordion .= "             </div>";
            $accordion .= "         </div>";
            $accordion .= "     </div>";
        }
        $accordion .= "</div>";
        return $modal->modalReporte('latinco', 'fa-solid fa-triangle-exclamation', 'Alerta', $accordion, $contador);
    }

    public function actualizarTutela(Request $request, Modal $modal, Incapacidad $incapacidad)
    {
        $incapacidad = Incapacidad::find($request->id);
        $incapacidad->tutela = 1;
        $incapacidad->update();
        return $modal->modalAlertaReaload('latinco', 'Informacion', "Incapacidad actualizada");
    }
    public function actualizarProrroga(Request $request, Modal $modal, Incapacidad $incapacidad)
    {
        $incapacidad = Incapacidad::find($request->id);
        $incapacidad->cartaProrroga = 1;
        $incapacidad->update();
        return $modal->modalAlertaReaload('latinco', 'Informacion', "Incapacidad actualizada");
    }
    public function actualizarFondo(Request $request, Modal $modal, Incapacidad $incapacidad)
    {
        $incapacidad = Incapacidad::find($request->id);
        $incapacidad->estado_incapacidad_id = 8;
        $incapacidad->update();
        return $modal->modalAlertaReaload('latinco', 'Informacion', "Incapacidad actualizada");
    }
}
