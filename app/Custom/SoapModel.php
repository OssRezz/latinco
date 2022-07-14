<?php

namespace App\Custom;

class SoapModel
{
    public function conexion($nombreConexion, $tipoDB, $nombreDB, $nombreServidor, $usuarioDB, $password, $numConexiones)
    {
        $xml = "<?xml version='1.0' encoding='utf-8'?>";
        $xml .= "<Conexion>";
        $xml .= "    <NombreConexion>$nombreConexion</NombreConexion>";
        $xml .= "    <TipoBD>$tipoDB</TipoBD>";
        $xml .= "    <NombreBD>$nombreDB</NombreBD>";
        $xml .= "    <NombreServidorBD>$nombreServidor</NombreServidorBD>";
        $xml .= "    <UsuarioBD>$usuarioDB</UsuarioBD>";
        $xml .= "    <ClaveBD>$password</ClaveBD>";
        $xml .= "    <NumConexionImpo>$numConexiones</NumConexionImpo>";
        $xml .= "</Conexion>";

        return $xml;
    }
    public function ConsultaWord($password)
    {
        $xml = "<?xml version='1.0' encoding='utf-8'?>";
        $xml .= "<Consulta>";
        $xml .= "  <NombreConexion>UnoEE_latinco_Real</NombreConexion>";
        $xml .= "  <IdCia>1</IdCia>";
        $xml .= "  <IdProveedor>GENERICA_ITEMS</IdProveedor>";
        $xml .= "  <IdConsulta>ITEMS</IdConsulta>";
        $xml .= "  <Usuario>latinco</Usuario>";
        $xml .= "  <Clave>$password</Clave>";
        $xml .= "    <Parametros>";
        $xml .= "        <p_id_cia>1</p_id_cia>";
        $xml .= "        <p_fecha_adic_mod>2012-08-01</p_fecha_adic_mod>";
        $xml .= "    </Parametros>";
        $xml .= "</Consulta>";
        return $xml;
    }
    function ConsultaSchema($conexion, $proveedor, $schema)
    {
        $xml = "<?xml version='1.0' encoding='utf-8'?>";
        $xml .=  "<Consulta>";
        $xml .=  "  <NombreConexion>$conexion</NombreConexion>";
        $xml .=  "  <IdProveedor>$proveedor</IdProveedor>";
        $xml .=  "  <IdConsulta>$schema</IdConsulta>";
        $xml .=  "</Consulta>";

        return $xml;
    }
}
