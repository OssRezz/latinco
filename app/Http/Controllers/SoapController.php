<?php

namespace App\Http\Controllers;

use App\Custom\Modal;
use App\Custom\SoapModel;
use Exception;
use Illuminate\Http\Request;
use SoapClient;

class SoapController extends Controller
{
    public function index()
    {
        return  view('soap.soap');
    }

    public function modalConexion(Modal $modal)
    {
        $contenidoModal =  "<div class='row g-3'>";
        $contenidoModal .= "    <div class='col-12'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='password' value='Conexion1' type='password' class='form-control' placeholder='Password'>";
        $contenidoModal .= "            <label for='password'>Password</label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "    <div class='d-grid mt-3'>";
        $contenidoModal .= "        <button class='btn btn-danger' data-bs-dismiss='modal' aria-label='Close' id='btn-update-class' value='' onclick='probarConexion()'>Probar conexion</button>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "</div>";

        return $modal->modalAlerta('latinco', 'Informacion', $contenidoModal);
    }

    public function modalConsulta(Modal $modal)
    {
        $contenidoModal =  "<div class='row g-3'>";
        $contenidoModal .= "    <div class='col-12'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='password' value='Conexion1' type='password' class='form-control' placeholder='Password'>";
        $contenidoModal .= "            <label for='password'>Password</label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "    <div class='d-grid mt-3'>";
        $contenidoModal .= "        <button class='btn btn-danger' data-bs-dismiss='modal' aria-label='Close' id='btn-update-class' value='' onclick='probarConsulta()'>Probar consulta</button>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "</div>";

        return $modal->modalAlerta('latinco', 'Informacion', $contenidoModal);
    }

    public function modalSchema(Modal $modal)
    {
        $contenidoModal =  "<div class='row g-3'>";
        $contenidoModal .= "    <div class='col-12'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='conexionModal' value='UnoEE_latinco_Real' type='text' class='form-control' placeholder='Conexion'>";
        $contenidoModal .= "            <label for='conexion'>Nombre conexión base de datos</label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "    <div class='col-12'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='proveedor' type='text'  value='SIESA' class='form-control' placeholder='Proveedor'>";
        $contenidoModal .= "            <label for='proveedor'>Proveedor </label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "    <div class='col-12'>";
        $contenidoModal .= "        <div class='form-floating'>";
        $contenidoModal .= "            <input  id='Schema' type='text' value='t350' class='form-control' placeholder='Schema'>";
        $contenidoModal .= "            <label for='Schema'>Schema </label>";
        $contenidoModal .= "        </div>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "    <div class='d-grid mt-3'>";
        $contenidoModal .= "        <button class='btn btn-danger' data-bs-dismiss='modal' aria-label='Close' id='btn-update-class' value='' onclick='probarSchema()'>Validar Schema</button>";
        $contenidoModal .= "    </div>";
        $contenidoModal .= "</div>";

        return $modal->modalAlerta('latinco', 'Informacion', $contenidoModal);
    }

    public function conexion(SoapModel $soap, Modal $modal, Request $request)
    {
        $nombreConexion = "UnoEE_latinco_Real";
        $tipoDB = "SQL";
        $nombreServidor = "siesa-prod-dbin-sql-serverweb-db05.cw4fp6bllyds.us-east-1.rds.amazonaws.com";
        $nombreBD = "UnoEE_latinco_Real";
        $usuarioDB = "latinco";
        $claveDB = $request->password;
        $numConexiones = "1";

        $uri = 'https://wslatinco.siesacloud.com:8043/wsunoee/WSUNOEE.asmx?wsdl';
        $param = ['pvstrxmlConexion' => $soap->conexion($nombreConexion, $tipoDB, $nombreBD, $nombreServidor, $usuarioDB, $claveDB, $numConexiones)];

        try {
            ///Instancionamos el objecto soapClient y ponemos la uri  $url
            $soapClient = new SoapClient($uri);
            ///Nombre de la accion (CrearConexionXML) y los parametros $param
            $response = $soapClient->CrearConexionXML($param);
            echo json_encode($response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }



    public function consulta(SoapModel $soap, Modal $modal, Request $request)
    {
        $uri = 'https://wslatinco.siesacloud.com:8043/wsunoee/WSUNOEE.asmx?wsdl';
        $password = $request->password;
        $paramConsulta = ['pvstrxmlParametros' => $soap->ConsultaWord($password)];

        try {
            $soapClient = new SoapClient($uri);
            // $response = $soapClient->CrearConexionXML($paramConexion);
            $response = $soapClient->EjecutarConsultaXML($paramConsulta);
            echo json_encode($response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function schema(SoapModel $soap, Modal $modal, Request $request)
    {
        $conexion =  $request->conexion;
        $proveedor =  $request->proveedor;
        $schema =  $request->schema;

        $uri = 'https://wslatinco.siesacloud.com:8043/wsunoee/WSUNOEE.asmx?wsdl';

        ///Modelo que contiene las consultas xml que enviamos como parametros
        $paramSchema = ["pvstrxmlParametros" => $soap->ConsultaSchema($conexion, $proveedor, $schema)];


        try {

            $soapClient = new SoapClient($uri);
            $response = $soapClient->LeerEsquemaParametros($paramSchema);

            echo json_encode($response);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
