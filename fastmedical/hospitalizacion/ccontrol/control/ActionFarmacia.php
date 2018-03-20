<?php

require_once("../../clogica/LFarmacia.php");
require_once("../../../pholivo/tablaDHTMLX.php");

class ActionFarmacia {

    public function __construct() {
        
    }

    public function mostrarTablaControlInternoFarmaciaSOP($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLFarmacia = new LFarmacia();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $oLFarmacia->getListaControlInternoFarmaciaSOP($datos);
        $arrayCabecera = array("0" => "Id", "1" => "Código Producto", "2" => "Nombre Producto", "3" => "Stock", "4" => "Cantidad Entregados", "5" => "Adicionar/ Quitar", "6" => "Nueva Cantidad", "7" => "...");
        $arrayTamano = array("0" => "50", "1" => "100", "2" => "*", "3" => "50", "4" => "100", "5" => "65", "6" => "60", "7" => "40");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ed", "6" => "ro[=c4*c5]", "7" => "img");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "left", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false", "7" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function mostrarTablaPaquetesFarmaceuticosCISOP() {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLFarmacia = new LFarmacia();
        $arrayFilas = $oLFarmacia->getListaPaquetesFarmaceuticosCISOP();
        $arrayCabecera = array("0" => "Código Producto", "1" => "Nombre Producto");
        $arrayTamano = array("0" => "150", "1" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "left");
        $arrayHidden = array("0" => "false", "1" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function cargarPaqueteMedicamentosalPacienteFarmaciaCISOP($datos) {
        $oLFarmacia = new LFarmacia();
        $resultado = $oLFarmacia->asignarPaqueteMedicamentosalPacienteFarmaciaCISOP($datos);
        return $resultado;
    }

    public function cargarProductoalPacienteFarmaciaCISOP($datos) {
        $oLFarmacia = new LFarmacia();
        $resultado = $oLFarmacia->asignarProductoalPacienteFarmaciaCISOP($datos);
        return $resultado;
    }

    public function eliminarProductoalPacienteCISOP($datos) {
        $oLFarmacia = new LFarmacia();
        $resultado = $oLFarmacia->eliminarProductoalPacienteCISOP($datos);
        return $resultado;
    }

    public function mostrarDatosdelPaqueteAsignadoFarmaciaSOP($datos) {
        $oLFarmacia = new LFarmacia();
        $resultado = $oLFarmacia->obtenerDatosdelPaqueteAsignadoFarmaciaSOP($datos);
        return $resultado;
    }

    public function actualizarNuevasCantidadesEntregadasCISOP($datos) {
        $oLFarmacia = new LFarmacia();
        $resultado = $oLFarmacia->actualizarNuevasCantidadesEntregadasCISOP($datos);
        return $resultado;        
    }

    public function mostrarTablaNuevosProductosCISOP($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLFarmacia = new LFarmacia();
        $arrayFilas = $oLFarmacia->getListaNuevosProductosCISOP($datos);
        $arrayCabecera = array("0" => "Código Producto", "1" => "Nombre Producto", "2" => "Stock");
        $arrayTamano = array("0" => "100", "1" => "*", "2" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "left", "2" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false");
        $arraySorting = array("0" => "str", "1" => "str", "2" => "int");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden, $arraySorting);
    }
    public function ObtenerDatosPacienteCISOP($datos){
        $oLFarmacia = new LFarmacia();
        $resultado = $oLFarmacia->ObtenerDatosPacienteCISOP($datos);
        return $resultado;        
    }    
    public function generarOrdenCuentaCorrienteFarmaciaCISOP($datos){
        $oLFarmacia = new LFarmacia();
        $resultado = $oLFarmacia->generarOrdenCuentaCorrienteFarmaciaCISOP($datos);
        return $resultado;         
    }
}

?>
