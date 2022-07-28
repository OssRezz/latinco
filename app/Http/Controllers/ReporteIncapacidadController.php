<?php

namespace App\Http\Controllers;

use App\Custom\Modal;
use App\Exports\IncapacidadExport;
use App\Models\Compania;
use App\Models\Incapacidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReporteIncapacidadController extends Controller
{
    public function index()
    {
        $compania = Compania::all();
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


        return view('reportesincapacidad.reportes', compact('compania', 'totalRecuperado', 'totalPorRecuperar', 'totalPorRecuperadoARL', 'recuperadoPorEPS', 'acumuladoProrrogas', 'acumuladoTutelas', 'acumuladoPensiones'));
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

    //-> Inicio tutela
    public function tableTutela(Modal $modal)
    {
        $acumuladoTutelas = Incapacidad::join('empleados', 'empleados.id', '=', 'incapacidades.empleado_id')
            ->join('co', 'co.id', '=', 'empleados.fkCo')
            ->join('companias', 'companias.id', '=', 'co.compania_id')
            ->select('incapacidades.*', 'empleados.nombre as empleado', 'empleados.eps', 'empleados.cedula', 'co.nombre as co', 'companias.nombre as compania')
            ->whereRaw('TIMESTAMPDIFF(DAY, fechaInicio, CURDATE()) >= 90 AND tutela <> 1')->get();

        $headersArray = ['Nombre', 'Cedula', 'EPS', 'Compañía', 'Co', 'Estado', 'Acción'];
        $header = '';
        $body = '';
        //Header table
        foreach ($headersArray as $key => $headerItem) {
            $header .=                "<th class='text-center'>$headerItem</th>";
        }
        foreach ($acumuladoTutelas as $key => $tutela) {
            $body .=            '<tr>';
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->empleado}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->cedula}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->eps}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->compania}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-primary'>{$tutela->co}</span></td>";
            $body .=                "<td class='text-center'>";
            if ($tutela->estadoTutela == 1) {
                $check = 'checked';
            } else {
                $check = '';
            }
            $body .=                    "<div class='form-check form-switch d-md-flex justify-content-md-center'><input class='form-check-input' type='checkbox' onclick='actualizarEstadoTutela(this)' value='$tutela->id' $check></div>";
            $body .=                "</td>";
            $body .=                "<td class='text-center'><button class='btn btn-danger btn-sm' value='$tutela->id' onclick='actualizarTutela(this)'>Eliminar</button></td>";
            $body .=            '</tr>';
        }

        return $modal->modalTable('fa-solid fa-gavel', 'Tutelas', $header, $body);
    }

    public function actualizarTutela(Request $request, Modal $modal, Incapacidad $incapacidad)
    {
        $incapacidad = Incapacidad::find($request->id);
        $incapacidad->tutela = 1;
        $incapacidad->update();
        return $modal->modalAlertaReaload('latinco', 'Informacion', "Incapacidad actualizada");
    }

    public function actualizarEstadoTutela(Request $request, Modal $modal, Incapacidad $incapacidad)
    {
        $estadoActual = Incapacidad::where('id', $request->id)->get();
        if ($estadoActual[0]['estadoTutela'] == 1) {
            $estado = 0;
        } else {
            $estado = 1;
        }
        $incapacidad = Incapacidad::find($request->id);
        $incapacidad->estadoTutela = $estado;
        $incapacidad->update();
    }
    //->Fin tutela



    //-> Inicio Prorroga
    public function tableProrroga(Modal $modal)
    {
        $acumuladoProrrogas = Incapacidad::join('empleados', 'empleados.id', '=', 'incapacidades.empleado_id')
            ->join('co', 'co.id', '=', 'empleados.fkCo')
            ->join('companias', 'companias.id', '=', 'co.compania_id')
            ->select('incapacidades.*', 'empleados.nombre as empleado', 'empleados.eps', 'empleados.cedula', 'co.nombre as co', 'companias.nombre as compania')
            ->where('acumulado_prorroga', '>=', 120)
            ->where('acumulado_prorroga', '<', 180)
            ->where('cartaProrroga', '<>', 1)->get();

        $headersArray = ['Nombre', 'Cedula', 'EPS', 'Compañía', 'Co', 'Estado', 'Acción'];
        $header = '';
        $body = '';
        //Header table
        foreach ($headersArray as $key => $headerItem) {
            $header .=                "<th class='text-center'>$headerItem</th>";
        }
        foreach ($acumuladoProrrogas as $key => $tutela) {
            $body .=            '<tr>';
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->empleado}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->cedula}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->eps}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->compania}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->co}</span></td>";
            $body .=                "<td class='text-center'>";
            if ($tutela->estadoCartaProrroga == 1) {
                $check = 'checked';
            } else {
                $check = '';
            }
            $body .=                    "<div class='form-check form-switch d-md-flex justify-content-md-center'><input class='form-check-input' type='checkbox' onclick='actualizarEstadoProrroga(this)' value='$tutela->id' $check></div>";
            $body .=                "</td>";
            $body .=                "<td class='text-center'><button class='btn btn-danger btn-sm' value='$tutela->id' onclick='actualizarTutela(this)'>Eliminar</button></td>";
            $body .=            '</tr>';
        }

        return $modal->modalTable('fa-solid fa-triangle-exclamation', 'Alerta carta prorroga', $header, $body);
    }

    public function actualizarProrroga(Request $request, Modal $modal, Incapacidad $incapacidad)
    {
        $incapacidad = Incapacidad::find($request->id);
        $incapacidad->cartaProrroga = 1;
        $incapacidad->update();
        return $modal->modalAlertaReaload('latinco', 'Informacion', "Incapacidad actualizada");
    }

    public function actualizarEstadoProrroga(Request $request, Modal $modal, Incapacidad $incapacidad)
    {
        $estadoActual = Incapacidad::where('id', $request->id)->get();
        if ($estadoActual[0]['estadoCartaProrroga'] == 1) {
            $estado = 0;
        } else {
            $estado = 1;
        }
        $incapacidad = Incapacidad::find($request->id);
        $incapacidad->estadoCartaProrroga = $estado;
        $incapacidad->update();
    }
    //-> Fin Prorroga



    //->Inicio Fondo pensiones
    public function tablePensiones(Modal $modal)
    {
        $acumuladoProrrogas = Incapacidad::join('empleados', 'empleados.id', '=', 'incapacidades.empleado_id')
            ->join('co', 'co.id', '=', 'empleados.fkCo')
            ->join('companias', 'companias.id', '=', 'co.compania_id')
            ->select('incapacidades.*', 'empleados.nombre as empleado', 'empleados.eps', 'empleados.cedula', 'co.nombre as co', 'companias.nombre as compania')
            ->where('acumulado_prorroga', '>=', 180)
            ->where('estado_incapacidad_id', '<>', 8)->get();

        $headersArray = ['Nombre', 'Cedula', 'EPS', 'Compañía', 'Co', 'Estado', 'Acción'];
        $header = '';
        $body = '';
        //Header table
        foreach ($headersArray as $key => $headerItem) {
            $header .=                "<th class='text-center'>$headerItem</th>";
        }
        foreach ($acumuladoProrrogas as $key => $tutela) {
            $body .=            '<tr>';
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->empleado}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->cedula}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->eps}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$tutela->compania}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-primary'>{$tutela->co}</span></td>";
            $body .=                "<td class='text-center'>";
            if ($tutela->estadoFondoPension == 1) {
                $check = 'checked';
            } else {
                $check = '';
            }
            $body .=                    "<div class='form-check form-switch d-md-flex justify-content-md-center'><input class='form-check-input' type='checkbox' onclick='actualizarEstadoFondo(this)' value='$tutela->id' $check></div>";
            $body .=                "</td>";
            $body .=                "<td class='text-center'><button class='btn btn-danger btn-sm' value='$tutela->id' onclick='actualizarTutela(this)'>Eliminar</button></td>";
            $body .=            '</tr>';
        }
        return $modal->modalTable('fa-solid fa-triangle-exclamation', 'Alerta fondo pensiones', $header, $body);
    }

    public function actualizarFondo(Request $request, Modal $modal, Incapacidad $incapacidad)
    {
        $incapacidad = Incapacidad::find($request->id);
        $incapacidad->estado_incapacidad_id = 8;
        $incapacidad->update();
        return $modal->modalAlertaReaload('latinco', 'Informacion', "Incapacidad actualizada");
    }
    public function actualizarFondoPension(Request $request, Modal $modal, Incapacidad $incapacidad)
    {
        $estadoActual = Incapacidad::where('id', $request->id)->get();
        if ($estadoActual[0]['estadoFondoPension'] == 1) {
            $estado = 0;
        } else {
            $estado = 1;
        }
        $incapacidad = Incapacidad::find($request->id);
        $incapacidad->estadoFondoPension = $estado;
        $incapacidad->update();
    }
    //->Inicio Fondo pensiones



    // Reporte excel
    public function export(Request $request)
    {
        $validated = $request->validate([
            'fechaInicio' => 'required||date',
            'fechaFin' => 'required|date',
            'compania' => 'required',
        ]);
        DB::statement("SET SQL_MODE=''");
        $export = new IncapacidadExport([

            Incapacidad::leftjoin('transcripciones', 'transcripciones.incapacidad_id', 'incapacidades.id')
                ->join('estado_incapacidades', 'estado_incapacidades.id', 'incapacidades.estado_incapacidad_id')
                ->join('empleados', 'empleados.id', 'incapacidades.empleado_id')
                ->join('co', 'co.id', 'empleados.fkCo')
                ->join('companias', 'companias.id', 'co.compania_id')
                ->select('companias.nombre', 'estado_incapacidades.estado', 'incapacidades.valor_pendiente', 'transcripciones.valorRecuperado')
                ->groupBy('nombre', 'estado')
                ->whereBetween('incapacidades.fechaInicio', [$request->fechaInicio, $request->fechaFin])
                ->where('companias.id', $request->compania)->get()
        ]);

        return Excel::download($export, 'incapacidad.xlsx');
    }
}
