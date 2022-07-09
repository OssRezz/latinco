<?php

namespace App\Http\Controllers;

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
            ->where('estado_id', '=', 7)->get();

        $recuperadoPorEPS = Incapacidad::leftjoin('transcripciones', 'transcripciones.incapacidad_id', '=', 'incapacidades.id')
            ->select(DB::raw('SUM(valorRecuperado) as total'))
            ->where('fkTipo', '<>', 2)
            ->where('estado_id', '=', 7)->get();

        return view('reportesincapacidad.reportes', compact('totalRecuperado', 'totalPorRecuperar', 'totalPorRecuperadoARL', 'recuperadoPorEPS'));
    }
    public function dona()
    {
        $recuperadoPorEPS = Incapacidad::join('empleados', 'empleados.id', '=', 'incapacidades.fkEmpleado')
            ->select('empleados.eps', DB::raw('SUM(valor_pendiente) as total'))
            ->where('estado_id', '=', 1)
            ->groupBy('empleados.eps')->get();

        return $recuperadoPorEPS;
    }
    public function linea()
    {
        $recuperadoPorEPS = Incapacidad::leftjoin('transcripciones', 'transcripciones.incapacidad_id', '=', 'incapacidades.id')
            ->select(DB::raw('MONTH(incapacidades.created_at) as mes'), DB::raw('SUM(transcripciones.valorRecuperado) AS valorRecuperado'), DB::raw('SUM(incapacidades.valor_pendiente) AS valor_pendiente'))
            ->groupBy('mes')->get();

        return $recuperadoPorEPS;
    }
}
