<?php

namespace App\Http\Controllers;

use App\Custom\Modal;
use App\Models\Diagnostico;
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
        $diagnosticos = Diagnostico::all();
        $listaTipoIncapacidad = TipoIncapacidad::all();
        return view('incapacidad.incapacidad', compact('listaTipoIncapacidad', 'diagnosticos'));
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
            'quincena_nominas' => 'required',
        ]);

        if ($validator->fails()) {
            return ["modal" => $modal->modalAlerta('vinotinto', 'Informacion', 'Todos los campos son requeridos.'), "status" => 404];
        }

        $empleado = Empleado::where('cedula', $request->cedula)->take(1)->get();
        $acumulado = $request->totalDias;
        $incapacidad_prorroga = null;

        if ($request->prorroga == "Si") {
            //Recibiamos un string 2922920282-1, El primero numero es el numero de la incapacidad, el segundo el id de la incapacidad que prorroga
            $arreglo_incapacidad = preg_split("/\-/",  $request->incapacidad_prorroga);

            //Si el arreglo no tiene 2 objetos retornos que no tiene el formato adecuado
            if (count($arreglo_incapacidad) <> 2) {
                return ["modal" => $modal->modalAlerta('vinotinto', 'Informacion', 'El numero de la prorroga no tiene el formato admitido'), "status" => 404];
            }

            $incapacidadFecha = Incapacidad::where('id', $arreglo_incapacidad[1])->get();
            //Si la cantidad del arreglo de cantidad de fecha es igual 0, significa que no existe el dato
            if (count($incapacidadFecha) == 0) {
                return ["modal" => $modal->modalAlerta('vinotinto', 'Informacion', 'No existe una incapacidad con este numero de identificacion'), "status" => 404];
            }

            $fechaFinIncapacidad = new DateTime($incapacidadFecha[0]['fechaFin']);
            $fechaInicioIncapacidad = new DateTime($request->fechaInicio);
            $intvl = $fechaFinIncapacidad->diff($fechaInicioIncapacidad);
            $reultado = $intvl->format('%r%a');

            //Si la diferencia de fecha es menor a 0 o igual, o mayor  a 30 retornamos que la incapacidad no se puede prorrogar por dias
            if ($reultado <  0 || $reultado ==  0 || $reultado > 30) {
                return ["modal" => $modal->modalAlerta('vinotinto', 'Informacion', '¡Esta incapacidad no se puede prorrogar! <br> Fecha final de la incapacidad que prorroga: ' . $incapacidadFecha[0]['fechaFin'] . '<br> Fecha inicial de la incapacidad: ' . $request->fechaInicio . '<br> Diferencia de dias: ' . $reultado), "status" => 404];
            }


            $prorrogaIncapacidad = Incapacidad::where('empleado_id', $empleado[0]['id'])
                ->where('numero_incapacidad', $arreglo_incapacidad[0])
                ->where('prorroga', "No")->take(1)->get();

            //Si la cantidad del arreglo de prroroga es 0, retornamos que no existe la prorroga
            if (count($prorrogaIncapacidad) == 0) {
                return ["modal" => $modal->modalAlerta('vinotinto', 'Informacion', 'No existe una prorroga con este numero de incapacidad'), "status" => 404];
            }
            $acumulado = 0;
            $incapacidad_prorroga = $arreglo_incapacidad[0];

            $total = $prorrogaIncapacidad[0]['acumulado_prorroga'] + $request->totalDias;
            $prorrogaIncapacidad = Incapacidad::find($prorrogaIncapacidad[0]['id']);
            $prorrogaIncapacidad->acumulado_prorroga = $total;
            //Actualizamos el valor de la prorroga inicial, para conocer cuantos dias van desde que inicio la prorroga
            $prorrogaIncapacidad->update();
        }


        if ($request->tipoIncapacidad == 1) {
            $valorPorRecuperar = number_format((($empleado[0]['salario'] / 30) * $request->diasMedio) * 0.6667);
        } else {
            $valorPorRecuperar = number_format(($empleado[0]['salario'] / 30) * $request->diasMedio);
        }

        //Id empleado
        $numero_incapacidad = date('Ymdhis');
        $incapacidad->numero_incapacidad = $numero_incapacidad;               //Empleado
        $incapacidad->empleado_id = $empleado[0]['id'];                 //Empleado
        $incapacidad->fkTipo = $request->tipoIncapacidad;               //Enfermedad general...
        $incapacidad->fechaInicio = $request->fechaInicio;              //Fecha inicial
        $incapacidad->fechaFin = $request->fechaFinal;                  //Fecha final
        $incapacidad->totalDias = $request->totalDias;                  //Total dias
        $incapacidad->diasEmpresa = $request->diasEmpresa;                  //Dias empresa
        $incapacidad->diasEps = $request->diasMedio;                        //Dias entidad 
        $incapacidad->prorroga = $request->prorroga;                       //Si - No
        $incapacidad->numero_incapacidadEntidad = $request->numero_incapacidad;    //Medio EPS, ARL
        $incapacidad->incapacidad_prorroga = $incapacidad_prorroga;    //Incapacidad de la que prorroga...
        $incapacidad->acumulado_prorroga = $acumulado;                          //Dias de prorroga...
        $incapacidad->quincenas_nomina = $request->quincena_nominas;            //Quincena de la nomina...
        $incapacidad->observacion_id = 1;                                       //
        $incapacidad->transcrita = "No";                                        //
        $incapacidad->tutela = 0;                                               //
        $incapacidad->cartaProrroga = 0;                                        //
        $incapacidad->estado_incapacidad_id = 1;                                //
        $incapacidad->diagnostico_id = $request->diagnostico;                   //
        $incapacidad->valor_pendiente = intval(str_replace(',', '', $valorPorRecuperar));       //

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

    public function modalHistorial(Request $request, Modal $modal)
    {
        $empleado = Empleado::where('cedula', $request->cedula)->get();
        $listaIncapacidad = Incapacidad::join('diagnosticos', 'diagnosticos.id', '=', 'incapacidades.diagnostico_id')
            ->join('estado_incapacidades', 'estado_incapacidades.id', '=', 'incapacidades.estado_incapacidad_id')
            ->join('tipo_incapacidades', 'tipo_incapacidades.id', '=', 'incapacidades.fkTipo')
            ->select('incapacidades.incapacidad_prorroga', 'incapacidades.numero_incapacidad', 'incapacidades.id', 'incapacidades.fechaInicio', 'incapacidades.fechaFin', 'incapacidades.prorroga', 'tipo_incapacidades.tipo', 'estado_incapacidades.estado', 'diagnosticos.diagnostico')
            ->where('empleado_id', $empleado[0]['id'])
            ->orderBy('incapacidades.id')->get();


        $headersArray = ['Numero Incapacidad', 'Fecha inicio', 'Fecha fin', 'Prorroga', 'Tipo', 'Diagnostico', 'Estado', 'Accion'];
        $header = '';
        $body = '';
        //Header table
        foreach ($headersArray as $key => $headerItem) {
            $header .=                "<th class='text-center'>$headerItem</th>";
        }

        //Body table
        foreach ($listaIncapacidad as $key => $value) {
            if ($value['prorroga'] == 'Si') {
                $numero_incapacidad = $value['incapacidad_prorroga'];
                $prorroga = "<td class='text-center'><span class='badge bg-dark'>{$value['prorroga']}</span></td>";
            } else {
                $numero_incapacidad = $value['numero_incapacidad'];
                $prorroga = "<td class='text-center'>{$value['prorroga']}</td>";
            }
            $arrayProrroga = json_encode(['id_prroroga' => $id_prroroga = $value['id'], 'numero_incapacidad' => $numero_incapacidad]);
            $body .=            '<tr>';
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$numero_incapacidad}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$value['fechaInicio']}</span></td>";
            $body .=                "<td class='text-center'><span class='badge bg-white text-dark'>{$value['fechaFin']}</span></td>";
            $body .= $prorroga;
            $body .=                "<td class='text-center'><span class='badge bg-primary'>{$value['tipo']}</span></td>";
            $body .=                "<td class='text-center'>{$value['diagnostico']}</td>";
            $body .=                "<td class='text-center'><span class='badge bg-dark'>{$value['estado']}</span></td>";
            $body .=                "<td class='text-center'><button class='btn btn-outline-primary border-0 btn-sm' value='$arrayProrroga' onclick='copyToClickBoard(this);'>Copiar</button></td>";
            $body .=            '</tr>';
        }

        return $modal->modalTable('fa-solid fa-file-medical', 'Historial: ' .  $empleado[0]['nombre'], $header, $body);
    }
}
