<?php

require_once("../../../pholivo/Html.php");
require_once("../../clogica/LTesoreria.php");
require_once("../../clogica/LPersona.php");
require_once("../../../pholivo/Html1.php");

class ActionTesoreria {

    public function __construct() {
        
    }

    public function obtenerPersonas($patron, $parametro) {
        $o_LTesoreria = new LTesoreria();
        $arrayFilas = $o_LTesoreria->getArrayPersonaOrden($patron, $parametro);
        //echo "<input id='codigoOculto'  type='text' value='".$arrayFilas[0][0]."' /> ";

        $arrayCabecera = array('0' => "CODIGO", "1" => "NOMBRE");
        $o_Tabla = new Tabla1($arrayCabecera, 10, $arrayFilas, 'tablaOrden', 'fila1', 'fila2', 'filaSeleccionada', 'OnClick', 'setOrdenesPersona', '0');
        $tablaHTML = $o_Tabla->getTabla();

        return $tablaHTML;
    }

    public function comboTipoDocumento($optionsHTML) {
        $o_LTesoreria = new LTesoreria();
        $arrayCombo = $o_LTesoreria->tipoDocumento();
        //print_r($arrayCombo);
        $o_Combo = new Combo($arrayCombo);
        $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);

        return $comboHTML;
    }

    public function detalleOrden($codigo, $parametro) {
        $o_LTesoreria = new LTesoreria();
        $o_LPersona = new LPersona();
        $combo = $this->comboTipoDocumento('1');

        $arrayDatos = $o_LTesoreria->datosPersonales($codigo, $parametro);
        //$codigo='';
        $nombre = '';
        $fechaNacimiento = '';
        $edad = '';
        $documento = '';
        $filiacion = '';
        //print_r($arrayDatos);
        foreach ($arrayDatos as $fila) {
            //$codigo=$fila[0];
            $nombre = utf8_encode($fila[4] . " " . $fila[5] . ", " . $fila[6]);
            $fechaNacimiento = $fila[7];
            $documento = $fila[0];
            $filiacion = $fila[3];
        }

        //date_default_timezone_set('Europe/London');

        if($fechaNacimiento=="sindata"){
            $edad='';
        }else{
            $datetime = date_create($fechaNacimiento);
        $fechaNacimiento = date_format($datetime, 'm/d/Y');

        $edad = $o_LPersona->formatoEdad($fechaNacimiento);
        }
        
        //creando la tabla
        $arrayFilas = $o_LTesoreria->obtenerOrdenes($codigo, $parametro);
       // print_r($arrayFilas);
        $arrayTipo = array("10" => "h", "0" => "c", "1" => "c", "2" => "c", "11" => "h", "3" => "c", "13" => "h", "4" => "c", "5" => "c", "6" => "c", "12" => "c","7" => "c","14" => "h");
        $arraycabecera = array("10" => " ", "0" => "Nro Orden", "1" => "Fecha", "2" => "Filiación", "11" => " ", "3" => "concepto", "13" => "Nro Comp.", "4" => "Precio", "5" => "Cant.", "6" => "Total", "12" => "....","7" => "es","14" => "x");

        $arrayColorEstado = array("1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", "7" => "7", "8" => "8", "9" => "9");


        $o_Html = new Tabla1($arraycabecera, 15, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', '', 5, $arrayTipo, 7, $arrayColorEstado);
        require_once("../../cvista/tesoreria/detalleOrden.php");
    }

}

?>