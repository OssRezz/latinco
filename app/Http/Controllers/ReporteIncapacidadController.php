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

        $acumuladoProrrogas = Incapacidad::where('acumulado_prorroga', '>=', 120)->count();

        $acumuladoTutelas = Incapacidad::whereRaw('TIMESTAMPDIFF(DAY, fechaInicio, CURDATE()) >= 90')->count();


        return view('reportesincapacidad.reportes', compact('totalRecuperado', 'totalPorRecuperar', 'totalPorRecuperadoARL', 'recuperadoPorEPS', 'acumuladoProrrogas', 'acumuladoTutelas'));
    }
    public function dona()
    {
        $reporteDona = Incapacidad::join('empleados', 'empleados.id', '=', 'incapacidades.empleado_id')
            ->select('empleados.eps', DB::raw('SUM(valor_pendiente) as total'))
            ->where('estado_incapacidad_id', '=', 1)
            ->groupBy('empleados.eps')->get();

        return $reporteDona;
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
        $acumuladoTutelas = Incapacidad::with('Empleado')
            ->whereRaw('TIMESTAMPDIFF(DAY, fechaInicio, CURDATE()) >= 90')->get();


        $table = "<div class='table-responsive'>";
        $table .=   "<table class='table table-bordered nowrap table-hover table-sm'>";
        $table .=       "<thead>";
        $table .=           "<tr>";
        $table .=               "<th>Nombre</th>";
        $table .=               "<th>Cedula</th>";
        $table .=               "<th>Salario</th>";
        $table .=           "</tr>";
        $table .=       "</thead>";
        $table .=       "<tbody>";
        foreach ($acumuladoTutelas as  $tutela) {
            $table .=           "<tr>";
            $table .=               "<td>{$tutela->empleado->nombre}</td>";
            $table .=               "<td>{$tutela->empleado->cedula}</td>";
            $table .=               "<td>{$tutela->empleado->salario}</td>";
            $table .=           "</tr>";
        }

        $table .=       "</tbody>";
        $table .=   "</table>";
        $table .= "</div>";
        return $modal->modalAlerta('latinco', 'Tutela', $table);
    }
    public function tableProrroga(Modal $modal)
    {
        $acumuladoProrrogas = Incapacidad::where('acumulado_prorroga', '>=', 120)->get();



        $table = "<div class='table-responsive'>";
        $table .=   "<table class='table table-bordered nowrap table-hover table-sm'>";
        $table .=       "<thead>";
        $table .=           "<tr>";
        $table .=               "<th>Nombre</th>";
        $table .=               "<th>Cedula</th>";
        $table .=               "<th>Salario</th>";
        $table .=           "</tr>";
        $table .=       "</thead>";
        $table .=       "<tbody>";
        foreach ($acumuladoProrrogas as  $prorroga) {
            $table .=           "<tr>";
            $table .=               "<td>{$prorroga->empleado->nombre}</td>";
            $table .=               "<td>{$prorroga->empleado->cedula}</td>";
            $table .=               "<td>{$prorroga->empleado->salario}</td>";
            $table .=           "</tr>";
        }

        $table .=       "</tbody>";
        $table .=   "</table>";
        $table .= "</div>";
        return $modal->modalAlerta('latinco', 'Tutela', $table);
    }
}
