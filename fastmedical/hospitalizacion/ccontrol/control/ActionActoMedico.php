<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("../../clogica/LActoMedico.php");
require_once("../../clogica/LLogistica.php");
require_once("../../../pholivo/tablaDHTMLX.php");
require_once("../../../pholivo/Html.php");
require_once('../../ccontrol/control/ActionReporte.php');

class ActionActoMedico {

    private $cadenaArbolExamenMedico;

    public function __construct() {
        
    }

    /*     * *****************************ACTO MEDICO******************************** */

    function mostrarProgramacionMedico($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $oLActoMedico->getListaProgramacionMedico($datos);
        $arrayCabecera = array("0" => "Id", "1" => "DIA", "2" => "TURNO", "3" => "ACTIVIDAD", "4" => "SERVICIO", "5" => "AMB.LOG.", "6" => "AMB.FIS.", "7" => "CUPOS", "8" => "ADIC.");
        $arrayTamano = array("0" => "50", "1" => "50", "2" => "90", "3" => "100", "4" => "100", "5" => "*", "6" => "60", "7" => "60", "8" => "60");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "center", "3" => "left", "4" => "left", "5" => "left", "6" => "center", "7" => "center", "8" => "center");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false", "7" => "false", "8" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    function tablaLaboratorioHc($codPersona) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->tablaLaboratorioHc($codPersona);
        $arrayCabecera = array("0" => "ID", "1" => "Fecha", "2" => "Servicio", "3" => "CodPer", "4" => "Sistema", "5" => "IdResulWeb", "6" => "IdResulFox", "7" => "Medico");
        $arrayTamano = array("0" => "100", "1" => "100", "2" => "*", "3" => "*", "4" => "*", "5" => "*", "6" => "*", "7" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "center", "3" => "center", "4" => "center", "5" => "center", "6" => "center", "7" => "center");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", "3" => "true", "4" => "true", "5" => "true", "6" => "true", "7" => "false");

        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    function DetalletablaLaboratorioHc($IdResult) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->DetalletablaLaboratorioHc($IdResult);
        $arrayCabecera = array("0" => "Descripcion", "1" => "Resultado", "2" => "Unidad", "3" => "Rango");
        $arrayTamano = array("0" => "160", "1" => "60", "2" => "60", "3" => "*");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro");
        $arrayAlineacion = array("0" => "left", "1" => "left", "2" => "left", "3" => "left");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    function mostrarPacientesProgramados($datos) {

        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $datos == '' ?  array() : $oLActoMedico->getListaPacientesProgramados($datos);
        $atencionrapida = "false"; //Ocultar el boton atencion inmediata por mientras
        //$atencionrapida = "true";
        //if($datos["codigoactividad"] == "0003") $atencionrapida = "false";
        $arrayCabecera = array("1" => "HORA", "2" => "PACIENTE", "3" => "EDAD", "4" => "SEXO", "5" => "EXAMEN", "6" => "ESTADO", "7" => "AFILIACION", "8" => "...", "9" => "...", "10" => "...");
        $arrayTamano = array("1" => "70", "2" => "*", "3" => "100", "4" => "40", "5" => "350", "6" => "100", "7" => "*", "8" => "30", "9" => "30", "10" => "30");
        $arrayTipo = array("1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "img", "9" => "img", "10" => "img");
        $arrayAlineacion = array("1" => "center", "2" => "left", "3" => "center", "4" => "center", "5" => "left", "6" => "center", "7" => "left", "8" => "center", "9" => "center", "10" => "center");
        $arrayHidden = array("1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false", "7" => "false", "8" => "false", "9" => "false", "10" => $atencionrapida);
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    function aMotrarTodasAtencionesProgramados($datos) {

        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $oLActoMedico->lMotrarTodasAtencionesProgramados($datos);
        $atencionrapida = "false"; //Ocultar el boton atencion inmediata por mientras
//$atencionrapida = "true";
//if($datos["codigoactividad"] == "0003") $atencionrapida = "false";
        $arrayCabecera = array("1" => "HORA", "2" => "PACIENTE", "3" => "EDAD", "4" => "SEXO", "5" => "TIPO CONS.", "6" => "ESTADO", "7" => "AFILIACION", "8" => "...", "9" => "...", "10" => "...");
        $arrayTamano = array("1" => "70", "2" => "*", "3" => "200", "4" => "100", "5" => "130", "6" => "130", "7" => "*", "8" => "30", "9" => "30", "10" => "30");
        $arrayTipo = array("1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "img", "9" => "img", "10" => "img");
        $arrayAlineacion = array("1" => "center", "2" => "left", "3" => "center", "4" => "center", "5" => "left", "6" => "center", "7" => "left", "8" => "center", "9" => "center", "10" => "center");
        $arrayHidden = array("1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false", "7" => "false", "8" => "false", "9" => "false", "10" => $atencionrapida);
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    function mostrarTodasPacientesAdicionales($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $oLActoMedico->getTodasListaPacientesAdicionales($datos);
        $atencionrapida = "false";

        $arrayCabecera = array("1" => "HORA", "2" => "PACIENTE", "3" => "EDAD", "4" => "SEXO", "5" => "TIPO CONS.", "6" => "ESTADO", "7" => "AFILIACIONES", "8" => "...", "9" => "...", "10" => "...");
        $arrayTamano = array("1" => "70", "2" => "*", "3" => "200", "4" => "100", "5" => "130", "6" => "130", "7" => "*", "8" => "30", "9" => "30", "10" => "30");
        $arrayTipo = array("1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "img", "9" => "img", "10" => "img");
        $arrayAlineacion = array("1" => "center", "2" => "left", "3" => "center", "4" => "center", "5" => "left", "6" => "center", "7" => "left", "8" => "center", "9" => "center", "10" => "center");
        $arrayHidden = array("1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false", "7" => "false", "8" => "false", "9" => "false", "10" => $atencionrapida);
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    function mostrarPacientesAdicionales($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $oLActoMedico->getListaPacientesAdicionales($datos);
        $atencionrapida = "false";
        if ($datos["codigoactividad"] == "0003"){
             $atencionrapida = "false";
        }
           
        $arrayCabecera = array("1" => "HORA", "2" => "PACIENTE", "3" => "EDAD", "4" => "SEXO", "5" => "TIPO CONS.", "6" => "ESTADO", "7" => "AFILIACIONES", "8" => "...", "9" => "...", "10" => "...");
        $arrayTamano = array("1" => "70", "2" => "*", "3" => "200", "4" => "100", "5" => "130", "6" => "130", "7" => "*", "8" => "30", "9" => "30", "10" => "30");
        $arrayTipo = array("1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "ro", "8" => "img", "9" => "img", "10" => "img");
        $arrayAlineacion = array("1" => "center", "2" => "left", "3" => "center", "4" => "center", "5" => "left", "6" => "center", "7" => "left", "8" => "center", "9" => "center", "10" => "center");
        $arrayHidden = array("1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false", "7" => "false", "8" => "false", "9" => "false", "10" => $atencionrapida);
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    function mostrarAtencionesMensuales($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->tablacontadoresMensualesActoMedico($datos);
        return $rs;
    }

    function obtenerlistaAsignadas($datos) {
        $oLActoMedico = new LActoMedico();
        $datosComboAsignadas = $oLActoMedico->obtenerlistaAsignadas($datos);
        $cb_comboModuloAsiganados = new Combo($datosComboAsignadas);
        $comboHTML_01 = $cb_comboModuloAsiganados->getOptionsListaHTML();
        $row_ochg = "onchange=\"\"";
        $multiple = "multiple=\"multiple\"";
        $size = "size=\"15\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<select style=\"width:100%;border:2px solid #006631;font-size:14px;font-family:verdana;\" name=\"lst_seleccionadas\" id=\"lst_seleccionadas\" $size $multiple " . $row_ochg . ">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_filtro . $comboHTML_01 . $row_fin_cb;
        return utf8_encode($comboHTML);
    }

    function obtenerlistaANoAsignadas($datos) {
        $oLActoMedico = new LActoMedico();
        $datosComboNoAsignadas = $oLActoMedico->obtenerlistaANoAsignadas($datos);
        $cb_comboModuloNoAsiganados = new Combo($datosComboNoAsignadas);
        $comboHTML_01 = $cb_comboModuloNoAsiganados->getOptionsListaHTML();
        $row_ochg = "onchange=\"\"";
        $multiple = "multiple=\"multiple\"";
        $size = "size=\"15\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<select style=\"width:100%;border:2px solid #006631;font-size:14px;font-family:verdana;\" name=\"lst_Noseleccionadas\" id=\"lst_Noseleccionadas\" $size $multiple " . $row_ochg . ">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_filtro . $comboHTML_01 . $row_fin_cb;
        return utf8_encode($comboHTML);
    }

    function cargarTablaServicios($datos) {

        require_once("tablaAngelSayes.php");
        $tabla = new TablaAngelSayes();
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->cargarTablaServicios($datos);
        //$count = count($resultado);
        $arrayWidth = array(0 => "120", 1 => "372");
        $arrayTitulos = array(0 => "Id", 1 => "Servicio");
        $arrayAlign = array(0 => "center", 1 => "left");
        $arrayType = array(0 => "text", 1 => "text");
        $arrayCursor = array(0 => "pointer", 1 => "pointer");
        $arrayFunctionXCelda = array(0 => "cargarMantenimiento", 1 => "cargarMantenimiento");
        $arrayImagenPorCelda = array(0 => "0", 1 => "0");
        $arrayUrlImagen = array(0 => "", 1 => "");
        $arrayFunction = array(0 => "", 1 => "");
        $arrayTitle = array(0 => "", 1 => "");
        $numDatosEnviadosFuncionCadena = 1;
        $scroll = 0;
        $height = 570;
        $resultado = $tabla->contructorTabla($scroll, $numDatosEnviadosFuncionCadena, $arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height);


//
//        $rs = '<table cellspacing="1" style="border:0px solid;">
//                <tr style="background-image:url(\'../../../../fastmedical_front/imagen/icono/fondogrid.png\');height: 30px;">
//                    <td style="width: 90px;border:0px solid #006631">
//                <center><p style="font-size:18px;font-family: segoe UI;color:black"><b>Codigo</b></p></center>
//                </td>
//                <td style="width: 600px;border:0px solid #006631">
//                <center><p style="font-size:18px;font-family: segoe UI;color:black"><b>Nombre Servicio</b></p></center>
//                </td>
//                <td style="width: 10px;border:0px solid #006631">
//                <center><p style="font-size:18px;font-family: segoe UI;color:black"><b>...</b></p></center>
//                </td>
//                </tr>';
//        $contador = count($resultado);
//        for ($x = 0; $x <= $contador - 1; $x++) {
//            if ($x % 2 == 0) {
//                $color = '#1B843C';
//            } else {
//                $color = '#1B843C';
//            }
//            $id = "'" . $resultado[$x][0] . "'";
//            $nombre = "'" . $resultado[$x][1] . "'";
//            $rs.='<tr onClick="cargarMantenimiento(' . $id . ',' . $nombre . ')" style="background-color:' . $color . ';" onmouseout=\'this.style.background="#1B843C";\' onmouseover=\'this.style.background="#006631";\'>
//                        <td>
//                    <center><p style="font-size:12px;font-family: segoe UI;color:white">' . $resultado[$x][0] . '</p></center>
//                    </td>
//                    <td>
//                        <p style="font-size:12px;font-family: segoe UI;color:white;padding-left:10px;">' . $resultado[$x][1] . '</p>
//                    </td>
//                    <td>
//                        <a href="javascript:cargarMantenimiento(' . $id . ',' . $nombre . ')"><img src="../../../../fastmedical_front/imagen/icono/btn_EditarAngel.png" style="width: 30px;"></a>
//                    </td>
//                    </tr>';
//        }
//        $rs.='</table>';
//        $rs.='<br><br><p style="color:white;font-size:16;font-family:verdana;padding-left:350px;">Total : ' . ($count) . '<br><br>';

        return $rs;
    }

    function detalleLaboratorioExamenes($IdResult) {
        $o_ActionReporte = new ActionReporte();
        $datosExamen = $o_ActionReporte->aDatosPuntoControlPaciente($IdResult);
        $datosGrupo = $o_ActionReporte->agrupodeDatos($IdResult);
        $datosExamenUni = $o_ActionReporte->adatosExamenUni($IdResult);
        $cadenaPeche = '';
        foreach ($datosGrupo as $key => $value1) {
            $cadenaPeche.='<br><b>GRUPO Nro. ' . ($key + 1) . ' ' . $value1[0] . '</b><br><br>';
            $cadenaPeche.='<table border="1" CellPadding="0" cellspacing="0" width="650" align="center">
                        <tr  bgcolor="#aaffff" color="white">
                            <td width="100" align="center"><B><font size="1">ITEM</font></B></td>
                            <td width="50" align="center"><B><font size="1">RESULT.</font></B></td>
                            <td width="60" align="center"><B><font size="1">UNIDAD</font></B></td>
                            <td width="300" align="center"><B><font size="1">RANGO</font></B></td>
                        </tr>
                        </table>';
            $cadenaPeche.='
                            <table border="0" CellPadding="0" cellspacing="0" width="650" align="center">
                                <tr>
                                <td width="100" align="center" bgcolor="white"></td>
                                <td width="50" align="center"  bgcolor="white"></td>
                                <td width="80" align="center" bgcolor="white"></td>
                                <td width="80" align="center" bgcolor="#ccffff"><font size="1">Edad</font></td>
                                <td width="80" align="center" bgcolor="#ccffff"><font size="1">Sexo</font></td>
                                <td width="80" align="center" bgcolor="#ccffff"><font size="1">Rango</font></td>
                                <td width="80" align="center" bgcolor="#ccffff"><font size="1">Significado</font></td>
                                </tr>
                            </table>';

            foreach ($datosExamenUni as $key => $value2) {
                if ($value1[1] == $value2[2]) {
                    $rangos = ' &#60; R &#60; ';
                    $edad = ' &#60; Edad &#60; ';
                    $cadenaPeche.='
                                <table border="1" CellPadding="0" cellspacing="0" width="650" align="center">
                                <tr>
                                <td width="120" align="center"><font size="1">' . $value2[0] . '</font></td>
                                <td width="60" align="center"><font size="1">';
                    switch ($value2[4]) {
                        case '1': {
                                $imprimirResultado = $value2[6];
                                break;
                            }
                        case '2': {
                                $imprimirResultado = $value2[8];
                                break;
                            }
                        case '4': {
                                $imprimirResultado = $value2[7];
                                break;
                            }
                        case '5' : {
                                $imprimirResultado = $value2[9];
                                break;
                            }
                        case '6': {

                                $imprimirResultado = $value2[11];
                                break;
                            }
                    }
                    $cadenaPeche.=$imprimirResultado . '</font></td>
                                <td width="70" align="center"><font size="1">' . $value2[3] . '</font></td>
                                <td width="370" align="center"><font size="1"></font>';
                    foreach ($datosExamen as $key => $value) {
                        if ($value2[0] == $value[3]) {
                            $cadenaPeche.='<table><tr> <td width="100" align="center"><font size="1">';
                            if ($value[16] == 1) {
                                $edades = $value[18] . $edad . $value[19];
                            }
                            $cadenaPeche.=$edades . '</font></td>
                                <td width="100" align="center"><font size="1">';
                            if ($value[15] == 1) {
                                $sexoes = $value[17];
                            }
                            $cadenaPeche.=$sexoes . '</font></td>
                                <td width="100" align="center"><font size="1">';
                            if ($value[20] == null && $value[21] == null) {
                                
                            } else {
                                $rangosre = $value[20] . $rangos . $value[21];
                            }
                            $cadenaPeche.=$rangosre . '</font></td>
                                <td width="100" align="center"><font size="1">' . $value[22] . '</font></td>
                               </tr></table>';
                        }
                    }
                    $cadenaPeche.='</td>
                                </tr>
                                </table>';
                }
            }
        }
        return $cadenaPeche;
    }

    function regresarAgendaMedicaActoMedico($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->cambiarEstadoNoAtendido($datos);
        return $rs;
    }

    function mostrarTablaCantidadAtencionDiaria($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->tablaCantidadAtencionDiaria($datos);
        return $rs;
    }

    function grabarDestinoEssalud($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->lgrabarDestinoEssalud($datos);
        return $rs;
    }

    function grabarTipoCitaEssalud($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->lgrabarTipoCitaEssalud($datos);
        return $rs;
    }

    function acargarDatosCombo($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->lcargarDatosCombo($datos);
        return $rs[0][0];
    }

    function acargarDatosTipoCita($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->lcargarDatosTipoCita($datos);
        return $rs[0][0];
    }

    function llamaralPacienteActoMedico($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->obtenerdatosdellamadadelPaciente($datos);
        return $rs;
    }

    function eliminarAnterioresSeleccionados($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->eliminarAnterioresSeleccionados($datos);
        return $rs;
    }

    function guardarNuevaSeleccion($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->guardarNuevaSeleccion($datos);
        return $rs;
    }

    function mostrardatosPersonalesActoMedico($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->obtenerdatosPersonalesActoMedico($datos);
        return $rs;
    }

    function actualizaradicionalesActoMedico($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->actualizaradicionalesActoMedico($datos);
        return $rs;
    }

    function arbolExamenFisico($idversion) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLActoMedico->arbolExamenFisico($idversion);
        return $o_TablaHtmlx->generaArbol($resultado);
    }

    function examenesFisicos() {
        $oLActoMedico = new LActoMedico();
//        $resultado=$oLActoMedico->generarArbolEF($ruta_archivo);
//        $cboPruebas = $oLActoMedico->pruebasNoAsignadas();
        $cboVersiones = $oLActoMedico->comboVersiones();
        require_once '../../cvista/actomedico/examenesFisicos.php';
    }

    function estadoDesarrollo($idversion) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->estadoDesarrollo($idversion);
        return $resultado;
    }

    function asignarPadreFisico($idversion) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLActoMedico->asignarPadreFisico($idversion);
        return $o_TablaHtmlx->generaArbol($resultado);

//        if($resultado=='nodata') {
//            return '10|';
//        }else {
//            require_once("../../cvista/actomedico/asignarPadreExamenFisico.php");
//        }
    }

    public function capturaPadreEF($datos) {
        $oLActoMedico = new LActoMedico();
        $p = $oLActoMedico->capturaPadreEF($datos);
        $idExamen = $p['0']['0'];
        $titulo = $p['0']['1'];
        $jerarquia = $p['0']['2'];
        $nivel = $p['0']['3'];
        $orden = $p['0']['4'];
        $resultado = $idExamen . "|" . $titulo . "|" . $jerarquia . "|" . $nivel . "|" . $orden . "|";
        return $resultado;
    }

    public function editaExamenFisico($codigo) {
        $oLActoMedico = new LActoMedico();
        $p = $oLActoMedico->editaExamenFisico($codigo);
        //$v = $oLActoMedico->getVersiones($codigo);
        $idExamen = $p['0']['0'];
        $idDependencia = $p['0']['1'];
        $titulo = $p['0']['2'];
        $jerarquia = $p['0']['3'];
        $nivel = $p['0']['4'];
        $orden = $p['0']['5'];
        $tituloExaPadre = $p['0']['6'];
        $estado = $p['0']['7'];
        $resultado = $idExamen . "|" . $idDependencia . "|" . utf8_encode($titulo) . "|" . $jerarquia . "|" . $nivel . "|" . $orden . "|" . utf8_encode($tituloExaPadre) . "|" . $estado . "|";
        return $resultado;
    }

    public function eliminaExamenFisico($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->eliminaExamenFisico($datos);
        return $resultado;
    }

    function act_regExamenFisico($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->act_regExamenFisico($datos);
//        $ruta_archivo="../../../../carpetaDocumentos/arbol_examenesfisicos";
//        $oLActoMedico->generarArbolEF($ruta_archivo);
//        require_once '../../cvista/actomedico/examenesFisicos.php';
        return $resultado;
    }

//    public function agregarMasCampos($readonly,$disabled){
////        $o_LCita   = new LCita();
////        $arrayFilas= $o_LCita->listaDatosPersonaDocumentos($c_cod_per);
////        $cantidad  = count($arrayFilas);
//        $cantidad=1;
//        $cb_tipDc='13233424';
//        $script    = "<script>$('divCampo').innerHTML=".$cantidad."</script>";
//        echo $script;
//        $tablaHTML = "";
//        $tablaHTML = "<table id='tbl_doc' style='width:100%;' border='0' cellpadding='3' cellspacing='0'>";
//        $tablaHTML.= "<tbody>";
//        $i = 1;
//        /*---------------------
//        <td width="33%" height="25"><p>Tipo de Campo :</p>
//                                    <input type="text" name="txtNomTipoDato" id="txtNomTipoDato" value="">
//                                </td>
//                                <td width="33%" height="25"><p>Nombre de Dato :</p>
//                                    <input type="text" name="txtNombreCampo" id="txtNombreCampo" value="">
//                                </td>
//                                <td width="33%" height="25"><p>Orden :</p>
//                                    <input type="text" name="txtOrden" id="txtOrden" value="">
//                                </td>
//        -----------------*/
//
////        if($c_cod_per=='' || count($arrayFilas)==0){
////            $cb_tipDc  = $this->seleccionarTipoDocumento('0001');
//            $imagen    = $disabled==''?'../../../../fastmedical_front/imagen/icono/nuevo_item.png':'../../../../fastmedical_front/imagen/icono/nuevo_item_black.png';
//            $cursor    = $disabled==''?'cursor:pointer;':'cursor:default;';
//            $tablaHTML.= "<tr>";
//            $tablaHTML.="<td height='30' width='25%' valign='top'><p>Tipo Campo :</p>";
//            $tablaHTML.="<select ".$disabled." onchange='validaTxtNroDoc(1);' name='cbTipoCampo[1]' id='cbTipoCampo[1]' style='width:120px;'>";
//            $tablaHTML.=$cb_tipDc;
//            $tablaHTML.="</select>";
//            $tablaHTML.="</td>";
//            $tablaHTML.="<td width='25%' valign='top'><p>Nombre del campo :</p>";
//            $tablaHTML.="<input name='txtNombreCampo[1]' tabindex=1 onblur='valida_docIdentidad(1);' onkeypress=\"return validFormSalt('nro',this,event,'txtApellidoPat')\"  type='text' style='width:100px;' id='txtNombreCampo[1]' title='Nombre del campo' maxlength='8' ".$readonly."/>";
//            $tablaHTML.="</td>";
//            $tablaHTML.="<td width='25%' valign='top'><p>Orden :</p>";
//            $tablaHTML.="<input name='txtOrden[1]' tabindex=1 onblur='valida_docIdentidad(1);' onkeypress=\"return validFormSalt('nro',this,event,'txtApellidoPat')\"  type='text' style='width:100px;' id='txtOrden[1]' title='Orden del campo' maxlength='8' ".$readonly."/>";
//            $tablaHTML.="</td>";
//            $tablaHTML.="<td width='25%' valign='top'><p>Estado :</p>";
//            $tablaHTML.="<select ".$disabled." onchange='validaTxtNroDoc(1);' name='cbEstado[1]' id='cbEstado[1]' style='width:50px;'>";
//            $tablaHTML.=$cb_tipDc;
//            $tablaHTML.="</select>";
//            $tablaHTML.="&nbsp;<input type='button' name='btnAgregaDni[1]' id='btnAgregaDni[1]' ".$disabled." value='' style='background:url($imagen) no-repeat;width:18px;height:18px;border:0px;$cursor' onclick='agregaMasCampo(\"tbl_doc\",++kk);'>";
//            $tablaHTML.="</td>";
//            $tablaHTML.= "</tr>";
//            $script    = "<script>$('divCampo').innerHTML=1</script>";
//            echo $script;
////        }else{
////            foreach($arrayFilas as $indice=>$valor){
////                $cb_tipDc  = $this->seleccionarTipoDocumento($arrayFilas[$i-1]['cTipoDocumento']);
////                $tablaHTML.= "<tr id='rowTipoDoc".$i."'>";
////                $tablaHTML.="<td height='23' width='30%' valign='top'>";
////                $tablaHTML.="<select onchange='validaTxtNroDoc(".$i.");' name='cbTipoDoc[".$i."]' id='cbTipoDoc[".$i."]' style='width:120px;' ".$disabled.">";
////                $tablaHTML.=$cb_tipDc;
////                $tablaHTML.="</select>";
////                $tablaHTML.="</td>";
////                $tablaHTML.="<td>";
////                $tablaHTML.="<input name='txtNroDocIdent[".$i."]' onblur='valida_docIdentidad(".$i.");' onkeypress=\"return validFormSalt('nro',this,event,'txtApellidoPat')\" type='text' ".$readonly." style='width:100px;' id='txtNroDocIdent[".$i."]' value='".htmlentities(trim($arrayFilas[$i-1]['vNumeroDocumento']))."'  title='Documento Identidad' maxlength='8'/>";
////                $tablaHTML.= $i==1?"<input type='button' disabled='disabled' name='btnDni[".$i."]' id='btnDni[".$i."]' value='' style='background:url(../../../../fastmedical_front/imagen/icono/nuevo_item_black.png) no-repeat;width:18px;height:18px;border:0px;cursor:default;' onclick='agrega_documento_identidad(\"tbl_doc\",++kk);'>":"<input type='button' name='btnDni[".$i."]' id='btnDni[".$i."]' disabled='disabled' value='' style='background:url(../../../imagen/inicio/eliminar_black.gif) no-repeat;width:18px;height:18px;border:0px;cursor:default;' onclick='elimina_fila(".$i.");'>";
////                $tablaHTML.="</td>";
////                $tablaHTML.="</tr>";
////                $i++;
////            }
////        }
//        $tablaHTML.= "</tbody>";
//        $tablaHTML.="</table>";
//        return $tablaHTML;
//    }




    function comboTipoCampo() {

        $oLActoMedico = new LActoMedico();
        $cboTipoCampo = $oLActoMedico->cargarTipoCampo();
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Pragma: no-cache"); // HTTP/1.0
        sleep(2);
        header("Content-Type: text/xml");
        $tablaXML = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
        $tablaXML.="<resultados>";
        foreach ($cboTipoCampo as $k => $valor) {
            $tablaXML.="<indice>" . $cboTipoCampo[$k][0] . "</indice>";
            $tablaXML.="<descripcion>" . $cboTipoCampo[$k][1] . "</descripcion>";
        }
        $tablaXML.="</resultados>";
        return $tablaXML;
    }

    function comboEstado() {
        $cboEstado = array(1 => "Activar", 0 => "Desactivar");
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Pragma: no-cache"); // HTTP/1.0
        sleep(2);
        header("Content-Type: text/xml");
        $tablaXML = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
        $tablaXML.="<resultados>";
        foreach ($cboEstado as $indice => $valor) {
            $tablaXML.="<indice>" . $indice . "</indice>";
            $tablaXML.="<descripcion>" . $valor . "</descripcion>";
        }
        $tablaXML.="</resultados>";
        return $tablaXML;
    }

    function grabarPrueba($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->grabarPrueba($datos);
        $cboTipoCampo = $oLActoMedico->cargarTipoCampo();
        if ($datos["p5"] == "modificar") {
            $hidIdPruebaC = $datos["p1"];
            $hidIdPrueba = $datos["p1"];
        }
        $descPrueba = $datos['p2'];
        $camposx = "";
        $act1 = "1";
        $des1 = "0";
        $disabled = "";
        if ($datos["p5"] == "nuevo") {
            $hidIdPruebaC = $resultado[0][0];
            require_once '../../cvista/actomedico/nuevoCampo.php';
        }
        return $resultado;
    }

//    public function agregarMasCampos($readonly,$disabled) {
////        $o_LCita   = new LCita();
////        $arrayFilas= $o_LCita->listaDatosPersonaDocumentos($c_cod_per);
////        $cantidad  = count($arrayFilas);
//        $cantidad=1;
//        $cb_tipDc='13233424';
//        $script    = "<script>$('divCampo').innerHTML=".$cantidad."</script>";
//        echo $script;
//        $tablaHTML = "";
//        $tablaHTML = "<table id='tbl_doc' style='width:100%;' border='0' cellpadding='3' cellspacing='0'>";
//        $tablaHTML.= "<tbody>";
//        $i = 1;
//        /*---------------------
//        <td width="33%" height="25"><p>Tipo de Campo :</p>
//                                    <input type="text" name="txtNomTipoDato" id="txtNomTipoDato" value="">
//                                </td>
//                                <td width="33%" height="25"><p>Nombre de Dato :</p>
//                                    <input type="text" name="txtNombreCampo" id="txtNombreCampo" value="">
//                                </td>
//                                <td width="33%" height="25"><p>Orden :</p>
//                                    <input type="text" name="txtOrden" id="txtOrden" value="">
//                                </td>
//        -----------------*/
//
////        if($c_cod_per=='' || count($arrayFilas)==0){
////            $cb_tipDc  = $this->seleccionarTipoDocumento('0001');
//        $imagen    = $disabled==''?'../../../../fastmedical_front/imagen/icono/nuevo_item.png':'../../../../fastmedical_front/imagen/icono/nuevo_item_black.png';
//        $cursor    = $disabled==''?'cursor:pointer;':'cursor:default;';
//        $tablaHTML.= "<tr>";
//        $tablaHTML.="<td height='30' width='25%' valign='top'><p>Tipo Campo :</p>";
//        $tablaHTML.="<select ".$disabled." onchange='validaTxtNroDoc(1);' name='cbTipoCampo[1]' id='cbTipoCampo[1]' style='width:120px;'>";
//        $tablaHTML.=$cb_tipDc;
//        $tablaHTML.="</select>";
//        $tablaHTML.="</td>";
//        $tablaHTML.="<td width='25%' valign='top'><p>Nombre del campo :</p>";
//        $tablaHTML.="<input name='txtNombreCampo[1]' tabindex=1 onblur='valida_docIdentidad(1);' onkeypress=\"return validFormSalt('nro',this,event,'txtApellidoPat')\"  type='text' style='width:100px;' id='txtNombreCampo[1]' title='Nombre del campo' maxlength='8' ".$readonly."/>";
//        $tablaHTML.="</td>";
//        $tablaHTML.="<td width='25%' valign='top'><p>Orden :</p>";
//        $tablaHTML.="<input name='txtOrden[1]' tabindex=1 onblur='valida_docIdentidad(1);' onkeypress=\"return validFormSalt('nro',this,event,'txtApellidoPat')\"  type='text' style='width:100px;' id='txtOrden[1]' title='Orden del campo' maxlength='8' ".$readonly."/>";
//        $tablaHTML.="</td>";
//        $tablaHTML.="<td width='25%' valign='top'><p>Estado :</p>";
//        $tablaHTML.="<select ".$disabled." onchange='validaTxtNroDoc(1);' name='cbEstado[1]' id='cbEstado[1]' style='width:50px;'>";
//        $tablaHTML.=$cb_tipDc;
//        $tablaHTML.="</select>";
//        $tablaHTML.="&nbsp;<input type='button' name='btnAgregaDni[1]' id='btnAgregaDni[1]' ".$disabled." value='' style='background:url($imagen) no-repeat;width:18px;height:18px;border:0px;$cursor' onclick='agregaMasCampo(\"tbl_doc\",++kk);'>";
//        $tablaHTML.="</td>";
//        $tablaHTML.= "</tr>";
//        $script    = "<script>$('divCampo').innerHTML=1</script>";
//        echo $script;
////        }else{
////            foreach($arrayFilas as $indice=>$valor){
////                $cb_tipDc  = $this->seleccionarTipoDocumento($arrayFilas[$i-1]['cTipoDocumento']);
////                $tablaHTML.= "<tr id='rowTipoDoc".$i."'>";
////                $tablaHTML.="<td height='23' width='30%' valign='top'>";
////                $tablaHTML.="<select onchange='validaTxtNroDoc(".$i.");' name='cbTipoDoc[".$i."]' id='cbTipoDoc[".$i."]' style='width:120px;' ".$disabled.">";
////                $tablaHTML.=$cb_tipDc;
////                $tablaHTML.="</select>";
////                $tablaHTML.="</td>";
////                $tablaHTML.="<td>";
////                $tablaHTML.="<input name='txtNroDocIdent[".$i."]' onblur='valida_docIdentidad(".$i.");' onkeypress=\"return validFormSalt('nro',this,event,'txtApellidoPat')\" type='text' ".$readonly." style='width:100px;' id='txtNroDocIdent[".$i."]' value='".htmlentities(trim($arrayFilas[$i-1]['vNumeroDocumento']))."'  title='Documento Identidad' maxlength='8'/>";
////                $tablaHTML.= $i==1?"<input type='button' disabled='disabled' name='btnDni[".$i."]' id='btnDni[".$i."]' value='' style='background:url(../../../../fastmedical_front/imagen/icono/nuevo_item_black.png) no-repeat;width:18px;height:18px;border:0px;cursor:default;' onclick='agrega_documento_identidad(\"tbl_doc\",++kk);'>":"<input type='button' name='btnDni[".$i."]' id='btnDni[".$i."]' disabled='disabled' value='' style='background:url(../../../imagen/inicio/eliminar_black.gif) no-repeat;width:18px;height:18px;border:0px;cursor:default;' onclick='elimina_fila(".$i.");'>";
////                $tablaHTML.="</td>";
////                $tablaHTML.="</tr>";
////                $i++;
////            }
////        }
//        $tablaHTML.= "</tbody>";
//        $tablaHTML.="</table>";
//        return $tablaHTML;
//    }
    ///////////////funciones de giancarlo///////////////////

    public function antecedentes($c_cod_per, $codigoProgramacion) {
        $oLActoMedico = new LActoMedico();
        $arrayNsdAntecedentes = $oLActoMedico->spListaNsdAntecedentes($codigoProgramacion);
        $numNsdAntecedentes = count($arrayNsdAntecedentes);

        $arrayAntecedentesPreguardados = $oLActoMedico->listaAntecedentesPreguardados($codigoProgramacion);
        $n = count($arrayAntecedentesPreguardados);

        //Armamos las cadenas
        //<input type="hidden" id="hdnCadenaIdCieAntecedentes" name="hdnCadenaIdCieAntecedentes" value="">
        $valorHdnCadenaIdCieAntecedentes = "";
        for ($z = 0; $z < $numNsdAntecedentes; $z++) {
            //Validar que no se repita IdCie porque captura repetidos de la tabla nsdAntecedenteXParentesco con sus join
            $valorHdnCadenaIdCieAntecedentes = $valorHdnCadenaIdCieAntecedentes . $arrayNsdAntecedentes[$z]["idCie"] . "|";
        }

        $valorHdnCadenaIdCieAntecedentes = substr($valorHdnCadenaIdCieAntecedentes, 0, strlen($valorHdnCadenaIdCieAntecedentes) - 1);

        require_once("../../cvista/actomedico/vistaAntecedentes.php");

        $arrayParentesco = $oLActoMedico->listaParentesco();

        $i = 0;
        foreach ($arrayParentesco as $f) {
            $arrayParentesco[$i][2] = 0;
            $arrayParentesco[$i][3] = 0;
            $i++;
        }
        $arrayAux = $arrayParentesco;
        $j = 1;
        $num = 0;
        for ($k = 0; $k < $n; $k++) {
            if (isset($arrayAntecedentesPreguardados[$j])) {
                if ($arrayAntecedentesPreguardados[$j][0] == $arrayAntecedentesPreguardados[$k][0]) {
                    if ($arrayAntecedentesPreguardados[$k][4] != null) {

                        //$arrayParentesco[$arrayAntecedentesPreguardados[$k][4]-1][2] = 1;
                        $contad = count($arrayParentesco) - 1;
                        for ($yyy = 0; $yyy <= $contad; $yyy++) {
                            if ($arrayParentesco[$yyy][0] == $arrayAntecedentesPreguardados[$k][4]) {
                                $arrayParentesco[$yyy][2] = 1;
                            }
                        }
                        $arrayParentesco[$arrayAntecedentesPreguardados[$k][4] - 1][3] = $arrayAntecedentesPreguardados[$k][5];
                    }
                } else {
                    if ($arrayAntecedentesPreguardados[$k][4] != null) {
                        //  print_R($arrayParentesco);
                        //  $arrayParentesco[$arrayAntecedentesPreguardados[$k][4]-1][2] =1;
                        $contad = count($arrayParentesco) - 1;
                        for ($yyy = 0; $yyy <= $contad; $yyy++) {
                            if ($arrayParentesco[$yyy][0] == $arrayAntecedentesPreguardados[$k][4]) {
                                $arrayParentesco[$yyy][2] = 1;
                            }
                        }
                        $arrayParentesco[$arrayAntecedentesPreguardados[$k][4] - 1][3] = $arrayAntecedentesPreguardados[$k][5];
                    }
                    $num++;
                    $numero = $num;
                    $nombreCie = utf8_encode($arrayAntecedentesPreguardados[$k][2]);
                    $idCie = $arrayAntecedentesPreguardados[$k][1];
                    $estadoAntecedente = 2;
                    $idAntecedente = $arrayAntecedentesPreguardados[$k][0];
                    $vObservacion = $arrayAntecedentesPreguardados[$k][3];
                    //print_r($arrayParentesco);
                    $ultimo = 'no';

                    require("../../cvista/actomedico/vistaAgregarAntecedentes.php");
                    $arrayParentesco = $arrayAux;
                }
            } else {
                if ($arrayAntecedentesPreguardados[$k][4] != null) {
                    // $arrayParentesco[$arrayAntecedentesPreguardados[$k][4] - 1][2] = 1;
                    $contad = count($arrayParentesco) - 1;
                    for ($yyy = 0; $yyy <= $contad; $yyy++) {
                        if ($arrayParentesco[$yyy][0] == $arrayAntecedentesPreguardados[$k][4]) {
                            $arrayParentesco[$yyy][2] = 1;
                        }
                    }
                    $arrayParentesco[$arrayAntecedentesPreguardados[$k][4] - 1][3] = $arrayAntecedentesPreguardados[$k][5];
                }
                $num++;
                $numero = $num;
                $nombreCie = utf8_encode($arrayAntecedentesPreguardados[$k][2]);
                $idCie = $arrayAntecedentesPreguardados[$k][1];
                $estadoAntecedente = 2;
                $idAntecedente = $arrayAntecedentesPreguardados[$k][0];
                $vObservacion = $arrayAntecedentesPreguardados[$k][3];
                // print_r($arrayParentesco);
                $ultimo = 'si';

                require("../../cvista/actomedico/vistaAgregarAntecedentes.php");
                $arrayParentesco = $arrayAux;
            }
            $j++;
        }
        if ($num == 0) {
            $numero = $num;
            require("../../cvista/actomedico/vistaAgregarAntecedentes.php");
        }
    }

    public function xmlTablaCie($nombreCie, $accion) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->listaCie($nombreCie, $accion);

        $arrayCabecera = array("1" => "Código", "2" => "Descripción", "3" => "Acción");
        $arrayTamano = array("1" => "50", "2" => "*", "3" => "60");
        $arrayTipo = array("1" => "ro", "2" => "ro", "3" => "img");
        $arrayAlineacion = array("1" => "center", "2" => "left", "3" => "center");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0);
    }

    public function agregarAntecedentes($numero, $nombreCie, $idCie) {
        $oLActoMedico = new LActoMedico();
        $arrayParentesco = $oLActoMedico->listaParentesco();
        $estadoAntecedente = 0;
        $idAntecedente = '';
        $vObservacion = '';
        $i = 0;
        $ultimo = 'no';
        foreach ($arrayParentesco as $f) {
            $arrayParentesco[$i][2] = 0;
            $arrayParentesco[$i][3] = 0;
            $i++;
        }
        require_once("../../cvista/actomedico/vistaAgregarAntecedentes.php");
    }

    public function preGrabarAntecedente($idCie, $observacion, $idProgramacion, $cadenaParentesco, $estadoAccion, $idAntecedente) {
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->preGrabarAntecedente($idCie, $observacion, $idProgramacion, $cadenaParentesco, $estadoAccion, $idAntecedente);
        return $array[0][0];
    }

    public function verAntecedentesAnteriores($codigoPaciente) {
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->verAntecedentesAnteriores($codigoPaciente);
        //print_r($arrayFilas);
        //echo $codigoPaciente;
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayCabecera = array("1" => "Cod.Cie", "2" => "Descripcion", "4" => "Parentesco");
        $arrayTamano = array("1" => "50", "2" => "*", "4" => "300");
        $arrayTipo = array("1" => "ro", "2" => "ro", "4" => "ro");
        $arrayAlineacion = array("1" => "center", "2" => "left", "4" => "left");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0);
    }

    public function clonarExamenes($idversion) {
        $oLActoMedico = new LActoMedico();
        $arrayResultado = $oLActoMedico->clonarExamenes($idversion);
        return $arrayResultado;
    }

    public function pasarProduccion($idversion) {
        $oLActoMedico = new LActoMedico();
        $arrayResultado = $oLActoMedico->pasarProduccion($idversion);
        return $arrayResultado;
    }

    public function inactivarVersion($idversion) {
        $oLActoMedico = new LActoMedico();
        $arrayResultado = $oLActoMedico->inactivarVersion($idversion);
        return $arrayResultado;
    }

    public function existeDesarrollo($idversion) {
        $oLActoMedico = new LActoMedico();
        $arrayResultado = $oLActoMedico->existeDesarrollo($idversion);
        return $arrayResultado;
    }

    public function ventanaAccionesExamenes($parametros) {
        $idVersion = $parametros['p2'];
        $descVersion = $parametros['p3'];
        $fechVersion = $parametros['p4'];
        $vestadoDesarrollo = $parametros['p5'];

        require_once("../../cvista/actomedico/ventanaAccionesExamenes.php");
    }

    public function vistaPrevia($idVersion, $idExamen) {

        $oLActoMedico = new LActoMedico();
        $listaExamenesPruebas = $oLActoMedico->listaExamenesPruebas($idVersion, $idExamen);
        require_once("../../cvista/actomedico/vistaPreviaExamenes.php");
    }

    function vistaPrueba($idExamen) {
        $oLActoMedico = new LActoMedico();
        $pruebasExamenes = $oLActoMedico->pruebasExamenes($idExamen, '');
        // print_r($pruebasExamenes);
        //echo 'examen:'.$idExamen."<br>";
        // require("../../cvista/actomedico/vistaPrueba.php");
        echo $this->vistaPruevasProduccion($idExamen, '');
    }

    function vistaPruevasProduccion($idExamen, $iCodigoProgramacion) {
        $oLActoMedico = new LActoMedico();
        $pruebasExamenes = $oLActoMedico->pruebasExamenes($idExamen, $iCodigoProgramacion);
        $cadena = '';
        $idPruebaAux = '';
        $numero = count($pruebasExamenes);
        $i = 0;
        $numeroCampos = 1;

        foreach ($pruebasExamenes as $fila) {

            $i++;
            $idPrueba = $fila[1];
            $nombreCampo = $fila[4];
            $iiDCombo = $fila[8];
            if (!($idPrueba == $idPruebaAux)) {
                $nombrePrueba = $fila[2];
                if ($i != 1) {
                    $cadena.='<div  style="width:100%; height:40px;float: left; "  id="div_botonPreguardar"  >';
                    //$cadena.='<input id="idPrueba" type="text" value="'.$fila[1].'"  />';
                    $cadena.='<input id="numeroCampos_' . $idPruebaAux . '" type="hidden" value="' . ($numeroCampos - 1) . '"  />';
                    $cadena.='<input id="estadoPrueba_' . $idPruebaAux . '" type="hidden" value="0"  />';
                    $cadena.='</div>';

                    $cadena.='</fieldset>';
                    $numeroCampos = 1;
                }
                $cadena.='<fieldset  style="font-size:15px;">';
                $cadena.='<legend>' . $nombrePrueba . '</legend>';
            }
            $iIdTipoDato = $fila[5];
            $estadoRegistro = $fila[16];
            $iIdExamenesMedicos = $fila[17];
            $bObligatorio = $fila[18];
            $idCampoPrueba = 'campoPrueba_' . $idPrueba . '_' . $numeroCampos;
            $cadena.='<input id="' . $idCampoPrueba . '" type="hidden" value="' . $fila[3] . '"  style=" width:20px;" />';
            $idValorCampo = 'valorCampo_' . $idPrueba . '_' . $numeroCampos;
            $idEstadoCampo = 'estadoCampo_' . $idPrueba . '_' . $numeroCampos;
            $idCampoExamen = 'idCampoExamen_' . $idPrueba . '_' . $numeroCampos;
            $idTipoCampo = 'idTipoCampo_' . $idPrueba . '_' . $numeroCampos;
            $idObligatorio = 'idObligatorio' . $idPrueba . '_' . $numeroCampos;
            switch ($iIdTipoDato) {
                case 1: //integer
                    $cadena.='<div align="left" style=" margin:3px; padding: 3px; width: 320px; height:20px;float: left; ">';
                    $cadena.='<div style=" float: left; width:150px;">';
                    $cadena.=$nombreCampo;
                    $cadena.='</div>
                     <div style=" float: left; width:150px;">
                     <input value="' . $fila[9] . '" id="' . $idValorCampo . '" onkeyup="validaIntegers(event,this,\'\')" type="text" style="width:30px;" onchange="cambioEstado(\'' . $idEstadoCampo . '\');" />
                     <input id="' . $idEstadoCampo . '" type="hidden" style=" width:20px;" value="' . $estadoRegistro . '" />
                     <input value="' . $iIdExamenesMedicos . '"  id="' . $idCampoExamen . '" type="hidden" style=" width:20px;"  />
                     <input id="' . $idTipoCampo . '" type="hidden"  value="' . $iIdTipoDato . '" />
                     <input id="' . $idObligatorio . '" type="hidden"  value="' . $bObligatorio . '" />
                     </div>
                    </div>';
                    break;
                case 2://varchar
                    $cadena.='<div align="left" style=" margin:3px; padding: 3px; width: 100%; height:20px;float: left; ">
                      <div style=" float: left; width:150px;">';
                    $cadena.=$nombreCampo;
                    $cadena.='</div>
                      <div style=" float: left; width:60%;">
                      <input value="' . $fila[10] . '" id="' . $idValorCampo . '" type="text" style=" width:80%;" onchange="cambioEstado(\'' . $idEstadoCampo . '\');"/>
                      <input id="' . $idEstadoCampo . '" type="hidden" style=" width:20px;" value="' . $estadoRegistro . '" />
                      <input value="' . $iIdExamenesMedicos . '" id="' . $idCampoExamen . '" type="hidden" style=" width:20px;"  />
                      <input id="' . $idTipoCampo . '" type="hidden" style=" width:20px;" value="' . $iIdTipoDato . '" />
                      <input id="' . $idObligatorio . '" type="hidden"  value="' . $bObligatorio . '" />                      
                      </div>
                      </div>';
                    break;
                case 3://datetime
                    $cadena.='<div align="left" style=" margin:3px; padding: 3px; width: 320px; height:20px;float: left; ">
                       <div style=" float: left; width:150px;">';
                    $cadena.=$nombreCampo;
                    $cadena.='</div>
                       <div style=" float: left; width:150px;"  >
                       <input onchange="cambioEstado(\'' . $idEstadoCampo . '\');" value="' . $fila[11] . '" id="' . $idValorCampo . '" type="text" style=" width:100px; " onblur="esFechaValida(this); cambioEstado(\'' . $idEstadoCampo . '\');" onclick="calendarioHtmlx(this);"  />
                       <input id="' . $idEstadoCampo . '" type="hidden" style=" width:20px;" value="' . $estadoRegistro . '" />
                       <input value="' . $iIdExamenesMedicos . '" id="' . $idCampoExamen . '" type="hidden" style=" width:20px;"  />
                       <input id="' . $idTipoCampo . '" type="hidden" style=" width:20px;" value="' . $iIdTipoDato . '" />
                       <input id="' . $idObligatorio . '" type="hidden"  value="' . $bObligatorio . '" />    
                        </div>
                       </div>';
                    break;
                case 4: //decimal

                    $cadena.='<div align="left" style=" margin:3px; padding: 3px; width: 320px; height:20px;float: left; ">
                        <div style=" float: left; width:150px;">';
                    $cadena.=$nombreCampo;
                    $cadena.='</div>
                        <div style=" float: left; width:150px;">
                        <input value="' . $fila[12] . '" id="' . $idValorCampo . '" type="text" style=" width:100px; " onkeyup="validaDecimal(event,this,\'\')" onchange="cambioEstado(\'' . $idEstadoCampo . '\');" />
                        <input id="' . $idEstadoCampo . '" type="hidden" style=" width:20px;" value="' . $estadoRegistro . '" />
                        <input value="' . $iIdExamenesMedicos . '" id="' . $idCampoExamen . '" type="hidden" style=" width:20px;"  />
                        <input id="' . $idTipoCampo . '" type="hidden" style=" width:20px;" value="' . $iIdTipoDato . '" />
                        <input id="' . $idObligatorio . '" type="hidden"  value="' . $bObligatorio . '" />
                        </div>
                        </div>';
                    break;
                case 5://bolean

                    $cadena.='<div align="left" style=" margin:3px; padding: 3px; width: 320px; height:20px;float: left; ">
                        <div style=" float: left; width:150px;">';
                    $cadena.=$nombreCampo;
                    if ($fila[13] == 1) {
                        $checked = 'checked';
                    } else {
                        $checked = '';
                    }
                    $cadena.='</div>
                        <div style=" float: left; width:50px;">
                        <input ' . $checked . '  value="' . $fila[13] . '" id="' . $idValorCampo . '"  TYPE=CHECKBOX onclick=\'if(this.checked){this.value=1}else{this.value=0;}\' onchange="cambioEstado(\'' . $idEstadoCampo . '\');"   />
                        <input id="' . $idEstadoCampo . '" type="hidden" style=" width:20px;" value="' . $estadoRegistro . '" />
                        <input value="' . $iIdExamenesMedicos . '" id="' . $idCampoExamen . '" type="hidden" style=" width:20px;"  />
                        <input id="' . $idTipoCampo . '" type="hidden" style=" width:20px;" value="' . $iIdTipoDato . '" />
                        <input id="' . $idObligatorio . '" type="hidden"  value="' . $bObligatorio . '" />
                        </div>
                        </div>';

                    break;
                case 6:  //combo
                    $arrayCombo = $this->arrayComboExamenes($iiDCombo);
                    $cadena.=' <div align="left" style=" margin:3px; padding: 3px; width: 320px; height:20px;float: left; ">
                    <div style=" float: left; width:150px;">';
                    $cadena.=$nombreCampo;
                    $cadena.='</div>
                    <div style=" float: left; width:150px;">
                        <select id="' . $idValorCampo . '" name="combo" value="" style="width:150px"  onchange="cambioEstado(\'' . $idEstadoCampo . '\');" >';
                    $cadena.='<option value="">Seleccionar...
                        </option>';
                    foreach ($arrayCombo as $filaCombo) {
                        if ($fila[14] == $filaCombo[0]) {
                            $seleccionado = 'selected';
                        } else {
                            $seleccionado = '';
                        }
                        $cadena.='<option ' . $seleccionado . ' value="' . $filaCombo[0] . '">' . $filaCombo[2] . '
                        </option>';
                    }
                    $cadena.='</select>
                   <input id="' . $idEstadoCampo . '" type="hidden" style=" width:20px;" value="' . $estadoRegistro . '" />
                   <input value="' . $iIdExamenesMedicos . '" id="' . $idCampoExamen . '" type="hidden" style=" width:20px;"  />
                   <input id="' . $idTipoCampo . '" type="hidden" style=" width:20px;" value="' . $iIdTipoDato . '" />
                   <input id="' . $idObligatorio . '" type="hidden"  value="' . $bObligatorio . '" />
                    </div>
                    </div>';
                    break;
                case 7://texto
                    $cadena.='<div align="left" style=" margin:3px; padding: 3px; width: 98%; float: left; ">
                          <div style=" float: left; width:150px;">';
                    $cadena.=$nombreCampo;
                    $cadena.='</div>
                          <div style=" float: left; width:98%;">
                          <textarea  id="' . $idValorCampo . '" style="width:100%; height:100px;" onchange="cambioEstado(\'' . $idEstadoCampo . '\');">' . $fila[15] . '</textarea>
                          <input id="' . $idEstadoCampo . '" type="hidden" style=" width:20px;" value="' . $estadoRegistro . '" />
                          <input value="' . $iIdExamenesMedicos . '" id="' . $idCampoExamen . '" type="hidden" style=" width:20px;"  />
                          <input id="' . $idTipoCampo . '" type="hidden" style=" width:20px;" value="' . $iIdTipoDato . '" />
                          <input id="' . $idObligatorio . '" type="hidden"  value="' . $bObligatorio . '" />
                          </div>
                          </div>';
                    break;
            }


            if ($i == $numero) {
                $cadena.='<div style="width:100%; height:40px;float: left; "  id="div_botonPreguardar"  >';
                //$cadena.='<input id="idPrueba" type="text" value="'.$fila[1].'"  />';
                $cadena.='<input id="numeroCampos_' . $idPrueba . '" type="hidden" value="' . $numeroCampos . '"  />';
                $cadena.='<input id="estadoPrueba_' . $idPrueba . '" type="hidden" value="0"  />';
                $cadena.='</div>';
                $cadena.='</fieldset>';
                $numeroCampos = 1;
            }
            $idPruebaAux = $fila[1];
            $numeroCampos++;
        }

        return utf8_encode($cadena);
    }

    function arrayComboExamenes($idCombo) {
        $oLActoMedico = new LActoMedico();
        $arrayResultado = $oLActoMedico->arrayComboExamenes($idCombo);
        return $arrayResultado;
    }

    function preguardarExamenes($cadenaValores, $cadenaEstados, $cadenaIdCampos, $cadenaTipoCampo, $cadenaCampoPrueba, $iCodigoProgramacion, $idVersion) {
        $oLActoMedico = new LActoMedico();
        $arrayValores = explode("|", $cadenaValores);
        $arrayEstados = explode("|", $cadenaEstados);
        $arrayIdCampos = explode("|", $cadenaIdCampos);
        $arrayTipoCampo = explode("|", $cadenaTipoCampo);
        $arrayCampoPruebas = explode("|", $cadenaCampoPrueba);
        $n = count($arrayValores) - 1;

        $cadenaResultado = '';
        for ($i = 0; $i < $n; $i++) {
            $cadenaResultado.=$oLActoMedico->preguardarExamenes($arrayValores[$i], $arrayEstados[$i], $arrayIdCampos[$i], $arrayTipoCampo[$i], $arrayCampoPruebas[$i], $iCodigoProgramacion, $idVersion) . '|';
        }
        return $cadenaResultado;
    }

    public function verHC($codigoPaciente) {
        $oLActoMedico = new LActoMedico();
        //$listaExamenesPruebas = $oLActoMedico->listaExamenesPruebas($idVersion,$idExamen);
        require_once("../../cvista/actomedico/verHC.php");
    }

    public function verHCReciente($idProgramacion) {
        $oLActoMedico = new LActoMedico();
        require_once("../../cvista/actomedico/verHCxDia.php");
    }

    public function arbolHCFechas($codigoPaciente) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLActoMedico->arbolHCFechas($codigoPaciente);
        return $o_TablaHtmlx->generaArbol($resultado);
    }

    public function verHCxDia($idProgramacion) {
        $oLActoMedico = new LActoMedico();
        //$listaExamenesPruebas = $oLActoMedico->listaExamenesPruebas($idVersion,$idExamen);
        require_once("../../cvista/actomedico/verHCxDia.php");
    }

    public function verHCxItemes($id, $text, $idPaciente) {
        $oLActoMedico = new LActoMedico();
        $dato = $oLActoMedico->datosPersona($idPaciente, "codigopersona");
        $titulo = $text;
        $idDiv = "div_items" . $id;
        $codigoPersona = $dato[0][0];
        require_once("../../cvista/actomedico/verHCxItems.php");
    }

    public function arbolHCItems() {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLActoMedico->arbolHCItems();
        return $o_TablaHtmlx->generaArbol($resultado);
    }

    public function mostrarDetalleCita($idProgramacion) {
        $oLActoMedico = new LActoMedico();
        //$triajeHC = $oLActoMedico->triaje($idProgramacion);
        $resultado = $oLActoMedico->spListaDetalleCita($idProgramacion);
        $cadena = "";
        $cadena = $cadena . "<table width=\"100%\" cellspacing=\"2\">
          <tr>
            <td><font style=\"color:#3C5C93;\">M&eacute;dico:</font></td>
            <td><h2>" . htmlentities($resultado[0]["nomCompletoMedico"]) . "</h2></td>
            <td><font style=\"color:#3C5C93;\">Hora:</font></td>
            <td><h2>" . htmlentities($resultado[0]["cHoraProgramada"]) . "</h2></td>
            <td><font style=\"color:#3C5C93;\">Fecha:</font></td>
            <td><h2>" . htmlentities($resultado[0]["fechaAtencion"]) . "</h2></td>
          </tr>
          <tr>
            <td><font style=\"color:#3C5C93;\">Consultorio:</font></td>
            <td><h2>" . htmlentities($resultado[0]["vNombreAmbienteLogico"]) . "-" . htmlentities($resultado[0]["vNombreAmbienteFisico"]) . "-" . htmlentities($resultado[0]["sedeEmpresa"]) . "</h2></td>
            <td><font style=\"color:#3C5C93;\">Tipo:</font></td>
            <td><h2>" . htmlentities($resultado[0]["vDescripcionTipoCita"]) . "</h2></td>
            <td><font style=\"color:#3C5C93;\">Estado:</font></td>
            <td><font style=\"color:red; font-weight:bold;\">" . htmlentities($resultado[0]["vDescripcionEstadoAtencion"]) . "</font></td>
          </tr>
           <tr>
            <td><font style=\"color:#3C5C93;\">Afiliacion:</font></td>
            <td><h2>" . htmlentities($resultado[0]["vDescripcion"]) . "</h2></td>
            <td><font style=\"color:#3C5C93;\">Sede:</font></td>
            <td><font style=\"color:#3C5C93; font-weight:bold;\">" . htmlentities($resultado[0]["sedeEmpresa"]) . "</font></td>
            <td></td>
            <td></td>
          </tr>
            <tr><td>&nbsp;</td></tr>
        </table>";
        return $cadena;
    }

    public function triaje($idProgramacion) {
        $oLActoMedico = new LActoMedico();
        $triajeHC = $oLActoMedico->triaje($idProgramacion);
        $cadena = "";
        $cadena = $cadena . "<table width=\"100%\" cellspacing=\"2\">
          <tr>
            <td><font style=\"color:#3C5C93;\">Peso (Kg.):</font></td>
            <td>" . $triajeHC[0]["nPeso"] . "</td>
            <td><font style=\"color:#3C5C93;\">Talla (m.):</font></td>
            <td>" . $triajeHC[0]["nTalla"] . "</td>
            <td><font style=\"color:#3C5C93;\">Temp. (ºC):</font></td>
            <td>" . $triajeHC[0]["nTemperatura"] . "</td>
            <td><font style=\"color:#3C5C93;\">Frec. Cardiaca (min):</font></td>
            <td>" . $triajeHC[0]["iFrecuenciaCardiaca"] . "</td>
          </tr>
          <tr>
            <td><font style=\"color:#3C5C93;\">Pres. Arterial (mmHg):</font></td>
            <td>" . $triajeHC[0]["vPresionArterial"] . "</td>
            <td><font style=\"color:#3C5C93;\">Frec. Respiratoria (min):</font></td>
            <td>" . $triajeHC[0]["iFrecuenciaRespiratoria"] . "</td>
            <td><font style=\"color:#3C5C93;\">Sat. O2(%):</font></td>
            <td>" . $triajeHC[0]["nSaturacionOxigeno"] . "</td>
                <td><font style=\"color:#3C5C93;\">IMC :</font></td>
            <td>" . round($triajeHC[0]["nPeso"]/pow(2,($triajeHC[0]["nTalla"]/100)),2) . "</td>
          </tr>
            
        </table>";

        return $cadena;
    }

    public function historiaMotivoConsulta($idProgramacion) {
        $oLActoMedico = new LActoMedico();
        $historiaMC = $oLActoMedico->historiaMotivoConsulta($idProgramacion);
        $cadena = "";
        if ($historiaMC) {
            //$datosMed=$oLActoMedico->atencionMedico($idProgramacion);
            //$medico_instalacion=" M&eacute;dico : ".htmlentities($datosMed[0][2])." ".htmlentities($datosMed[0][3])." ".htmlentities($datosMed[0][4])." &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
            //$medico_instalacion.=" &nbsp;&nbsp;&nbsp;Consultorio : ".htmlentities($datosMed[0][8])." - ".htmlentities($datosMed[0][7])." - ".htmlentities($datosMed[0][6]);
            //$cadena.='<br><h2 align="center" >'.$medico_instalacion.'</h2><br>';

            $cadena.='<center><br><fieldset style="border:0px;padding-left: 5px;  font-size: 16px;" >
                        <table width="700px" class="tablaDiagnostico"  border="0" cellpadding="0" cellspacing="2" align="center" >
                            <tr>
                                <td  width="50%" height="30" bgcolor="#E8EEFD" align="center" ><strong>S&iacute;ntoma</strong></td>
                                <td  width="50%" bgcolor="#E8EEFD" align="center"><strong>Descripci&oacute;n</strong></td>
                            </tr>';

            foreach ($historiaMC as $i => $value) {
                $cadena.='<tr ><td >&nbsp;' . utf8_encode(($historiaMC[$i][2])) . ' - ' . utf8_encode($historiaMC[$i][3]) . '</td><td>&nbsp; ' . utf8_encode($historiaMC[$i][4]) . '</td></tr>';
            }

            $cadena.='</table></fieldset></center><br>';
            /*
              foreach ($historiaMC as $i => $value) {
              $cadena.='<fieldset style=" padding-left: 20px;background-color: #FFFFFF;">
              <table width="500" border="0" cellpadding="0" cellspacing="2" align="center">
              <tr><td width="20%" class="letra16">S&iacute;ntoma :</td><td width="80%" class="letra16">'.htmlentities($historiaMC[$i][2]).' - '.$historiaMC[$i][3].'</td> </tr>
              <tr><td class="letra16">Descripci&oacute;n :</td><td class="letra16">'.htmlentities($historiaMC[$i][4]).'</td> </tr>
              </table>
              </fieldset><br>';
              }
             */
        }
        return $cadena;
    }

    public function examenesHC($idProgramacion, $opt) {
        $oLActoMedico = new LActoMedico();
        $examenes = $oLActoMedico->listaExamenesHC($idProgramacion, "xprogramacion");

        foreach ($examenes as $filaExamen) {
            $pruebasExamenes = $oLActoMedico->valoresCampos($idProgramacion, $filaExamen[0]);
            //print_r($valoreCampos);

            require("../../cvista/actomedico/vistaPrueba.php");
        }
    }

    public function historiaAntecedentes($idProgramacion) {
        $oLActoMedico = new LActoMedico();
        $antecedentes = $oLActoMedico->historiaAntecedentes($idProgramacion);
        $cadena = "";
        if ($antecedentes) {


            $cadena.='<center><br><fieldset style="border:0px;padding-left: 5px; font-size: 16px;">
                        <table class="tablaDiagnostico" width="700px" border="0" cellpadding="0" cellspacing="2" align="center">
                            <tr>
                                <td   width="35%" height="30" bgcolor="#E8EEFD" align="center"><strong>S&iacute;ntoma</strong></td>
                                <td   width="10%" bgcolor="#E8EEFD" align="center"><strong>Parentesco</strong></td>' .
                    //<td width="5%" bgcolor="#E8EEFD" align="center"><strong>Vive</strong></td>
                    '<td width="50%"  bgcolor="#E8EEFD" align="center"><strong>Descripci&oacute;n</strong></td>
                            </tr>';

            foreach ($antecedentes as $i => $value) {
                $vive = "";
                if ($antecedentes[$i][5] == 1) {
                    $vive = "Si";
                }


                if ($antecedentes[$i][5] == 0) {
                    $vive = "No";
                }
                if ($antecedentes[$i][5] == '') {
                    $vive = "";
                }


                // $cadena.='<tr><td>' . htmlentities($antecedentes[$i][2]) . ' - ' . htmlentities($antecedentes[$i][3]) . '</td><td>' . htmlentities($antecedentes[$i][7]) . '</td><td>' . htmlentities($vive) . '</td><td>' . htmlentities($antecedentes[$i][4]) . '</td></tr>';
                $cadena.='<tr><td>&nbsp;' . htmlentities($antecedentes[$i][2]) . ' - ' . htmlentities($antecedentes[$i][3]) . '</td><td>&nbsp;' . htmlentities($antecedentes[$i][7]) . '</td><td>&nbsp;' . htmlentities($antecedentes[$i][4]) . '</td></tr>';
            }
            $cadena.='</table></fieldset></center><br>';
            /*
              foreach ($antecedentes as $i => $value) {
              $vive=""    ;
              if($antecedentes[$i][5]==1) $vive="Si";
              else if($antecedentes[$i][5]==0) $vive="No";

              $cadena.='<fieldset style=" padding-left: 20px;background-color: #FFFFFF;">
              <table width="500" border="0" cellpadding="0" cellspacing="2" align="center">
              <tr><td width="20%" class="letra16">Parentesco :</td><td width="30%" class="letra16">'.htmlentities($antecedentes[$i][7]).'</td>
              <td width="20%" class="letra16">Vive :</td><td width="30%" class="letra16">'.htmlentities($vive).'</td></tr>
              <tr><td width="20%" class="letra16">S&iacute;ntoma :</td><td colspan="3" class="letra16">'.htmlentities($antecedentes[$i][2]).' - '.htmlentities($antecedentes[$i][3]).'</td></tr>
              <tr><td width="20%" class="letra16">Descripci&oacute;n :</td><td  colspan="3" class="letra16">'.htmlentities($antecedentes[$i][4]).'</td></tr>
              </table>
              </fieldset><br>';
              }
             */
        }
        return $cadena;
    }

    public function historiaTratamientos($idProgramacion) {
        $oLActoMedico = new LActoMedico();
        $medicamentoso = $oLActoMedico->listaHistoriaTratamientoMedicamentoso($idProgramacion, "1");
        $practicaMedica = $oLActoMedico->listaHistoriaTratamientoSgtCita($idProgramacion, "2");

        $cadena = "";

        if ($medicamentoso) {

            $idReceta = $medicamentoso[0]['iIdReceta'];
            $idRecetaAux = 0;
            $cadena.='<fieldset style=" margin:5px;">
                        <legend> Tratamiento con medicamentos </legend>';
            foreach ($medicamentoso as $i => $value) {
                $idReceta = $medicamentoso[$i]['iIdReceta'];
                $fechaVencimiento = $medicamentoso[$i]['vencimiento'];
                if ($idReceta != $idRecetaAux) {

                    $cadena.='<fieldset style="border:0px solid;padding-left: 5px;  font-size: 16px;">
                        <legend> Receta ' . $idReceta . ' - Vencimiento: ' . $fechaVencimiento . ' <a onclick="javascript:imprimirRecetaUnicaEstandarizada(' . $idReceta . ');" href="javascript:;">
                                    <img alt="" title="Receta Medica Estandarizada" src="../../../../fastmedical_front/imagen/btn/ImprimirReceta.png" id="btnImprimirRecetaUnica">
                                    </a></legend>
                        <table class="tablaDiagnostico" width="700px;" border="0" cellpadding="0" cellspacing="2" align="center">
                            <tr>
                                <td width="35%" height="30" bgcolor="#E8EEFD" align="center"><strong>Medicamento</strong></td>
                                <td width="10%" bgcolor="#E8EEFD" align="center"><strong>Presentaci&oacute;n</strong></td>
                                <td width="5%" bgcolor="#E8EEFD" align="center"><strong>Cantidad</strong></td>
                                <td width="50%" bgcolor="#E8EEFD" align="center">
                                    <strong>Indicaciones
                                    
                                    </strong>
                                </td>
                            </tr>';
                }

                $cadena.='<tr><td>' . htmlentities($medicamentoso[$i][2]) . '</td><td>' . htmlentities($medicamentoso[$i][5]) . '</td><td>' . htmlentities($medicamentoso[$i][3]) . '</td><td>' . htmlentities($medicamentoso[$i][4]) . '</td></tr>';
                $idRecetaAux = $idReceta;
                $j = $i + 1;
                if (isset($medicamentoso[$j]['iIdReceta'])) {
                    if ($medicamentoso[$j]['iIdReceta'] != $idReceta) {
                        $cadena.='</table></fieldset><br>';
                    }
                } else {
                    $cadena.='</table></fieldset>';
                }
            }
            $cadena.='</fieldset>';
        }
        if ($practicaMedica) {
            //$cadena.='<br><h2 align="center" >'.$medico_instalacion.'</h2><br>';
            if (false) {
                $idReceta = $practicaMedica[0]['iIdReceta'];
                $cadena.='<fieldset style=" margin:5px;">
                        <legend> Pr&aacute;cticas M&eacute;dicas 
  <a onclick="javascript:imprimirOrdenMedica(' . $idReceta . ');" href="javascript:;">
                                    <img alt="" title="Receta Orden Médica" src="../../../../fastmedical_front/imagen/btn/ImprimirReceta.png" id="btnImprimirRecetaUnica">
                                    </a>                        
</legend>
                        <div style="margin-left: 1%; margin-right: 1%;">';
                //$cadena.="<h2 align='center'> Pr&aacute;cticas M&eacute;dicas </h2><br>";
                $cadena.='<fieldset style="padding-left: 5px;  font-size: 16px;">
                        <table class="tablaDiagnostico" width="700px;" border="0" cellpadding="0" cellspacing="2" align="center">
                            <tr>
                                <td width="40%" height="30" bgcolor="#E8EEFD" align="center"><strong>Nombre</strong></td>
                                <td width="10%" bgcolor="#E8EEFD" align="center"><strong>Cod. Segus</strong></td>
                                <td width="50%" bgcolor="#E8EEFD" align="center">
                                    <strong>Observaci&oacute;n</strong>
                                  
                                    </td>
                            </tr>';
                foreach ($practicaMedica as $i => $value) {
                    $cadena.='<tr><td>' . htmlentities($practicaMedica[$i][2]) . '</td><td>' . htmlentities($practicaMedica[$i][5]) . '</td><td>' . htmlentities($practicaMedica[$i][3]) . '</td></tr>';
                }
                $cadena.='</table></fieldset><br>';
                $cadena.='</div></fieldset><br>';
            } else {
                $contadorPracticaMedica = count($practicaMedica);
                $idReceta = 0;
                for ($x = 0; $x <= $contadorPracticaMedica - 1; $x++) {
                    if ($practicaMedica[$x][6] != $practicaMedica[$x + 1][6]) {
                        $idReceta = $practicaMedica[$x][6];
                        $cadena.='<br><fieldset style=" margin:5px;">';
                        $cadena.=' <legend> Pr&aacute;cticas M&eacute;dicas 
      <a onclick="javascript:imprimirOrdenMedica(' . $idReceta . ');" href="javascript:;">
                                    <img alt="" title="Receta Orden Médica" src="../../../../fastmedical_front/imagen/btn/ImprimirReceta.png" id="btnImprimirRecetaUnica">
                                </a>                             
</legend>';
                        $cadena.='<div style="margin-left: 1%; margin-right: 1%;">';
                        $cadena.='<fieldset style="border:0px solid;padding-left: 5px;  font-size: 16px;">';
                        $cadena.='<table class="tablaDiagnostico" width="700px;" border="0" cellpadding="0" cellspacing="2" align="center">
                            <tr bgcolor="#E8EEFD">
                                <td   align="center"><strong>Nombre</strong></td>
                                <td  align="center"><strong>Cod. Segus</strong></td>
                                <td  align="center"><strong>Observaci&oacute;n</strong></td>
                                <td>
                          
                                </td>
                            </tr>';
                        foreach ($practicaMedica as $i => $value) {
                            if ($practicaMedica[$i][6] == $idReceta) {
                                $idTratamiento = $practicaMedica[$i]['idTratamiento'];
                                $cadena.='<tr><td>' . htmlentities($practicaMedica[$i][2]) . '</td>
                            <td>&nbsp;' . htmlentities($practicaMedica[$i][5]) . '</td>
                            <td>&nbsp;' . htmlentities($practicaMedica[$i][3]) . '</td> 
                            </tr>';
                            }
                        }

                        $cadena.='</table>';
                        $cadena.='</fieldset><br>';
                        $cadena.='<div></fieldset>';
                    }
                }
            }
        }
        return $cadena;
    }

    function valorComboExamen($iCombo) {
        $oLActoMedico = new LActoMedico();
        $arrayResultado = $oLActoMedico->valorComboExamen($iCombo);
        return $arrayResultado[0][0];
    }

    public function historiaDiagnostico($idProgramacion) {
        $oLActoMedico = new LActoMedico();
        $diagnosticos = $oLActoMedico->historiaDiagnostico($idProgramacion);
        $cadena = "";
        if ($diagnosticos) {
            $cadena.='<fieldset style="border:0px solid;padding-left: 5px; font-size: 16px;">
                       <table class="tablaDiagnostico" width="700px;" border="0" cellpadding="0" cellspacing="2" align="center">
                       <tr><td height="30" width="15%" bgcolor="#E8EEFD" align="center"><strong>C&oacute;digo Cie</strong></td><td width="65%" bgcolor="#E8EEFD" align="center"><strong>Descripci&oacute;n</strong></td><td width="20%" bgcolor="#E8EEFD" align="center"><strong>Tipo Diagn&oacute;stico</strong></td></tr>';
            foreach ($diagnosticos as $i => $value) {
                $cadena.='<tr><td>' . utf8_encode($diagnosticos[$i][1]) . '</td><td>' . utf8_encode($diagnosticos[$i][2]) . '</td><td>' . utf8_encode($diagnosticos[$i][6]) . '</td></tr>';
            }
            $cadena.='<tr><td colspan="3" align="center"><strong>Observaci&oacute;n</strong></td></tr>
                     <tr><td colspan="3"><fieldset style="border:0px solid;background-color: #FFFFFF;padding-left: 10px; margin-left: 2%; margin-right: 2%;">' . utf8_encode($diagnosticos[0][5]) . '</fieldset></td></tr>';
            $cadena.= '</table></fieldset><br>';
        }
        return $cadena;
    }

    public function hstrDiagnostico($idPaciente) {
        $oLActoMedico = new LActoMedico();
        $historiaMC = $oLActoMedico->hstrDiagnostico($idPaciente);
        $cadena = "";
        if ($historiaMC) {
            $fechaAnterior = "";
            $idProgramacion = "";
//            $datosMed=$oLActoMedico->atencionMedico($filaExamen[0]);
            foreach ($historiaMC as $i => $value) {
                if ($fechaAnterior == "") {
                    if ($idProgramacion == "") {
                        $datosMed = $oLActoMedico->atencionMedico($historiaMC[$i][8]);
                        $medico_instalacion = " M&eacute;dico : " . htmlentities($datosMed[0][2]) . " " . htmlentities($datosMed[0][3]) . " " . htmlentities($datosMed[0][4]) . " &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $medico_instalacion.=" &nbsp;&nbsp;&nbsp;Consultorio : " . htmlentities($datosMed[0][8]) . " - " . htmlentities($datosMed[0][7]) . " - " . htmlentities($datosMed[0][6]);
                        $idProgramacion = $historiaMC[$i][8];
                    }
                    /* --------------- Abrir ------------------ */
                    $cadena.='<div><br><p class="p1">' . $historiaMC[$i][7] . '</p><br></div>';
                    $cadena.='<div><h2>' . $medico_instalacion . '</h2></div><br>';
                    $cadena.='<fieldset style="margin-left: 10%; margin-right: 10%;font-size: 16px;">';
                    $cadena.='<table width="550" border="0" cellpadding="0" cellspacing="2" align="center">';
                    $cadena.='<tr><td height="30" width="15%" bgcolor="#E8EEFD" align="center" class="letra16"><strong>C&oacute;digo Cie</strong></td><td width="65%" bgcolor="#E8EEFD" align="center" class="letra16"><strong>Descripci&oacute;n</strong></td><td width="20%" bgcolor="#E8EEFD" align="center" class="letra16"><strong>Tipo Diagn&oacute;stico</strong></td></tr>';
                    /* ----------------------------------------- */
                    $cadena.='<tr><td class="letra16">' . htmlentities($historiaMC[$i][1]) . '</td><td class="letra16">' . htmlentities($historiaMC[$i][2]) . '</td><td class="letra16">' . htmlentities($historiaMC[$i][6]) . '</td></tr>';
                    $fechaAnterior = $historiaMC[$i][7];
                } else if ($fechaAnterior == $historiaMC[$i][7]) {
                    $cadena.='<tr><td class="letra16">' . htmlentities($historiaMC[$i][1]) . '</td><td class="letra16">' . htmlentities($historiaMC[$i][2]) . '</td><td class="letra16">' . htmlentities($historiaMC[$i][6]) . '</td></tr>';
                    $fechaAnterior = $historiaMC[$i][7];
                } else {
                    /* --------------- Cerrar ------------------ */
                    $cadena.= '</table></fieldset><br>';
                    /* ----------------------------------------- */
                    /* --------------- Abrir ------------------ */
                    if ($idProgramacion != $historiaMC[$i][8]) {
                        $datosMed = $oLActoMedico->atencionMedico($historiaMC[$i][8]);
                        $medico_instalacion = " M&eacute;dico : " . htmlentities($datosMed[0][2]) . " " . htmlentities($datosMed[0][3]) . " " . htmlentities($datosMed[0][4]) . " &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $medico_instalacion.=" &nbsp;&nbsp;&nbsp;Consultorio : " . htmlentities($datosMed[0][8]) . " - " . htmlentities($datosMed[0][7]) . " - " . htmlentities($datosMed[0][6]);
                        $idProgramacion = $historiaMC[$i][8];
                    }
                    $cadena.='<div><br><p class="p1">' . $historiaMC[$i][7] . '</p><br></div>';
                    $cadena.='<div><h2>' . $medico_instalacion . '</h2></div><br>';
                    $cadena.='<fieldset style=" padding-left: 5px;margin-left: 10%; margin-right: 10%;font-size: 16px;">';
                    $cadena.='<table width="550" border="0" cellpadding="0" cellspacing="2" align="center">';
                    $cadena.='<tr><td height="30" width="15%" bgcolor="#E8EEFD" align="center" class="letra16"><strong>C&oacute;digo Cie</strong></td><td width="65%" bgcolor="#E8EEFD" align="center" class="letra16"><strong>Descripci&oacute;n</strong></td><td width="20%" bgcolor="#E8EEFD" align="center" class="letra16"><strong>Tipo Diagn&oacute;stico</strong></td></tr>';
                    /* ----------------------------------------- */
                    $cadena.='<tr><td class="letra16">' . htmlentities($historiaMC[$i][1]) . '</td><td class="letra16">' . htmlentities($historiaMC[$i][2]) . '</td><td class="letra16">' . htmlentities($historiaMC[$i][6]) . '</td></tr>';
                    $fechaAnterior = $historiaMC[$i][7];
                }
            }
            /* --------------- Cerrar ------------------ */
            $cadena.= '</table></fieldset><br>';
            /* ----------------------------------------- */
        }
        return $cadena;
    }

    public function hstrAntecedentes($idPaciente) {
        $oLActoMedico = new LActoMedico();
        $antecedentes = $oLActoMedico->hstrAntecedentes($idPaciente);
        $cadena = "";
        if ($antecedentes) {
            $fechaAnterior = "";
            foreach ($antecedentes as $i => $value) {
                if ($antecedentes[$i][5] == 1){
                    $vive = "Si";
                }
                    
                else if ($antecedentes[$i][5] == 0){
                     $vive = "No";
                }
                   

                $medico_instalacion = " M&eacute;dico : " . htmlentities($antecedentes[$i][11]) . " " . htmlentities($antecedentes[$i][12]) . " " . htmlentities($antecedentes[$i][13]) . " &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                $medico_instalacion.=" &nbsp;&nbsp;&nbsp;Consultorio : " . htmlentities($antecedentes[$i][17]) . " - " . htmlentities($antecedentes[$i][16]) . " - " . htmlentities($antecedentes[$i][15]);

                if ($fechaAnterior == "") {
                    /* --------------- Abrir ------------------ */
                    $cadena.='<div><br><p class="p1">' . $antecedentes[$i][8] . '</p></div><br>';
                    $cadena.='<div><h2>' . $medico_instalacion . '</h2></div><br>';
                    $fechaAnterior = $antecedentes[$i][8];
                } else if ($fechaAnterior != $antecedentes[$i][8]) {
                    /* --------------- Abrir ------------------ */
                    $cadena.='<div><br><p class="p1">' . $antecedentes[$i][8] . '</p></div><br>';
                    $cadena.='<div><h2>' . $medico_instalacion . '</h2></div><br>';
                    $fechaAnterior = $antecedentes[$i][8];
                }
                $cadena.='<fieldset style=" padding-left: 20px;background-color: #FFFFFF;font-size: 16px;">
                       <table width="500" border="0" cellpadding="0" cellspacing="2" align="center">
                         <tr><td width="20%" class="letra16">Parentesco :</td><td width="30%" class="letra16">' . htmlentities($antecedentes[$i][7]) . '</td>
                         
                         <tr><td width="20%" class="letra16">S&iacute;ntoma :</td><td colspan="3" class="letra16">' . htmlentities($antecedentes[$i][2]) . ' - ' . htmlentities($antecedentes[$i][3]) . '</td></tr>
                         <tr><td width="20%" class="letra16">Descripci&oacute;n :</td><td  colspan="3" class="letra16">' . htmlentities($antecedentes[$i][4]) . '</td></tr>
                       </table>
                    </fieldset><br>';
            }
        }
        return $cadena;
    }

    public function hstrTratamientoMedicamentos($idPaciente) {
        $oLActoMedico = new LActoMedico();
        $medicamentoso = $oLActoMedico->hstrTratamiento($idPaciente, "1");
//$practicaMedica = $oLActoMedico->hstrTratamiento($idPaciente, "2");
        $cadena = "";

        if ($medicamentoso) {
            $fechaAntMedic = "";
            $idProgramacion1 = "";
            $cadena.='<fieldset style="border:0px solid;margin:5px;"><legend>&nbsp; Tratamiento con medicamentos &nbsp;</legend><div style="margin-left: 1%; margin-right: 1%;">';
            $cadena.="<h2 align='center'> Tratamiento con medicamentos </h2>";
            foreach ($medicamentoso as $i => $value) {
                if ($fechaAntMedic == "") {
                    if ($idProgramacion1 == "") {
                        $datosMed = $oLActoMedico->atencionMedico($medicamentoso[$i][8]);
                        $medico_instalacion1 = " Médico : " . ($datosMed[0][2]) . " " . ($datosMed[0][3]) . " " . ($datosMed[0][4]) . " &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $medico_instalacion1.=" Consultorio : " . ($datosMed[0][8]) . " - " . ($datosMed[0][7]) . " - " . ($datosMed[0][6]);
                    }
                    /* --------------- Abrir ------------------ */
                    $cadena.='<div><p class="p1">' . $medicamentoso[$i][7] . '</p><br></div>';
                    $cadena.='<div><h2>' . $medico_instalacion1 . '</h2></div><br>';
                    $fechaAntMedic = $medicamentoso[$i][7];
                    $idProgramacion1 = $medicamentoso[$i][8];
                } else if ($fechaAntMedic != $medicamentoso[$i][7]) {
                    if ($idProgramacion1 != $medicamentoso[$i][8]) {
                        $datosMed = $oLActoMedico->atencionMedico($medicamentoso[$i][8]);
                        $medico_instalacion1 = " Médico : " . ($datosMed[0][2]) . " " . ($datosMed[0][3]) . " " . ($datosMed[0][4]) . " &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $medico_instalacion1.=" &nbsp;&nbsp;&nbsp;Consultorio : " . ($datosMed[0][8]) . " - " . ($datosMed[0][7]) . " - " . ($datosMed[0][6]);
                    }
                    /* --------------- Abrir ------------------ */
                    $cadena.='<div><p class="p1">' . $medicamentoso[$i][7] . '</p><br></div>';
                    $cadena.='<div><h2>' . $medico_instalacion1 . '</h2></div><br>';
                    $fechaAntMedic = $medicamentoso[$i][7];
                    $idProgramacion1 = $medicamentoso[$i][8];
                } else if ($fechaAntMedic == $medicamentoso[$i][7]) {
                    if ($idProgramacion1 != $medicamentoso[$i][8]) {
                        $datosMed = $oLActoMedico->atencionMedico($medicamentoso[$i][8]);
                        $medico_instalacion1 = " M&eacute;dico : " . ($datosMed[0][2]) . " " . ($datosMed[0][3]) . " " . ($datosMed[0][4]) . " &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $medico_instalacion1.=" &nbsp;&nbsp;&nbsp;Consultorio : " . ($datosMed[0][8]) . " - " . ($datosMed[0][7]) . " - " . ($datosMed[0][6]);
                        $cadena.='<div><h2>' . $medico_instalacion1 . '</h2></div><br>';
                        $fechaAntMedic = $medicamentoso[$i][7];
                        $idProgramacion1 = $medicamentoso[$i][8];
                    }
                }
                $cadena.='<fieldset style=" padding-left: 20px;background-color: #FFFFFF;font-size: 16px;">
                   <table width="600" border="0" align="center" cellpadding="0" cellspacing="2">
                      <tr>
                        <td width="15%" class="letra16">Nombre :</td><td width="35%" class="letra16">' . ($medicamentoso[$i][2]) . '</td>
                        <td width="15%" class="letra16">Presentaci&oacute;n :</td><td width="15%" class="letra16">' . ($medicamentoso[$i][5]) . '</td>
                        <td width="15%" class="letra16">Cantidad :</td><td width="5%" class="letra16">' . ($medicamentoso[$i][3]) . '</td>
                      </tr>
                      <tr>
                        <td class="letra16">Observaci&oacute;n :</td><td colspan="5" class="letra16">' . ($medicamentoso[$i][4]) . '</td>
                      </tr>
                    </table>
                    </fieldset><br>';
            }
            $cadena.='</div></fieldset><br>';
        }

        return ($cadena);
    }

    public function hstrTratamientoPracticas($idPaciente) {
        $oLActoMedico = new LActoMedico();
// $medicamentoso = $oLActoMedico->hstrTratamiento($idPaciente, "1");
        $practicaMedica = $oLActoMedico->hstrTratamiento($idPaciente, "2");
        $cadena = "";


        if ($practicaMedica) {
            $fechaAntPract = "";
            $idProgramacion2 = "";
            $cadena.='<fieldset style=" margin:5px;"><legend>&nbsp; Pr&aacute;cticas M&eacute;dicas &nbsp;</legend><div style="margin-left: 1%; margin-right: 1%;">';
            $cadena.="<h2 align='center'> Pr&aacute;cticas M&eacute;dicas </h2>";
            foreach ($practicaMedica as $i => $value) {
                if ($fechaAntPract == "") {
                    if ($idProgramacion2 == "") {
                        $datosMed = $oLActoMedico->atencionMedico($practicaMedica[$i][8]);
                        $medico_instalacion2 = " M&eacute;dico : " . ($datosMed[0][2]) . " " . ($datosMed[0][3]) . " " . ($datosMed[0][4]) . " &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $medico_instalacion2.=" &nbsp;&nbsp;&nbsp;Consultorio : " . ($datosMed[0][8]) . " - " . ($datosMed[0][7]) . " - " . ($datosMed[0][6]);
                    }
                    /* --------------- Abrir ------------------ */
                    $cadena.='<div><p class="p1">' . $practicaMedica[$i][7] . '</p><br></div>';
                    $cadena.='<div><h2>' . $medico_instalacion2 . '</h2></div><br>';
                    $fechaAntPract = $practicaMedica[$i][7];
                    $idProgramacion2 = $practicaMedica[$i][8];
                } else if ($fechaAntPract != $practicaMedica[$i][7]) {
                    if ($idProgramacion2 != $practicaMedica[$i][8]) {
                        $datosMed = $oLActoMedico->atencionMedico($practicaMedica[$i][8]);
                        $medico_instalacion2 = " M&eacute;dico : " . ($datosMed[0][2]) . " " . ($datosMed[0][3]) . " " . ($datosMed[0][4]) . " &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $medico_instalacion2.=" &nbsp;&nbsp;&nbsp;Consultorio : " . ($datosMed[0][8]) . " - " . ($datosMed[0][7]) . " - " . ($datosMed[0][6]);
                    }
                    /* --------------- Abrir ------------------ */
                    $cadena.='<div><p class="p1">' . $practicaMedica[$i][7] . '</p><br></div>';
                    $cadena.='<div><h2>' . $medico_instalacion2 . '</h2></div><br>';
                    $fechaAntPract = $practicaMedica[$i][7];
                    $idProgramacion2 = $practicaMedica[$i][8];
                } else if ($fechaAntPract == $practicaMedica[$i][7]) {
                    if ($idProgramacion2 != $practicaMedica[$i][8]) {
                        $datosMed = $oLActoMedico->atencionMedico($practicaMedica[$i][8]);
                        $medico_instalacion2 = " Médico : " . ($datosMed[0][2]) . " " . ($datosMed[0][3]) . " " . ($datosMed[0][4]) . " &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                        $medico_instalacion2.=" &nbsp;&nbsp;&nbsp;Consultorio : " . ($datosMed[0][8]) . " - " . ($datosMed[0][7]) . " - " . ($datosMed[0][6]);
                        $cadena.='<div><h2>' . $medico_instalacion2 . '</h2></div><br>';
                        $fechaAntPract = $practicaMedica[$i][7];
                        $idProgramacion2 = $practicaMedica[$i][8];
                    }
                }
                $cadena.='<fieldset style=" padding-left: 20px;background-color: #FFFFFF;font-size: 16px;">
                   <table width="600" border="0" align="center" cellpadding="0" cellspacing="2">
                      <tr>
                        <td width="15%" class="letra16">Nombre :</td><td width="60%" class="letra16">' . ($practicaMedica[$i][2]) . '</td>
                        <td width="15%" class="letra16">Codigo Seg :</td><td width="10%" class="letra16">' . ($practicaMedica[$i][5]) . '</td>
                      </tr>
                      <tr>
                        <td class="letra16">Observaci&oacute;n :</td><td colspan="3" class="letra16">' . ($practicaMedica[$i][3]) . '</td>
                      </tr>
                    </table>
                    </fieldset><br>';
            }
            $cadena.='</div></fieldset><br>';
        }
        return utf8_encode($cadena);
    }

    public function hstrMotivoConsulta($idPaciente) {
        $oLActoMedico = new LActoMedico();
        $historiaMC = $oLActoMedico->hstrMotivoConsulta($idPaciente);
        $cadena = "";
        if ($historiaMC) {
            $fechaAnterior = "";
            foreach ($historiaMC as $i => $value) {
                $medico_instalacion = " M&eacute;dico : " . htmlentities($historiaMC[$i][8]) . " " . htmlentities($historiaMC[$i][9]) . " " . htmlentities($historiaMC[$i][10]) . " &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                $medico_instalacion.=" &nbsp;&nbsp;&nbsp;Consultorio : " . htmlentities($historiaMC[$i][14]) . " - " . htmlentities($historiaMC[$i][13]) . " - " . htmlentities($historiaMC[$i][12]);
                if ($fechaAnterior == "") {
                    /* --------------- Abrir ------------------ */
                    $cadena.='<div><br><p class="p1">' . $historiaMC[$i][5] . '</p></div><br>';
                    $cadena.='<div><h2>' . $medico_instalacion . '</h2></div><br>';
                    $fechaAnterior = $historiaMC[$i][5];
                } else if ($fechaAnterior != $historiaMC[$i][5]) {
                    /* --------------- Abrir ------------------ */
                    $cadena.='<div><br><p class="p1">' . $historiaMC[$i][5] . '</p></div><br>';
                    $cadena.='<div><h2>' . $medico_instalacion . '</h2></div><br>';
                    $fechaAnterior = $historiaMC[$i][5];
                }
                $cadena.='<fieldset style=" padding-left: 20px;background-color: #FFFFFF;">
                               <table width="500" border="0" cellpadding="0" cellspacing="2" align="center">
                                 <tr><td width="20%" class="letra16">S&iacute;ntoma :</td><td width="80%" class="letra16">' . htmlentities($historiaMC[$i][2]) . ' - ' . htmlentities($historiaMC[$i][3]) . '</td> </tr>
                                <tr><td class="letra16">Descripci&oacute;n :</td><td class="letra16">' . htmlentities($historiaMC[$i][4]) . '</td> </tr>
                               </table>
                          </fieldset><br>';
            }
        }
        return $cadena;
    }

    public function hstrExamenesMedicos($idPaciente) {
        $oLActoMedico = new LActoMedico();
        $examenes = $oLActoMedico->listaExamenesHC($idPaciente, "xpaciente");
        foreach ($examenes as $filaExamen) {
            $datosMed = $oLActoMedico->atencionMedico($filaExamen[0]);     //  $filaExamen[0] --> idProgramacion
            $medico_instalacion = " M&eacute;dico : " . htmlentities($datosMed[0][2]) . " " . htmlentities($datosMed[0][3]) . " " . htmlentities($datosMed[0][4]) . " &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
            $medico_instalacion.=" &nbsp;&nbsp;&nbsp;Consultorio : " . htmlentities($datosMed[0][8]) . " - " . htmlentities($datosMed[0][7]) . " - " . htmlentities($datosMed[0][6]);
            echo '<div><br><p class="p1">' . $filaExamen[1] . '</p><br></div>';
            echo '<div><h2>' . $medico_instalacion . '</h2></div><br>';

            $this->examenesHC($filaExamen[0], "xitems");
        }
    }

//
//    public function hstrExamenesMedicos_1($idPaciente) {
//        $oLActoMedico = new LActoMedico();
//        $examenes = $oLActoMedico->listaExamenesHC($idPaciente,"xpaciente");
//        $cadena="";
//        foreach ($examenes as $filaExamen) {
//            $cadena.='<h1 align="center">'.$filaExamen[1].'</h1>';
//            $cadena.='<div><h1>'.$filaExamen[3].'</h1></div>';
//            $pruebasExamenes=$oLActoMedico->valoresCampos($filaExamen[2],$filaExamen[0]);
//            /*===========================================================================*/
//            $idPruebaAux='';
//            $numero=count($pruebasExamenes);
//            $i=0;
//            foreach ($pruebasExamenes as $fila) {
//                $i++;
//                $idPrueba=$fila[1];
//                $nombreCampo=$fila[4];
//                $iiDCombo=$fila[8];
//                if(!($idPrueba==$idPruebaAux)) {
//                    $nombrePrueba=$fila[2];
//                    if($i>1) $cadena.='</fieldset>';
//                    $cadena.='<fieldset style=" margin:10px; width:640px; font-size: 16px;background-color: #FFFFFF;"><legend>'.$nombrePrueba.'</legend>';
//                }
//                $iIdTipoDato=$fila[5];
//                switch ($iIdTipoDato) {
//                    case 1: //integer
//                        $cadena.='<div style=" margin:2px; padding: 2px; width: 270px; height:15px;float: left; ">';
//                        $cadena.='<div style=" float: left; width:150px;">'.utf8_encode($nombreCampo).'</div>';
//                        $cadena.='<div style=" float: left; width:100px;">'.$fila[9].'</div></div>';
//                        break;
//
//                    case 2://varchar
//                        $cadena.='<div style=" margin:2px; padding: 2px; width: 550px; height:auto;float: left; ">';
//                        $cadena.='<div style=" float: left; width:auto;">'.utf8_encode($nombreCampo).'</div>';
//                        $cadena.='<div style=" float: left; width:auto;">'.utf8_encode($fila[10]).'</div></div>';
//                        break;
//                    case 3://datetime
//                        $cadena.='<div style=" margin:2px; padding: 2px; width: 320px; height:15px;float: left; ">';
//                        $cadena.='<div style=" float: left; width:150px;">'.utf8_encode($nombreCampo).'</div>';
//                        $cadena.='<div style=" float: left; width:150px;"  >'.$fila[11].'</div></div>';
//                        break;
//                    case 4: //decimal
//                        $cadena.='<div style=" margin:2px; padding: 2px; width: 320px; height:15px;float: left; ">';
//                        $cadena.='<div style=" float: left; width:150px;">'.utf8_encode($nombreCampo).'</div>';
//                        $cadena.='<div style=" float: left; width:150px;">'.$fila[12].'</div></div>';
//                        break;
//                    case 5://bolean
//
//                        $cadena.='<div style=" margin:2px; padding: 2px; width: 320px; height:15px;float: left; ">';
//                        $cadena.='<div style=" float: left; width:150px;">'.utf8_encode($nombreCampo).'</div>';
//                        $cadena.='<div style=" float: left; width:50px;">';
//                        if($fila[13]=='1') {
//                            $cadena.='si';
//                        }else {
//                            if($fila[13]=='0') {
//                                $cadena.='no';
//                            }else {
//                                $cadena.='null';
//                            }
//                        }
//                        $cadena.='</div></div>';
//                        break;
//                    case 6:  //combo
//                        $arrayCombo=$this->arrayComboExamenes($iiDCombo);
//                        $iCombo=$fila[14];
//                        $valorCombo=$this->valorComboExamen($iCombo);
//                        //print_r($arrayCombo);
//                        $cadena.='<div style=" margin:2px; padding: 2px; width: 320px; height:15px;float: left; ">';
//                        $cadena.='<div style=" float: left; width:150px;">'.utf8_encode($nombreCampo).'</div>';
//                        $cadena.='<div style=" float: left; width:150px;">'.$valorCombo.'</div></div>';
//
//                        break;
//                    case 7: //decimal
//                        $cadena.='<div style=" margin:2px; padding: 2px; width: auto; height:auto;float: left; ">';
//                        $cadena.='<div style=" float: left; width:150px;">'.utf8_encode($nombreCampo).'</div>';
//                        $cadena.='<div style=" float: left; width:auto;">'.utf8_encode($fila[15]).'</div></div>';
//
//                        break;
//                }
//
//                if($i==$numero) $cadena.='</fieldset>';
//                $idPruebaAux=$fila[1];
//            }
//        }
//        /*===========================================================================*/
//        return $cadena;
//    }

    public function obtenerCodigoPaciente($idpersona) {
        $oLActoMedico = new LActoMedico();
        $codPaciente = $oLActoMedico->obtenerCodigoPaciente($idpersona);
        return $codPaciente[0][0] . "|";
    }

    public function cargarTablaLaboratorio($codPersona, $opcion) {
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->cargarTablaLaboratorio($codPersona, $opcion);
        return $this->tablaLaboratorio($arrayFilas);
    }

    public function cargarTablaLaboratorio_confiltro($codPersona, $datos) {
        $cadena = "and ";
        switch ($datos[3]) {
            case "desde_dato":
                break;
            case "hasta_dato":
                break;
            case "all":
                break;
            case "desde":
                $cadena.=" a.fechor > CONVERT(datetime, ''" . $datos[0] . " 00:00:00'',103)";
                break;
            case "hasta":
                $cadena.=" a.fechor < CONVERT(datetime, ''" . $datos[1] . " 23:59:59'',103)";
                break;
            case "entre":
                //$cadena.=" a.fechor between CONVERT(datetime,''".$datos[0]." 00:00:00'',103) and CONVERT(datetime,''".$datos[1]." 23:59:59'',103)";
                $cadena.=" a.fechor > CONVERT(datetime,''" . $datos[0] . " 00:00:00'',103) AND a.fechor < CONVERT(datetime,''" . $datos[1] . " 23:59:59'',103)";
                break;
            case "medico":
                //e.v_apepat, e.v_apemat, e.v_nomper
                $cadena.=" ( e.v_nomper LIKE ''" . $datos[2] . "%'' OR e.v_apemat LIKE ''" . $datos[2] . "%'' OR e.v_apepat LIKE ''" . $datos[2] . "%'')";
                break;
            case "examen":
                $cadena.=" d.v_desc_ser_pro LIKE ''%" . $datos[2] . "%''";
                break;
        }

        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->cargarTablaLaboratorio($codPersona, $cadena);
        return $this->tablaLaboratorio($arrayFilas);
    }

    function tablaLaboratorio($arrayFilas) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayCabecera = array(0 => "Fecha", 1 => "Exámen", 2 => "Médico", 3 => "idregd", 4 => "idreg", 5 => "idresult", 6 => "codPersona");
        $arrayTamano = array(0 => "70", 1 => "*", 2 => "*", 3 => "*", 4 => "*", 5 => "*", 6 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "true", 5 => "true", 6 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function detalleLaboratorio($idReult) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->detalleLaboratorio($idReult);
        $arrayCabecera = array(0 => "Item", 1 => "Método", 2 => "Resultado", 3 => "Unidad", 4 => "Rango Referencial", 5 => "tipo", 6 => "orden");
        $arrayTamano = array(0 => "220", 1 => "120", 2 => "80", 3 => "80", 4 => "300", 5 => "50", 6 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "true", 6 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

//
//    public function cargarHistoriasPacientes($idpersona) {
//        $oLActoMedico = new LActoMedico();
//        $resultado = $oLActoMedico->arbolHCItems();
//        return $o_TablaHtmlx->generaArbol($resultado);
//    }
    public function vistaLaboratorio($id) {
//        $oLActoMedico = new LActoMedico();
//        $titulo=$text;
//        $idDiv="div_items".$id;
        require_once("../../cvista/actomedico/vistaLaboratorio.php");
    }

    public function vistaOdontograma($idPaciente) {
        require_once("../../cvista/actomedico/vistaOdontograma.php");
    }

    ///////////////////fin de funciones de giancarlo//////////////////////////////
    //////////////////inicio de funciones de luis/////////////////////////////////
    public function atencionInmediataActoMedico($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->atencionInmediataActoMedico($datos);
        return $resultado;
    }

    public function xmlTablaProductosTratamientosHC($datos, $accion) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->listaProductosMedicamentosos($datos, $accion);
        $arrayCabecera = array("0" => "Código", "1" => "Descripción", "2" => "Presentación", "3" => "Stock", "4" => "Precio", "5" => "Acción");
        $arrayTamano = array("0" => "100", "1" => "*", "2" => "100", "3" => "100", "4" => "60", "5" => "60");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "img", "5" => "img");
        $arrayAlineacion = array("0" => "center", "1" => "left", "2" => "center", "3" => "center", "4" => "center", "5" => "center");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0);
    }

    public function agregarMedicamentoRecetaMedicaHC($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->agregarMedicamentoRecetaMedicaHC($datos);
        print_r($resultado);
        return $resultado;
    }

    public function aCargarCuerpoHC($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->lCargarCuerpoHC($datos);
        // print_r($datos);
        require_once '../../cvista/actomedico/vistaAtencionMedicaHC.php';
        //return $resultado;
    }

    public function aHistoriaOdontograma($c_cod_per) {
        $oLActoMedico = new LActoMedico();
        //$resultado = $oLActoMedico->lHistoriaOdontograma($c_cod_per) ;
        //print_r($resultado);
        require_once '../../cvista/actomedico/vistaHistoriaOdontograma.php';
        //return $resultado;
    }

    public function comboFechaAtenciones($c_cod_per) {
        $oLActoMedico = new LActoMedico();
        $datos = $oLActoMedico->comboFechaAtenciones($c_cod_per);
        $resultado.='<option value="x">Todos...</option>';
        for ($x = 0; $x <= (count($datos) - 1); $x++) {
            $resultado.='<option value=' . $x . "//" . $datos[$x][0] . '>' . ($x + 1) . ' - ' . $datos[$x][1] . '</option>';
        }
        return $resultado;
    }

    public function comboDientesAtenciones($c_cod_per) {
        $oLActoMedico = new LActoMedico();
        $datos = $oLActoMedico->comboDientesAtenciones($c_cod_per);
        $resultado.='<option value="x">Todos...</option>';
        for ($x = 0; $x <= (count($datos) - 1); $x++) {
            $resultado.='<option value=' . $datos[$x][0] . '>' . $datos[$x][1] . '</option>';
        }
        return $resultado;
    }

    public function aVerificarPaqueteEtareo($datos) {
        $oLActoMedico = new LActoMedico();
        $datos = $oLActoMedico->lVerificarPaqueteEtareo($datos);
        $resultado = $datos[0][0];
        return $resultado;
    }

    public function aCargarPaqueteDiagnostico($datos) {
        $oLActoMedico = new LActoMedico();
        $datos = $oLActoMedico->lCargarPaqueteDiagnostico($datos);
        $resultado = $datos[0][0];
        return $resultado;
    }

    public function validarSeleccion($datos) {
        if ($datos['text'] == 1) {
            $datos['text'] = 2;
        } else if ($datos['text'] == 2) {
            $datos['text'] = 1;
        }
        $resultado = '';
        $resultado.='<select id="diente' . $datos['text'] . '_' . $datos["id"] . '" onChange="validarSeleccion(' . "'diente" . $datos['text'] . '_' . $datos['id'] . "'" . ',' . $datos['text'] . ');">
                        <option value="0">Seleccionar...</option>';
        if ($datos['valor'] >= 11 && $datos['valor'] <= 28) {
            for ($y = 1; $y <= 2; $y++) {
                for ($x = 1; $x <= 8; $x++) {
                    $resultado.= '<option value="' . $y . $x . '">' . $y . $x . '</option>';
                }
            }
        } else if ($datos['valor'] >= 31 && $datos['valor'] <= 48) {
            for ($y = 3; $y <= 4; $y++) {
                for ($x = 1; $x <= 8; $x++) {
                    $resultado.= '<option value="' . $y . $x . '">' . $y . $x . '</option>';
                }
            }
        } else if ($datos['valor'] >= 51 && $datos['valor'] <= 65) {
            for ($y = 5; $y <= 6; $y++) {
                for ($x = 1; $x <= 5; $x++) {
                    $resultado.= '<option value="' . $y . $x . '">' . $y . $x . '</option>';
                }
            }
        } else if ($datos['valor'] >= 71 && $datos['valor'] <= 85) {
            for ($y = 7; $y <= 8; $y++) {
                for ($x = 1; $x <= 5; $x++) {
                    $resultado.= '<option value="' . $y . $x . '">' . $y . $x . '</option>';
                }
            }
        } else {
            for ($y = 1; $y <= 4; $y++) {
                for ($x = 1; $x <= 8; $x++) {
                    $resultado.= '<option value="' . $y . $x . '">' . $y . $x . '</option>';
                }
            }
            for ($y = 5; $y <= 8; $y++) {
                for ($x = 1; $x <= 5; $x++) {
                    $resultado.= '<option value="' . $y . $x . '">' . $y . $x . '</option>';
                }
            }
        }
        return $resultado;
    }

    public function aPreguardarRectaMedica($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->lPreguardarRectaMedica($datos);
        return $resultado[0][0];
    }

    public function eliminarMedicamentoRecetaMedicaHC($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->eliminarMedicamentoRecetaMedicaHC($datos);
        return $resultado;
    }

    public function obtenerDatosFiliacionActoMedico($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->obtenerDatosFiliacionActoMedico($datos);
        $imagen = $resultado["ruta"] . $resultado["foto"];
        // $verifica = @fopen($resultado["ruta"] . $resultado["foto"], "r");
        // if (!$verifica) {
        //   $imagen = $resultado["ruta"] . "anonimo_00.jpg";
        // }
        //@fclose($verifica);
//        if (!file_exists($resultado["ruta"].$resultado["foto"]))
//            $resultado["foto"]=$resultado["ruta"]."anonimo_00.jpg";
        require_once '../../cvista/actomedico/vistaAfiliacion.php';
        return $resultado;
    }

    public function cargaFechaVencimientoRecetaMedica($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->obtenerFechaVencimientoRecetaMedica($datos);
        return $resultado;
    }

    public function nsmModulosPorAfiliacion($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->nsmModulosPorAfiliacion($datos);
        return $resultado;
    }

    public function nsmModulosporServicio($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->nsmModulosporServicio($datos);
        return $resultado;
    }

    public function xmlTablaPracticasMedicasTratamientosHC($datos, $accion) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->listaPracticasMedicas($datos, $accion);
        $arrayCabecera = array("0" => "Código", "1" => "Descripción", "2" => "Cod.Segus", "3" => "Precio", "4" => "Acción");
        $arrayTamano = array("0" => "100", "1" => "*", "2" => "80", "3" => "60", "4" => "60");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "img", "4" => "img");
        $arrayAlineacion = array("0" => "center", "1" => "left", "2" => "center", "3" => "center", "4" => "center");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0);
    }

    public function xmlTablapreciosProductosServicios($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->listapreciosProductosServicios($datos);
        $arrayCabecera = array("0" => "Código", "1" => "Afiliación", "2" => "Precio");
        $arrayTamano = array("0" => "100", "1" => "*", "2" => "60");
        $arrayTipo = array("0" => "ed", "1" => "ed", "2" => "ed");
        $arrayAlineacion = array("0" => "center", "1" => "left", "2" => "center");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0);
    }

    public function actualizarPaquetesPersona($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->actualizarPaquetesPersona($datos);
        return $resultado;
    }

    public function cargarPaquetesActualizados($datos) {
        $oLActoMedico = new LActoMedico();
        $datosPersona['codpersona'] = $datos["c_cod_per"];

        require_once("../../cvista/actomedico/modulosHC/vPaquetesActualizados.php");
    }

    public function agregarPracticaMedicaHC($datos) {
        $oLActoMedico = new LActoMedico();

        $resultado = $oLActoMedico->agregarPracticaMedicaHC($datos);
        return $resultado;
    }

    public function preGrabarTratamientoMedicamentoso($datos) {
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->preGrabarTratamientoMedicamentoso($datos);
        return $array[0][0];
    }

    public function preguardarFechaVencimientoReceta($datos) {
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->preguardarFechaVencimientoReceta($datos);
    }

    public function preGrabarTratatamientoPracticaMedica($datos) {
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->preGrabarTratatamientoPracticaMedica($datos);
        return $array[0][0];
    }

    public function cargaTratamientosMedicamentososPreguardados($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->cargaTratamientosMedicamentososPreguardados($datos);
        return $resultado;
    }

    public function aDuplicarReceta($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->lDuplicarReceta($datos);
        return $resultado;
    }

    public function aCadenaRecetas($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->lCadenaRecetas($datos);
        return $resultado;
    }

    public function cargaTratamientosPracticasMedicasPreguardados($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->cargaTratamientosPracticasMedicasPreguardados($datos);
        return $resultado;
    }

    public function cargaTratamientosAnteriores($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->cargaTratamientosAnteriores($datos);
        switch ($datos["tipotratamiento"]) {
            case 1: $nombretratamiento = "Medicamentos Recetados";
                $cantidadhidden = "false";
                break;
            case 2: $nombretratamiento = "Servicios Brindados";
                $cantidadhidden = "true";
                break;
        }
        $arrayCabecera = array("0" => "idTratamiento", "1" => "CodigoProgramacion", "2" => "Fecha", "3" => "Servicio", "4" => $nombretratamiento, "5" => "Cantidad", "6" => "Modo Aplicacion", "7" => "Acción");
        $arrayTamano = array("0" => "60", "1" => "60", "2" => "60", "3" => "*", "4" => "*", "5" => "80", "6" => "60", "7" => "60");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "ro", "7" => "img");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "left", "3" => "left", "4" => "left", "5" => "center", "6" => "center", "7" => "center");
        $arrayHidden = array("0" => "true", "1" => "true", "2" => "false", "3" => "false", "4" => "false", "5" => $cantidadhidden, "6" => "true", "7" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function mostrarVentanaTratamientoAnterior($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->obtenerDatosTratamientoAnterior($datos);
        require_once '../../cvista/actomedico/tratamientoAnterior.php';
    }

    public function agregarDiagnosticoHC($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->agregarDiagnosticoHC($datos);
        return $resultado;
    }

    public function agregarDiagnosticoPreguardadoHC($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->agregarDiagnosticoPreguardadoHC($datos);
        return $resultado;
    }

    function comboTipoIngreso($nombre, $indSel, $disabled) {
        $o_LActoMedico = new LActoMedico();
        //$nomCondicionDeIngreso = ($nomCondicionDeIngreso==''||$nomCondicionDeIngreso==null)?'%':$nomCondicionDeIngreso;
        $datosCombo = $o_LActoMedico->comboTipoIngreso($nombre);
        $o_Combo = new Combo($datosCombo);
        $opcionesHTML = $o_Combo->getOptionsHTML($indSel);

        if ($disabled == 1) {
            $valDisabled = "disabled";
        } else {
            $valDisabled = ""; //Cuando es cero
        }

        $row_ochg = "onchange=\"javascript:cambiarEstadoDiagnostico();\"";
        $row_ini = "<select id=\"$nombre\" " . $row_ochg . " " . $valDisabled . ">";
        $row_fin = "</select>";
        $comboHTML = $row_ini . $opcionesHTML . $row_fin;
        return $comboHTML;
    }

    public function comboTipoDiagnostico($nombre, $indSel, $disabled) {
        $o_LActoMedico = new LActoMedico();
        //$nomCondicionDeIngreso = ($nomCondicionDeIngreso==''||$nomCondicionDeIngreso==null)?'%':$nomCondicionDeIngreso;
        $datosCombo = $o_LActoMedico->comboTipoDiagnostico($nombre);
        $o_Combo = new Combo($datosCombo);
        $opcionesHTML = $o_Combo->getOptionsHTML($indSel);

        if ($disabled == 1) {
            $valDisabled = "disabled";
        } else {
            $valDisabled = ""; //Cuando es cero
        }

        $row_ochg = "onchange=\"javascript:cambiarEstadoDiagnostico();\"";
        $row_ini = "<select id=\"$nombre\" " . $row_ochg . " " . $valDisabled . ">";
        $row_fin = "</select>";
        $comboHTML = $row_ini . $opcionesHTML . $row_fin;
        return $comboHTML;
    }

    function comboDosificacion($nombre, $indSel, $numdiv) {
        $o_LActoMedico = new LActoMedico();
        //$nomCondicionDeIngreso = ($nomCondicionDeIngreso==''||$nomCondicionDeIngreso==null)?'%':$nomCondicionDeIngreso;
        $datosCombo = $o_LActoMedico->comboDosificacion($nombre);
        $o_Combo = new Combo($datosCombo);
        $opcionesHTML = $o_Combo->getOptionsHTML($indSel);
        $row_ochg = "onchange=\"javascript:cambiarEstadoTratamientoMedicamentoso('" . $numdiv . "');\"";
        $row_ini = "<select id=\"$nombre\" " . $row_ochg . ">";
        $row_fin = "</select>";
        $comboHTML = $row_ini . $opcionesHTML . $row_fin;
        return $comboHTML;
    }

    public function comboDestinoCitaEssalud($nombre, $indSel) {
        $o_LActoMedico = new LActoMedico();
        //$nomCondicionDeIngreso = ($nomCondicionDeIngreso==''||$nomCondicionDeIngreso==null)?'%':$nomCondicionDeIngreso;
        $datosCombo = $o_LActoMedico->comboDestinoCitaEssalud($nombre);
        $o_Combo = new Combo($datosCombo);
        $opcionesHTML = $o_Combo->getOptionsHTML($indSel);
        $row_ochg = "";
        $row_ini = "<select id=\"$nombre\" " . $row_ochg . " onchange='grabarDestinoEssalud()'>";
        $row_fin = "</select>";
        $comboHTML = $row_ini . $opcionesHTML . $row_fin;
        return $comboHTML;
    }

    public function comboTipoCitaEssalud($nombre, $indSel) {
        $o_LActoMedico = new LActoMedico();
        //$nomCondicionDeIngreso = ($nomCondicionDeIngreso==''||$nomCondicionDeIngreso==null)?'%':$nomCondicionDeIngreso;
        $datosCombo = $o_LActoMedico->comboTipoCitaEssalud($nombre);
        $o_Combo = new Combo($datosCombo);
        $opcionesHTML = $o_Combo->getOptionsHTML($indSel);
        $row_ochg = "";
        $row_ini = "<select id=\"$nombre\" " . $row_ochg . " onchange='grabarTipoCitaEssalud()'>";
        $row_fin = "</select>";
        $comboHTML = $row_ini . $opcionesHTML . $row_fin;
        return $comboHTML;
    }

    public function numeroSesionEssalud($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->numeroSesionEssalud($datos);
        return $resultado[0]["respuesta"];
    }

    public function aAfiliacionCorrecta($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->lAfiliacionCorrecta($datos);
        return $resultado[0]["respuesta"];
    }

    public function agregarOtroSintoma() {
        $oLActoMedico = new LActoMedico();
        $nombreSintoma = "";
        $accion = 3;
        $array = $oLActoMedico->agregarOtroSintoma($nombreSintoma, $accion);
        return $array[0]["arreglo"];
    }

    public function agregarOtroDiagnosticoHC() {
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->agregarOtroDiagnosticoHC();
        return $array[0]["arreglo"];
    }

    public function preGrabarDiagnostico($datos) {
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->preGrabarDiagnostico($datos);
        return $array[0]["respuesta"];
    }

    public function eliminarDiagnostico($datos) {
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->eliminarDiagnostico($datos);
        //return $array[0]["respuesta"];
    }

    public function cargaDiagnosticosPreguardados($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->cargaDiagnosticosPreguardados($datos);
        return $resultado;
    }

    public function guardarAtencionMedicaHC($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->guardarAtencionMedicaHC($datos);
        return $resultado;
    }

    public function proximaCitaSugeridaArray($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->proximaCitaSugeridaArray($datos);
        return $resultado;
    }

    public function cambiarEstadoNoAtendido($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->cambiarEstadoNoAtendido($datos);
        return $resultado;
    }
    
    public function anularPago($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->anularPago($datos);
        return $resultado;
    }
    public function anularComprobantePago($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->anularComprobantePago($datos);
        return $resultado;
    }
    

    public function aDesconfirmarCita($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->lDesconfirmarCita($datos);
        return $resultado;
    }

    /////////////////fin de  funciones de luis////////////////////////////////////

    public function cargaDiagnosticosAnteriores($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->cargaDiagnosticosAnteriores($datos);
        $arrayCabecera = array("0" => "codigointernoCIE", "1" => "CodigoProgramacion", "2" => "Fecha", "3" => "CIE", "4" => "Descripción", "5" => "Tipo Diagnóstico", "6" => "Acción");
        $arrayTamano = array("0" => "60", "1" => "60", "2" => "60", "3" => "50", "4" => "*", "5" => "100", "6" => "60");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro", "4" => "ro", "5" => "ro", "6" => "img");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "left", "3" => "left", "4" => "left", "5" => "center", "6" => "center");
        $arrayHidden = array("0" => "true", "1" => "true", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function mostrarVentanaDiagnosticoAnterior($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->obtenerDatosDiagnosticoAnterior($datos);
        require_once '../../cvista/actomedico/DiagnosticoAnterior.php';
    }

    public function cargaDiagnosticosAnterioresPopUp($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->cargaDiagnosticosAnteriores($datos);
        $arrayCabecera = array("0" => "codigointernoCIE", "1" => "CodigoProgramacion", "2" => "Fecha", "3" => "CIE", "4" => "Descripción", "5" => "Tipo Diagnóstico", "6" => "Acción");
        $arrayTamano = array("0" => "60", "1" => "60", "2" => "60", "3" => "50", "4" => "*", "5" => "100", "6" => "60");
        $arrayTipo = array("0" => "ed", "1" => "ed", "2" => "ed", "3" => "ed", "4" => "ed", "5" => "ed", "6" => "img");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "left", "3" => "left", "4" => "left", "5" => "center", "6" => "center");
        $arrayHidden = array("0" => "true", "1" => "true", "2" => "false", "3" => "false", "4" => "false", "5" => "false", "6" => "true");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function xmlTablaDiagnosticoAnteriorPopUp($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->cargaDiagnosticoAnteriorPopUp($datos);
        $arrayCabecera = array("0" => "codigointernoCIE", "1" => "CodigoProgramacion", "2" => "CIE", "3" => "Descripción", "4" => "Tipo Diagnóstico");
        $arrayTamano = array("0" => "60", "1" => "60", "2" => "50", "3" => "*", "4" => "100");
        $arrayTipo = array("0" => "ed", "1" => "ed", "2" => "ed", "3" => "ed", "4" => "ed");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "left", "3" => "left", "4" => "center");
        $arrayHidden = array("0" => "true", "1" => "true", "2" => "false", "3" => "false", "4" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function aTablaProcedimientoOdontologico($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->lTablaProcedimientoOdontologico($datos);
        $arrayCabecera = array("0" => "Id", "1" => "Descripcion", "2" => "nivel", "3" => "Jerarquico", "4" => "...");
        $arrayTamano = array("0" => "60", "1" => "*", "2" => "50", "3" => "*", "4" => "100");
        $arrayTipo = array("0" => "ed", "1" => "ed", "2" => "ed", "3" => "ed", "4" => "ed");
        $arrayAlineacion = array("0" => "center", "1" => "left", "2" => "left", "3" => "left", "4" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "true", "3" => "true", "4" => "true");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function aPosicionSimbolo($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->lPosicionSimbolo($datos);
        return $resultado;
    }

    public function aPosicionSimboloDoble($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->lPosicionSimboloDoble($datos);
        return $resultado;
    }

    public function aPreguardarAntecedenteOdontograma($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->lPreguardarAntecedenteOdontograma($datos);
        return $resultado[0][0];
    }

    /////////////////fin de  funciones de luis////////////////////////////////////


    public function grabarCombo($data) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->grabarCombo($data);
        return $resultado;
    }

    public function grabarCampo($data, $hacer) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->grabarCampo($data, $hacer);
        return $resultado;
    }

    public function resultado_prueba() {
//        $oLActoMedico = new LActoMedico();
//        $arrayFilas = $oLActoMedico->listaPruebas('todos');
//        $o_TablaHtmlx = $this->setTabla($arrayFilas);
//        return $o_TablaHtmlx;
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->listaPruebas('todos');
        $arrayCabecera = array(0 => "Examen", 1 => "Id", 2 => "Titulo", 3 => "Orden", 4 => "Estado", 5 => "", 6 => "");
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*", 3 => "*", 4 => "*", 5 => "30", 6 => "30");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img", 6 => "img");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "pointer", 6 => "pointer");
        $arrayHidden = array(0 => "false", 1 => "true", 2 => "false", 3 => "true", 4 => "true", 5 => "false", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "center", 6 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function datosPruebas($idversion) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->datosPruebas('activados', $idversion);
        $arrayCabecera = array(0 => "Id", 1 => "Titulo", 2 => "idEstado", 3 => "Estado");
        $arrayTamano = array(0 => "*", 1 => "200", 2 => "*", 3 => "90");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "", 1 => "", 2 => "", 3 => "");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "true", 3 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function buscarPrueba($nomPrueba) {
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->buscarPrueba($nomPrueba);
        $o_TablaHtmlx = $this->setTabla($arrayFilas);
        return $o_TablaHtmlx;
    }

    function setTabla($arrayFilas) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayCabecera = array(0 => "Id", 1 => "Titulo", 2 => "Orden", 3 => "idEstado", 4 => "Estado", 5 => "Acción", 6 => "#cspan");
        $arrayTamano = array(0 => "*", 1 => "140", 2 => "50", 3 => "*", 4 => "70", 5 => "50", 6 => "50");
        $arrayTipo = array(0 => "ed", 1 => "ed", 2 => "ed", 3 => "ed", 4 => "ed", 5 => "img", 6 => "img");
        $arrayCursor = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "", 5 => "pointer", 6 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "true", 4 => "false", 5 => "false", 6 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function act_desPrueba($idPrueba, $hacer) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->act_desPrueba($idPrueba, $hacer);
        return $resultado;
    }

    function act_desExamen($idExamen, $hacer) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->act_desExamen($idExamen, $hacer);
        return $resultado;
    }

    function act_desExamenPrueba($idExamenPrueba, $estado) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->act_desExamenPrueba($idExamenPrueba, $estado);
        return $resultado;
    }

    function act_desExamenServicio($idExamenServicio, $estado) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->act_desExamenServicio($idExamenServicio, $estado);
        return $resultado;
    }

    function editaCampos($idPrueba, $nomPrueba) {
        $oLActoMedico = new LActoMedico();
        $camposx = $oLActoMedico->editaCampos($idPrueba);
        if (count($camposx) < 1) {
            $camposx = "";
            $disabled = "";
        } else {
            $disabled = "disabled";
        }
        $cboTipoCampo = $oLActoMedico->cargarTipoCampo();
        $hidIdPrueba = $idPrueba;
        $descPrueba = $nomPrueba;
        $act1 = 0;
        $des1 = 1;
        require_once("../../cvista/actomedico/nuevoCampo.php");
//        return $resultado;
    }

    function eliminarDbCampo($idCampo, $idCombo) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->eliminarDbCampo($idCampo, $idCombo);
        return $resultado;
    }

    function editarCombo($idCombo) {
        $oLActoMedico = new LActoMedico();
        $maestro = $oLActoMedico->editarCombo($idCombo, 'maestro');
        $detalle = $oLActoMedico->editarCombo($idCombo, 'detalle');
        $idCombo = $maestro[0][0];
        $nomCombo = $maestro[0][1];
        $editarCombo = "si";
        require_once("../../cvista/actomedico/nuevoCombo.php");
    }

    function eliminaDbCombo($idCombo, $idValcombo) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->eliminaDbCombo($idCombo, $idValcombo);
        return $resultado;
    }

    /*  function examenNoAsignado() {
      $oLActoMedico = new LActoMedico();
      $resultado = $oLActoMedico->examenNoAsignado();
      return $resultado;
      } */

    function asignarExamenPrueba($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->asignarExamenPrueba($datos);
        return $resultado;
    }

    function asignarExamenServicio($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->asignarExamenServicio($datos);
        return $resultado;
    }

    function selectExamenPrueba($idExamen) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->selectExamenPrueba($idExamen);
        $arrayCabecera = array(0 => "idp", 1 => "Prueba", 2 => "estadop", 3 => "Estado Prueba", 4 => "", 5 => "ide", 6 => "Examen", 7 => "estadoe", 8 => "Estado Examen", 9 => "estadoExPr", 10 => "Acción", 11 => "idExPr");
        $arrayTamano = array(0 => "40", 1 => "255", 2 => "*", 3 => "110", 4 => "10", 5 => "*", 6 => "255", 7 => "*", 8 => "110", 9 => "60", 10 => "60", 11 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "img", 11 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "pointer", 11 => "default");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "true", 3 => "true", 4 => "false", 5 => "true", 6 => "false", 7 => "true", 8 => "true", 9 => "true", 10 => "false", 11 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "left", 8 => "left", 9 => "left", 10 => "center", 11 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function cargarTablaCentroCostosServicios($datos) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->cargarTablaCentroCostosServicios($datos);
        $arrayCabecera = array(0 => "Id", 1 => "Servicio", 2 => "Codigo Centro Costo", 3 => "Centro Costo");
        $arrayTamano = array(0 => "80", 1 => "*", 2 => "*", 3 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true", 3 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function selectExamenServicio($idExamen) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->selectExamenServicio($idExamen);
        $arrayCabecera = array(0 => "idp", 1 => "Prueba", 2 => "estadop", 3 => "Estado Prueba", 4 => "", 5 => "ids", 6 => "Servicio", 7 => "estados", 8 => "Estado Servicio", 9 => "estadoExSe", 10 => "Acción", 11 => "idExSe");
        $arrayTamano = array(0 => "*", 1 => "250", 2 => "*", 3 => "110", 4 => "10", 5 => "*", 6 => "260", 7 => "*", 8 => "110", 9 => "60", 10 => "60", 11 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "img", 11 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "pointer", 11 => "default");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "true", 3 => "true", 4 => "false", 5 => "true", 6 => "false", 7 => "true", 8 => "true", 9 => "true", 10 => "false", 11 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "left", 8 => "left", 9 => "left", 10 => "center", 11 => "center");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function selectCombo() {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->selectCombo();
        $arrayCabecera = array(0 => "idp", 1 => "Nombre Combo");
        $arrayTamano = array(0 => "*", 1 => "200");
        $arrayTipo = array(0 => "ro", 1 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pointer");
        $arrayHidden = array(0 => "true", 1 => "false");
        $arrayAling = array(0 => "left", 1 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function selectValorCombo($idCombo) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->selectValorCombo($idCombo);
        $arrayCabecera = array(0 => "Select", 1 => "Values");
        $arrayTamano = array(0 => "150", 1 => "70");
        $arrayTipo = array(0 => "ro", 1 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default");
        $arrayHidden = array(0 => "false", 1 => "false");
        $arrayAling = array(0 => "left", 1 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    function listaServiciosx() {
        $oLLogistica = new LLogistica();
        $resultado = $oLLogistica->getProductos("", "", "0018");
        return $resultado;
    }

    function listaServicios() {
        $oLLogistica = new LLogistica();
        $o_TablaHtmlx = new tablaDHTMLX();
        $resultado = $oLLogistica->getProductos("", "", "0018");
        $arrayFilas = array();
        foreach ($resultado as $k => $value) {
            $arrayFilas[$k][0] = $resultado[$k][0];
            $arrayFilas[$k][1] = $resultado[$k][1];
        }
        $arrayCabecera = array(0 => "idservicio", 1 => "Servicios");
        $arrayTamano = array(0 => "150", 1 => "400");
        $arrayTipo = array(0 => "ro", 1 => "ro");
        $arrayCursor = array(0 => "default", 1 => "pontier");
        $arrayHidden = array(0 => "true", 1 => "false");
        $arrayAling = array(0 => "left", 1 => "left");
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    /////////////////////////////////////////Funciones del PENDEX XD///////////////////////////////////////////
    //Dibuja combo de tipos de motivo de consulta
    public function listaCondicionDeIngreso($nomCondicionDeIngreso) {
        $o_LActoMedico = new LActoMedico();
        $nomCondicionDeIngreso = ($nomCondicionDeIngreso == '' || $nomCondicionDeIngreso == null) ? '%' : $nomCondicionDeIngreso;

        $datosCombo = $o_LActoMedico->getArrayCondicionDeIngreso($nomCondicionDeIngreso);
        $o_Combo = new Combo($datosCombo);
        $opcionesHTML = $o_Combo->getOptionsHTML();
        $row_ochg = "onchange=\"\"";
        $row_ini = "<select id=\"cboTipoIngreso1\" " . $row_ochg . ">";
        $row_fin = "</select>";
        $comboHTML = $row_ini . $opcionesHTML . $row_fin;
        return $comboHTML;
    }

    /*
      public function listaClasificacionMotivoConsulta($nomClasificacionMotivoConsulta){
      $o_LActoMedico = new LActoMedico();
      $nomClasificacionMotivoConsulta = ($nomClasificacionMotivoConsulta==''||$nomClasificacionMotivoConsulta==null)?'%':$nomClasificacionMotivoConsulta;

      $datosCombo = $o_LActoMedico->getArrayClasificacionMotivoConsulta($nomClasificacionMotivoConsulta);
      $o_Combo = new Combo($datosCombo);
      $opcionesHTML = $o_Combo->getOptionsHTML();
      $row_ochg = "onchange=\"\"";
      $row_ini = "<select id=\"cboClasifMotivoConsulta1\" ".$row_ochg.">";
      $row_fin = "</select>";
      $comboHTML=$row_ini.$opcionesHTML.$row_fin;
      return $comboHTML;
      } */

    public function xmlTablaSintomas($nombreSintoma, $accion) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->spListaSintomas($nombreSintoma, $accion);

        $arrayCabecera = array("0" => "Id", "1" => "Codigo", "2" => "Descripcion", "3" => "Accion");
        $arrayTamano = array("0" => "0", "1" => "50", "2" => "*", "3" => "50");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "img");
        $arrayAlineacion = array("0" => "right", "1" => "left", "2" => "left", "3" => "center");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0);
    }

    /*
      public function agregarMotivoDeConsulta($parametros){
      $numSintomas = $parametros['p2'];

      $o_LActoMedico = new LActoMedico();

      //Dibujamos primer combo
      $nomCondicionDeIngreso = ($nomCondicionDeIngreso==''||$nomCondicionDeIngreso==null)?'%':$nomCondicionDeIngreso;

      $datosCombo01 = $o_LActoMedico->getArrayCondicionDeIngreso($nomCondicionDeIngreso);
      $o_Combo01 = new Combo($datosCombo01);
      $opcionesHTML01 = $o_Combo01->getOptionsHTML();
      $row_ochg01 = "onchange=\"\"";
      $row_ini01 = "<select id=\"cboTipoIngreso".$numSintomas."\" ".$row_ochg01.">";
      $row_fin01 = "</select>";
      $comboHTML01=$row_ini01.$opcionesHTML01.$row_fin01;

      //Dibujamos segundo combo
      $nomClasificacionMotivoConsulta = ($nomClasificacionMotivoConsulta==''||$nomClasificacionMotivoConsulta==null)?'%':$nomClasificacionMotivoConsulta;

      $datosCombo02 = $o_LActoMedico->getArrayClasificacionMotivoConsulta($nomClasificacionMotivoConsulta);
      $o_Combo02 = new Combo($datosCombo02);
      $opcionesHTML02 = $o_Combo02->getOptionsHTML();
      $row_ochg02 = "onchange=\"\"";
      $row_ini02 = "<select id=\"cboClasifMotivoConsulta".$numSintomas."\" ".$row_ochg02.">";
      $row_fin02 = "</select>";
      $comboHTML02=$row_ini02.$opcionesHTML02.$row_fin02;

      //Dibujamos el div de sintomas
      //$divSintoma = "<div id=\"Div_sintoma".$numSintomas."\" style=\"width: 60%;height: 50%\">";
      $divSintoma .= "<div style=\"float: left; width: 100%\">";
      $divSintoma .= "<div style=\"width: 30%; float: left; text-align: right\">";
      $divSintoma .= "Tipo de ingreso:";
      $divSintoma .= "</div>";
      $divSintoma .= "<div style=\"width: 50%; float: left; text-align: left\">";
      $divSintoma .= $comboHTML01;
      $divSintoma .= "</div>";
      $divSintoma .= "<div style=\"width: 20%; float: left; text-align: right\">";
      $divSintoma .= "<a href=\"#\" onclick=\"validarManteSintomaMotivoConsulta('insertar',".$numSintomas.")\">";
      $divSintoma .= "<img src=\"../../../../fastmedical_front/imagen/icono/grabar.png\" alt=\"Grabar Sintoma\" title=\"Grabar Sintoma\"/>";
      $divSintoma .= "</a>";
      $divSintoma .= "<a href=\"#\" onclick=\"eliminarSintoma('Div_sintoma".$numSintomas."')\">";
      $divSintoma .= "<img src=\"../../../../fastmedical_front/imagen/icono/eliminar.gif\" alt=\"Eliminar Sintoma\" title=\"Eliminar Sintoma\"/>";
      $divSintoma .= "</a>";
      $divSintoma .= "</div>";
      $divSintoma .= "</div>";
      $divSintoma .= "<div style=\"float: left; clear: left; width: 100%\">";
      $divSintoma .= "<div style=\"width: 30%; float: left; text-align: right\">";
      $divSintoma .= "Clasificaci&oacute;n:";
      $divSintoma .= "</div>";
      $divSintoma .= "<div style=\"width: 70%; float: left; text-align: left\">";
      $divSintoma .= $comboHTML02;
      $divSintoma .= "</div>";
      $divSintoma .= "</div>";
      $divSintoma .= "<div style=\"float: left; clear: left; width: 100%\">";
      $divSintoma .= "<div style=\"width: 30%; float: left; text-align: right\">";
      $divSintoma .= "Descripci&oacute;n:";
      $divSintoma .= "</div>";
      $divSintoma .= "<div style=\"width: 70%; float: left; text-align: left\">";
      $divSintoma .= "<textarea id=\"txaDescSintoma".$numSintomas."\" rows=5 cols=50></textarea>";
      $divSintoma .= "</div>";
      $divSintoma .= "</div>";
      //$divSintoma .= "</div>";

      return $divSintoma;
      } */

    public function agregarMotivoDeConsulta($parametros) {
        $numSintomas = $parametros['p2'];
        $nombreSintoma = $parametros['p3'];
        $idSintoma = $parametros['p4'];
        $estadoSintoma = 0;
        $idMotivoDeConsulta = '';
        $ultimo = 'no';
        $descSintoma = '';
        require_once("../../cvista/actomedico/vistaAgregarMotivoConsulta.php");
    }

    public function aAagregarAntecedenteOdontograma($datos) {
        require("../../cvista/actomedico/vistaAgregarAntecedenteOdontograma.php");
    }

    public function aBuscadorDiagnosticoDiente($datos) {
        require_once("../../cvista/actomedico/vistaBuscadorDiagnosticoDiente.php");
    }

    public function aNuevoAntecedenteDinete($datos) {
        require_once("../../cvista/actomedico/vistaNuevoAntecedenteDinete.php");
    }

    public function manteMotivosDeConsulta($parametros) {
        $hacer = $parametros["accion"];
        $o_LActoMedico = new LActoMedico();

        $datosDesencriptados = base64_decode($parametros["datos"]);
        $datosSeparados = explode("|", $datosDesencriptados);

        switch ($hacer) {
            case 'insertar':
                $estadoEnVista = $datosSeparados[0];
                $idMotivoConsulta = $datosSeparados[1];
                $idSintomaCie = $datosSeparados[2];
                $idEstadoRegistro = 2;
                $descSintomaMotivoConsulta = $datosSeparados[3];
                $codProgramacion = $datosSeparados[4];

                $rs = $o_LActoMedico->spManteMotivosDeConsulta($hacer, $estadoEnVista, $idMotivoConsulta, $idSintomaCie, $idEstadoRegistro, $descSintomaMotivoConsulta, $codProgramacion);
                $rpta = $rs[0][0];
                break;
        }
        return $rpta;
    }

    public function aObtenerPaquetesPersona($cod_per) {
        $oLActoMedico = new LActoMedico();
        $arrayPaquetesPersona = $oLActoMedico->lObtenerPaquetesPersona($cod_per);
        return $arrayPaquetesPersona;
    }

    public function cargarMotivoDeConsulta($parametros) {

        $oLActoMedico = new LActoMedico();
        $accion = 'listaPreguardado';
        $codigoProgramacion = $parametros['p2'];
        //echo $codigoProgramacion;
        $arrayMotivosDeConsultaPreguardados = $oLActoMedico->spListaMotivoDeConsulta($accion, $codigoProgramacion);
        $n = count($arrayMotivosDeConsultaPreguardados);

        //Armamos las cadenas 
        //<input type="hidden" id="hdnCadenaIdCieSintomas" name="hdnCadenaIdCieSintomas" value="">
        $valorHdnCadenaIdCieSintomas = "";
        for ($i = 0; $i < $n; $i++) {
            $valorHdnCadenaIdCieSintomas = $valorHdnCadenaIdCieSintomas . $arrayMotivosDeConsultaPreguardados[$i]["idSintomaCie"] . "|";
        }

        $valorHdnCadenaIdCieSintomas = substr($valorHdnCadenaIdCieSintomas, 0, strlen($valorHdnCadenaIdCieSintomas) - 1);

        require_once("../../cvista/actomedico/vistaMotivoConsulta.php");
        $numSintomas = 0;
        for ($k = 0; $k < $n; $k++) {
            $numSintomas = $k + 1;
            if (isset($arrayMotivosDeConsultaPreguardados[$numSintomas])) {
                $idMotivoDeConsulta = $arrayMotivosDeConsultaPreguardados[$k]['idMotivoConsulta'];
                $estadoSintoma = $arrayMotivosDeConsultaPreguardados[$k]['idEstadoRegistro']; //2: pregrabado
                $idSintoma = $arrayMotivosDeConsultaPreguardados[$k]['idSintomaCie'];
                $nombreSintoma = utf8_encode($arrayMotivosDeConsultaPreguardados[$k]['nomSintoma']);
                //$descSintoma = str_replace("<br/>","\n",$arrayMotivosDeConsultaPreguardados[$k]['vDescripcion']);
                $descSintoma = $arrayMotivosDeConsultaPreguardados[$k]['vDescripcion'];
                $ultimo = 'no';
                require("../../cvista/actomedico/vistaAgregarMotivoConsulta.php");
            } else {
                $idMotivoDeConsulta = $arrayMotivosDeConsultaPreguardados[$k]['idMotivoConsulta'];
                $estadoSintoma = $arrayMotivosDeConsultaPreguardados[$k]['idEstadoRegistro']; //2: pregrabado
                $idSintoma = $arrayMotivosDeConsultaPreguardados[$k]['idSintomaCie'];
                $nombreSintoma = utf8_encode($arrayMotivosDeConsultaPreguardados[$k]['nomSintoma']);
                //$descSintoma = str_replace("<br/>","\n",$arrayMotivosDeConsultaPreguardados[$k]['vDescripcion']);
                $descSintoma = $arrayMotivosDeConsultaPreguardados[$k]['vDescripcion'];
                $ultimo = 'si';
                require("../../cvista/actomedico/vistaAgregarMotivoConsulta.php");
            }
        }
        if ($numSintomas == 0) {
            //$numero=$numSintomas;
            require("../../cvista/actomedico/vistaAgregarMotivoConsulta.php");
        }
    }

    public function verMotivoConsultaAnteriores($parametros) {
        $oLActoMedico = new LActoMedico();
        $accion = 'listaAnteriores';
        $codigoPaciente = $parametros['p2'];
        $arrayFilas = $oLActoMedico->spListaMotivoDeConsulta($accion, $codigoPaciente);

        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayCabecera = array("1" => "Cod.Cie", "3" => "Descripcion");
        $arrayTamano = array("1" => "50", "3" => "*");
        $arrayTipo = array("1" => "ro", "3" => "ro");
        $arrayAlineacion = array("1" => "left", "3" => "left");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0);
    }

    //Acto médico
    public function listaExamenMedico($nomExamen, $idVersion, $idEstadoDesarrollo) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->spListaExamenMedico($nomExamen, $idVersion, $idEstadoDesarrollo);
        return $rs;
    }

    public function aHistorialDiente($iCodigoProgramacion) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->lHistorialDiente($iCodigoProgramacion);
        return $rs;
    }

    //Obtenemos el maximo nivel de profundidad del arbol de examenes
    /* public function getMaximoNivelProfundidad($arrayExamenMedico){
      $maximoNivel=-1;
      foreach($arrayExamenMedico as $indice => $valor){
      if($arrayExamenMedico[$indice]['iNivel']>$maximoNivel){
      $maximoNivel=$arrayExamenMedico[$indice]['iNivel'];
      }
      }
      return $maximoNivel;
      }
      //Obtenemos examenes por determinado nivel
      public function getArrayRaizArbol($arrayExamenMedico){
      $iNivel=0;
      foreach($arrayExamenMedico as $indice => $valor){
      if($arrayExamenMedico[$indice]['iNivel']==$iNivel){
      $arrayRaizExamen[$arrayExamenMedico[$indice]['iIdExamen']]=$arrayExamenMedico[$indice];
      }
      }
      return $arrayRaizExamen;
      } */
    //Obtenemos los hijos de un examen
    public function getArrayHijoArbol($arrayExamenMedico, $iIdExamen) {
        $arrayHijo = array();
        foreach ($arrayExamenMedico as $indice => $valor) {
            if ($arrayExamenMedico[$indice]['iIdDependencia'] == $iIdExamen) {
                $arrayHijo[$arrayExamenMedico[$indice]['iIdExamen']] = $arrayExamenMedico[$indice];
            }
        }
        return $arrayHijo;
    }

    public function getPreordenArbol($arrayExamenMedico, $iIdExamen, $iCodigoProgramacion) {
        $arrayHijo = $this->getArrayHijoArbol($arrayExamenMedico, $iIdExamen);
        //print_r($arrayHijo);
        if ($arrayHijo != null) {
            if ($arrayExamenMedico[$iIdExamen]['iNivel'] != 0) {
                $nomExamenMedico = utf8_encode($arrayExamenMedico[$iIdExamen]['vDescripcion']);
                $this->cadenaArbolExamenMedico.="<div style=\"width:98%\">";
                $this->cadenaArbolExamenMedico.="<a href=\"javascript:;\" onclick=\"javascript:;\">";
                $this->cadenaArbolExamenMedico.="<div class='cabecerasExamenes' id=\"Div_ExamenMedicoEncabezado_" . $iIdExamen . "\" style=\" width:100% ;height:25px; display:block; border-style:solid; border-width:1px\" onclick=\"javascript:abrirDivSimple('Div_ExamenMedicoCuerpo_" . $iIdExamen . "')\">";
                $this->cadenaArbolExamenMedico.=$nomExamenMedico;
                $this->cadenaArbolExamenMedico.="</div>";
                $this->cadenaArbolExamenMedico.="</a>";
                $this->cadenaArbolExamenMedico.="<div id=\"Div_ExamenMedicoCuerpo_" . $iIdExamen . "\" style=\"width:100%; display:block; border-style:solid; border-width:1px\">";
            }

            foreach ($arrayHijo as $iIdExamenHijo => $valor) {
                $this->getPreordenArbol($arrayExamenMedico, $iIdExamenHijo, $iCodigoProgramacion);
            }
            // if ($arrayExamenMedico[$iIdExamen]['iNivel'] != 0) {
            $this->cadenaArbolExamenMedico.="</div>";
            $this->cadenaArbolExamenMedico.="</div>";
            // }
        } else {
            $nomExamenMedico = utf8_encode($arrayExamenMedico[$iIdExamen]['vDescripcion']);

            $contenido = $this->vistaPruevasProduccion($iIdExamen, $iCodigoProgramacion);

            $this->cadenaArbolExamenMedico.="<div style=\"width:98%\">";
            $this->cadenaArbolExamenMedico.="<a href=\"javascript:;\" onclick=\"javascript:;\">";
            $this->cadenaArbolExamenMedico.="<div class='cabecerasExamenes' id=\"Div_ExamenMedicoEncabezado_" . $iIdExamen . "\" style=\"width:100% ;height:25px; display:block; border-style:solid; border-width:1px\" onclick=\"javascript:abrirDivSimple('Div_ExamenMedicoCuerpo_" . $iIdExamen . "')\">";
            $this->cadenaArbolExamenMedico.=$nomExamenMedico;
            $this->cadenaArbolExamenMedico.="</div>";
            $this->cadenaArbolExamenMedico.="</a>";
            $this->cadenaArbolExamenMedico.="<div id=\"Div_ExamenMedicoCuerpo_" . $iIdExamen . "\" style=\"width:100%; display:block; border-style:solid; border-width:1px\">";

            if ($contenido != null && $contenido != '') {
                $this->cadenaArbolExamenMedico.=$contenido;
            }

            $this->cadenaArbolExamenMedico.="</div>";
            $this->cadenaArbolExamenMedico.="</div>";
        }
    }

    public function getCadenaArbol() {
        return $this->cadenaArbolExamenMedico;
    }

    public function listaExamenPorServicio($codServicio, $idVersion, $idEstadoDesarrollo, $codProgramacion) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->spListaExamenPorServicio($codServicio, $idVersion, $idEstadoDesarrollo, $codProgramacion);
        return $rs;
    }

    public function aObtenerTipoDiagnostico($datos) {
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->lObtenerTipoDiagnostico($datos);
        //     print_r()
        return $array[0][0] . '-' . $array[0][1] . '-' . $array[0][2] . '-' . $array[0][3];
    }

    public function AarrayImagenesSimbolos($datos) {
        $oLActoMedico = new LActoMedico();
        $arrayImagenesSimbolos = $oLActoMedico->AarrayImagenesSimbolos($datos);
        return $arrayImagenesSimbolos;
    }

    public function AarraySimboloHistorial($c_cod_per) {
        $oLActoMedico = new LActoMedico();
        $arrayImagenesSimbolos = $oLActoMedico->lArraySimboloHistorial($c_cod_per);
        return $arrayImagenesSimbolos;
    }

    public function aArregloDientes($datos) {
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->lArregloDientes($datos);
        $arrayCaras = $oLActoMedico->lArregloCarasDientes($datos);
        $arrayImagenesSimbolos = $oLActoMedico->AarrayImagenesSimbolos($datos);
        $rs = 'numeroDientes=new Array();';
        $rs.='numeroDientes[0]=1;';
        $rs.='arrayDientes=new Array();';

        $rs.='arrayDientes[0]=new Array();';
        $rs.='arrayDientes[0][0]=new Array();';
        $rs.='arrayDientes[0][0][0]=0;';
        $rs.='arrayDientes[0][0][1]=0;';
        $rs.='arrayDatosDientes=new Array();';
        $rs.='arrayDatosDientes[0]=new Array();';
        $contador = 0;
        $aux = 0;
        foreach ($array as $key => $value) {
            $iIdDienteGraficoOdontograma = $value['iIdDienteGraficoOdontograma'];
            $iOrden = $value['iOrden'];
            $x = $value['nx'];
            $y = $value['ny'];

            if ($aux != $value['iIdDienteGraficoOdontograma']) {
                $rs.="arrayDientes[$iIdDienteGraficoOdontograma]=new Array();";
                //cargando datos del diente
                $rs.="arrayDatosDientes[$iIdDienteGraficoOdontograma]=new Array();";
                $idDiente = $value['iIdDiente'];
                $iCodigoBinario = $value['iCodigoBinario'];
                $iCuadrante = $value['iCuadrante'];

                $rs.="arrayDatosDientes[$iIdDienteGraficoOdontograma][0]=$idDiente;";
                $rs.="arrayDatosDientes[$iIdDienteGraficoOdontograma][1]=$iCodigoBinario;";
                $rs.="arrayDatosDientes[$iIdDienteGraficoOdontograma][2]=$iCuadrante;";
            }
            $rs.="arrayDientes[$iIdDienteGraficoOdontograma][$iOrden]=new Array();";
            $rs.="arrayDientes[$iIdDienteGraficoOdontograma][$iOrden][0]=$x;";
            $rs.="arrayDientes[$iIdDienteGraficoOdontograma][$iOrden][1]=$y;";

            $aux = $value['iIdDienteGraficoOdontograma'];
        }
        $rs.= "var n=arrayDientes.length;
            
            
            for(var k=1; k<n;k++){
                
                numero1=arrayDientes[k].length;
                
                arrayDientes[k][numero1]=new Array();
                 
                arrayDientes[k][numero1][0]=arrayDientes[k][0][0];
                 
                arrayDientes[k][numero1][1]=arrayDientes[k][0][1];
                

    } 
    ";
        $indice = -1;
        $aux = 0;
        $rs.= 'arrayCaraDientes=new Array();';
        $rs.='arrayDatosDientesCara=new Array();';

        foreach ($arrayCaras as $key => $value) {
            //$idDiente = $value['iIdDienteGraficoOdontograma'];
            $iOrden = $value['iOrden'];
            $x = $value['nx'];
            $y = $value['ny'];

            if ($aux != $value['iIdCarasDiente']) {
                $indice++;
                $idDiente = $value['iIdDiente'];
                $idCaraDiente = $value['iIdCarasDiente'];
                $iArea = $value['iArea'];
                $rs.="arrayCaraDientes[$indice]=new Array();";
                $rs.="arrayDatosDientesCara[$indice]=new Array();";
                $rs.="arrayDatosDientesCara[$indice][0]=$idDiente;";
                $rs.="arrayDatosDientesCara[$indice][1]=$idCaraDiente;";
                $rs.="arrayDatosDientesCara[$indice][2]=$iArea;";
            }
            $rs.="arrayCaraDientes[$indice][$iOrden]=new Array();";
            $rs.="arrayCaraDientes[$indice][$iOrden][0]=$x;";
            $rs.="arrayCaraDientes[$indice][$iOrden][1]=$y;";

            $aux = $value['iIdCarasDiente'];
        }

        $rs.= "var n1=arrayCaraDientes.length;

         
            for(var k=0; k<n1;k++){
                
                numero1=arrayCaraDientes[k].length;
                
                arrayCaraDientes[k][numero1]=new Array();
                 
                arrayCaraDientes[k][numero1][0]=arrayCaraDientes[k][0][0];
                 
                arrayCaraDientes[k][numero1][1]=arrayCaraDientes[k][0][1];
                

    } 
    ";

///////////////////////

        $rs.='arraySimbolos=new Array();';
        $indice = 0;
        foreach ($arrayImagenesSimbolos as $key => $value) {
            $idSimbolo = $value['iIdSimboloGraficoDiagnostico'];
            $idDiagnosticoDiente = $value['iIdDiagnosticoDiente'];
            $vRura = $value['vRura'];
            $rs.="arraySimbolos[$indice]=new Array();";
            $rs.="arraySimbolos[$indice][0]=$idSimbolo;";
            $rs.="arraySimbolos[$indice][1]=$idDiagnosticoDiente;";
            $rs.="arraySimbolos[$indice][2]='$vRura';";
            $indice++;
        }
        ///////////////////////
        //////////para las marcas/////////////
        $rs.='arrayMarcas=new Array();';
        /////////////////
        $rs.="canvas = document.getElementById('canvas1');
            
            p = new Processing(canvas, animacion2);";
        return $rs;
    }

    public function getArrayPadres($arrayExamenMedico) {
        $iNivel = 0;
        foreach ($arrayExamenMedico as $indice => $valor) {
            if ($arrayExamenMedico[$indice]['iNivel'] == $iNivel) {
                $arrayRaizExamen[$arrayExamenMedico[$indice]['iIdExamen']] = $arrayExamenMedico[$indice];
            }
        }
        return $arrayRaizExamen;
    }

    public function getArrayExamenPorServicioCompleto($arrayExamenPorServicio, $arrayExamenMedico) {//Arma el vector del arbol con los hijos encontrados en ServiciosExamenes con todos sus padres
        //$arrayExamenArbol = array();
        var_dump($arrayExamenPorServicio);
        echo "xxxxxx";
        foreach ($arrayExamenPorServicio as $indice => $valor) {
            //array_push($arrayExamenArbol, $indice);
            $arrayExamenArbol[$arrayExamenPorServicio[$indice]['iIdExamen']] = $arrayExamenPorServicio[$indice];

            $idNodoPadre = $arrayExamenPorServicio[$indice]['iIdDependencia'];
            while ($idNodoPadre != null || $idNodoPadre != '') {
                if (!isset($arrayExamenArbol[$idNodoPadre])) {
                    //array_push($arrayExamenArbol, $idNodoPadre);

                    $arrayExamenArbol[$idNodoPadre] = $arrayExamenMedico[$idNodoPadre];

                    //$arrayExamenArbol[$idNodoPadre] = $arrayExamenMedico[$idNodoPadre];
                }

                $idNodoPadre = $arrayExamenMedico[$idNodoPadre]['iIdDependencia'];
            }
        }
//        print_r($arrayExamenArbol);
        return $arrayExamenArbol;
    }

    public function listaVersionExamenDeProduccion() {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->spListaVersionExamenDeProduccion();
        return $rs;
    }

    public function pintarDivExamenes($parametros) {
        $codServicio = $parametros['c_cod_ser_pro'];
        $codProgramacion = $parametros['codigoProgramacion'];
        $this->cadenaArbolExamenMedico = '';
        $nomExamen = '%';
        //$idVersion=30;
        $arrayVersion = $this->listaVersionExamenDeProduccion();
        $idVersion = $arrayVersion[0]['iIdVersion']; //echo 'Version:'.$idVersion;
        $idEstadoDesarrollo = 1;
        $arrayExamenPorServicio = $this->listaExamenPorServicio($codServicio, $idVersion, $idEstadoDesarrollo, $codProgramacion); //print_r($arrayExamenPorServicio);
        $arrayExamenMedico = $this->listaExamenMedico($nomExamen, $idVersion, $idEstadoDesarrollo); //print_r($arrayExamenMedico);

        $arrayExamenPorServicioCompleto = $this->getArrayExamenPorServicioCompleto($arrayExamenPorServicio, $arrayExamenMedico); //print_r($arrayExamenPorServicioCompleto);
        //$iIdExamenRaiz=275;
        $iIdExamenRaiz = -1;
        //Buscamos la raiz del arbol
        foreach ($arrayExamenPorServicioCompleto as $idExamen => $valor) {
            if ($arrayExamenPorServicioCompleto[$idExamen]['iNivel'] == 0) {
                $iIdExamenRaiz = $idExamen;
            }
        }

        $this->getPreordenArbol($arrayExamenPorServicioCompleto, $iIdExamenRaiz, $codProgramacion);

        //Mandamos todos los nodos hojas que son pruebas para poder grabar
        $cadenaIdPruebas = '';
        $oLActoMedico = new LActoMedico();
        $arrayAux = array();
        foreach ($arrayExamenPorServicio as $idExamen => $valor) {
            $arrayPruebas = $oLActoMedico->pruebasExamenes($idExamen, $codProgramacion);
            if (isset($arrayPruebas)) {
                foreach ($arrayPruebas as $indice => $valor2) {
                    //$arrayAux[$arrayPruebas[$indice]['iIdPrueba']]=$arrayPruebas[$indice];
                    $arrayAux[$arrayPruebas[$indice]['iIdPrueba']] = $arrayPruebas[$indice]['iIdPrueba'];
                }
            }
        }
        $cadenaIdPruebas = join("|", $arrayAux);
        //Concatenamos el hidden con los codigos de la pruebas con el arbol de div generado
        $this->cadenaArbolExamenMedico = $this->cadenaArbolExamenMedico . "<input type=\"hidden\" id=\"hdnIdVersion\" value=\"" . $idVersion . "\"/>";
        $this->cadenaArbolExamenMedico = $this->cadenaArbolExamenMedico . "<input type=\"hidden\" id=\"hdnIdEstadoDesarrollo\" value=\"" . $idEstadoDesarrollo . "\"/>";
        $this->cadenaArbolExamenMedico = $this->cadenaArbolExamenMedico . "<input type=\"hidden\" id=\"hdnPruebasDeExamenMedico\" value=\"" . $cadenaIdPruebas . "\"/>";

        return $this->cadenaArbolExamenMedico;
    }

    public function listarDatosTriaje($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultado = $o_LActoMedico->listarDatosTriaje($datos);
        return $resultado;
    }

    public function cargarVentanaServiciosPorActividadDeCCosto() {
        $o_LActoMedico = new LActoMedico();
        $nomTipoServicio = '%'; //Todos
        $optionsHTML = '0';
        $opcion = 1;

        $c_cod_ccos = ''; //$parametros['p2'];//'0102060907'
        $codActividad = '';
        $nomServicio = '';
        $funcion = '';

        /* $arrayCombo = $o_LActoMedico->spListaTipoDeServicio($nomTipoServicio);
          $o_Combo = new Combo($arrayCombo);
          $comboHtmlTipoServicio = $o_Combo->getOptionsHTML($optionsHTML); */
        $tablaServicios = $this->listaServiciosPorActividadDeCCosto($opcion, $c_cod_ccos, $codActividad, $nomServicio, $funcion);

        require_once("../../cvista/actomedico/vistaServiciosPorActividadDeCCosto.php");
    }

    /*
      public function listaServiciosPorActividadDeCCosto($parametros) {
      $o_LActoMedico = new LActoMedico();
      $nomTipoServicio = '%';//Todos
      $optionsHTML='0';
      $opcion=1;

      $c_cod_ccos=$parametros['p2'];//'0102060907'
      $codActividad='';
      $nomServicio='';

      $arrayCombo = $o_LActoMedico->spListaTipoDeServicio($nomTipoServicio);
      $o_Combo = new Combo($arrayCombo);
      $comboHtmlTipoServicio = $o_Combo->getOptionsHTML($optionsHTML);
      $tablaServicios = $this->listaServiciosPorActividadDeCCosto($opcion,$c_cod_ccos,$codActividad,$nomServicio);
      //$arrayCombo = $o_LRrhh->seleccionarCategoria();
      //$o_Combo = new Combo($arrayCombo);
      //$optionsHTML='0';
      //$comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
      //$tablaServicios=$this->aPuestosXCCostos(1);
      require_once("../../cvista/actomedico/vistaServiciosPorActividadDeCCosto.php");
      } */

    public function listaServiciosPorActividadDeCCosto($opcion, $iidCentroCosto, $codActividad, $nomServicio, $funcion) {
        $o_LActoMedico = new LActoMedico();
        $arrayFilas = $o_LActoMedico->spListaServiciosPorActividadDeCCosto($opcion, $iidCentroCosto, $codActividad, $nomServicio);
        $arrayTipo = array("c_cod_ser_pro" => "c",
            "v_desc_ser_pro" => "c",
            "vDescripcionActividad" => "c",
            "vDescripcionCcosto" => "c");

        //$arrayColorEstado=array("0"=>"6");
        $arrayCabecera = array("c_cod_ser_pro" => "Cod. Serv.",
            "v_desc_ser_pro" => "Servicio",
            "vDescripcionActividad" => "Actividad",
            "vDescripcionCcosto" => "C. Costo");

        $o_Tabla = new Tabla1($arrayCabecera, 20, $arrayFilas, 'tablaOrden', 'filax', 'filay', 'filaSeleccionada', 'onClick', $funcion, 'c_cod_ser_pro', $arrayTipo, '', '');
        $o_Tabla->setColumnasOrdenar(array("v_desc_ser_pro", "vDescripcionActividad", "vDescripcionCcosto"));

        $tablaHTML = $o_Tabla->getTabla();
        return $tablaHTML;

        //$o_Html = new Tabla1($arrayCabecera,9,$arrayFilas,'tablaOrden','filax','filay','filaSeleccionada','onClick',$datos['funcion'],0,$arrayTipo,5,$arrayColorEstado);
        //$o_Html->setColumnasOrdenar(array("1","2"));
        //return $o_Html->getTabla();
    }

    public function AmantenimientoGrupoEtario() {
        $o_LActoMedico = new LActoMedico();
        $resultadoAfiliacion = $o_LActoMedico->LlistarAfiliacion();
        // return $resultado;
        require_once("../../cvista/actomedico/vistaMantenimientoGrupoEtareo.php");
    }

    public function AcargarTablaGrupoEtario($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultadoGrupoEtario = $o_LActoMedico->LcargarTablaGrupoEtario($datos);
        $o_TablaHtmlx = new tablaDHTMLX();

//        $arrayFilas = $o_LActoMedico->LcargarTablaGrupoEtario($datos);
        $arrayCabecera = array(0 => "id", 1 => "Codigo EsSalud", 2 => "Sexo", 3 => "Rango Edad", 4 => "Fin", 5 => "Descripcion", 6 => "inicio", 7 => "sexo");
        $arrayTamano = array(0 => "20", 1 => "50", 2 => "35", 3 => "80", 4 => "50", 5 => "450", 6 => "50", 7 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "false", 4 => "true", 5 => "false", 6 => "true", 7 => "true");
        $arrayAling = array(0 => "left", 1 => "center", 2 => "center", 3 => "center", 4 => "left", 5 => "left", 6 => "left", 7 => "left");
//return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $resultadoGrupoEtario, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AgregarNuevoServicioPorGRupoEtario() {
        require_once("../../cvista/actomedico/vistaPopapServicos.php");
    }

    public function AcargarTablaServicioGrupoEtario($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultadoServicioGrupoEtario = $o_LActoMedico->LcargarTablaServicioGrupoEtario($datos);
        $o_TablaHtmlx = new tablaDHTMLX();

//        $arrayFilas = $o_LActoMedico->LcargarTablaGrupoEtario($datos);
        $arrayCabecera = array(0 => "iIdCTP", 1 => "CodigoCPT", 2 => "Nombre Servicio");
        $arrayTamano = array(0 => "10", 1 => "10", 2 => "550",);
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false");
        $arrayAling = array(0 => "left", 1 => "center", 2 => "left");
//return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
        return $o_TablaHtmlx->generaTabla($arrayCabecera, $resultadoServicioGrupoEtario, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AserviciosSeleccionadoPorGrupoEtario($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultadoGrupoEtario = $o_LActoMedico->LserviciosSeleccionadoPorGrupoEtario($datos);
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayCabecera = array(0 => "iIdServicioGrupoEtareo", 1 => "CPT", 2 => "Descripcion", 3 => "Edad Toma", 4 => "periodo", 5 => "Codigo HMLO", 6 => "Orden", 7 => "Nro ate", 11 => "tipo", 8 => "Abajo", 9 => "Arriba", 10 => "Eliminar", 12 => "Editar", 13 => "iIdTipoServicioCPT", 14 => "iIdPeriodoEdad", 15 => "bObligatorio", 16 => "vMensaje", 17 => "Selec");
        $arrayTamano = array(0 => "3", 1 => "3", 2 => "320", 3 => "20", 4 => "20", 5 => "50", 6 => "40", 7 => "30", 11 => "45", 8 => "40", 9 => "40", 10 => "30", 12 => "40", 13 => "40", 14 => "40", 15 => "40", 16 => "300", 17 => "40");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 11 => "ro", 8 => "img", 9 => "img", 10 => "img", 12 => "img", 13 => "ro", 14 => "ro", 15 => "ro", 16 => "ro", 17 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 11 => "default", 8 => "pointer", 9 => "pointer", 10 => "pointer", 12 => "pointer", 13 => "default", 14 => "default", 15 => "default", 16 => "default", 17 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "true", 5 => "true", 6 => "false", 7 => "false", 11 => "true", 8 => "true", 9 => "true", 10 => "false", 12 => "false", 13 => "true", 14 => "true", 15 => "false", 16 => "true", 17 => "false");
        $arrayAling = array(0 => "left", 1 => "center", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center", 11 => "left", 8 => "center", 9 => "center", 10 => "center", 12 => "center", 13 => "center", 14 => "center", 15 => "center", 16 => "center", 17 => "center");

        return $o_TablaHtmlx->generaTabla($arrayCabecera, $resultadoGrupoEtario, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AseleccionarServicioGrupoEtario($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultadoPeriodoEdad = $o_LActoMedico->LlistarPeriodoEdad();
        $resultadoTipoServicioCPT = $o_LActoMedico->LlistarTipoServicioCPT();
        $iorder = $o_LActoMedico->LiOrderMax($datos["iIdGrupoEtario"]);
        if ($iorder[0][0] == '') {
            $order = 1;
        } else {
            $order = $iorder[0][0] + 1;
        }
        // return $resultado;
        require_once("../../cvista/actomedico/tipoEdadServicio.php");
    }

    public function AguardarServicioGrupoEtario($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultado = $o_LActoMedico->LguardarServicioGrupoEtario($datos);
        return $resultado;
    }

    public function AeliminarseleccionarServicioGrupoEtario($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultado = $o_LActoMedico->LeliminarseleccionarServicioGrupoEtario($datos);
        return $resultado;
    }

/////////////////////////////////////////Fin de Funciones del PENDEX XD///////////////////////////////////////////


    public function apaqueteIncompleto($datos) {
        $oLActoMedico = new LActoMedico();
//        $verPaquetesIncompleto = $oLActoMedico->obtenerDatosFiliacionActoMedico($datos);
        $verPaquetesIncompleto = $oLActoMedico->LCarteraobtenerEdadPersona($datos);
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayCabecera = array(0 => "iIdSErvicioGrupoEtareoPersona", 1 => "iIdCPT", 2 => "c_cod_ser_pro_defec", 3 => "iNumeroSerciosCPT", 4 => "vDescripcionCPT", 5 => "CodigoProducto", 6 => "iNroAte", 7 => "iOrder", 8 => "iNroConfirmados", 9 => "iNroRecetaActual", 10 => "minAtencion", 11 => "iEstadoAtencion", 12 => "bServicioActual", 13 => "iGrupoEtario", 14 => "iColor -14", 15 => "15", 16 => "16", 17 => "v_desc_pro", 18 => "bReceta", 19 => "Observacion", 20 => "Obs.", 21 => "Receta", 22 => "iFrecuenciaDias", 23 => "iCantidadReceta", 24 => "vIndicaciones");
        $arrayTamano = array(0 => "40", 1 => "50", 2 => "80", 3 => "80", 4 => "680", 5 => "80", 6 => "20", 7 => "100", 8 => "50", 9 => "50", 10 => "50", 11 => "50", 12 => "50", 13 => "50", 14 => "50", 15 => "50", 16 => "20", 17 => "20", 18 => "20", 19 => "150", 20 => "120", 21 => "120", 22 => "120", 23 => "120", 24 => "120");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro", 12 => "ro", 13 => "ro", 14 => "ro", 15 => "ro", 16 => "ro", 17 => "ro", 18 => "ro", 19 => "ro", 20 => "ro", 21 => "ro", 22 => "ro", 23 => "ro", 24 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default", 11 => "default", 12 => "default", 13 => "default", 14 => "default", 15 => "default", 16 => "default", 17 => "default", 18 => "default", 19 => "default", 20 => "default", 21 => "default", 22 => "default", 23 => "default", 24 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "true", 3 => "true", 4 => "false", 5 => "false", 6 => "true", 7 => "true", 8 => "true", 9 => "true", 10 => "true", 11 => "true", 12 => "true", 13 => "true", 14 => "true", 15 => "true", 16 => "true", 17 => "true", 18 => "true", 19 => "true", 20 => "true", 21 => "true", 22 => "true", 23 => "true", 24 => "true");
        $arrayAling = array(0 => "left", 1 => "center", 2 => "left", 3 => "center", 4 => "left", 5 => "center", 6 => "left", 7 => "center", 8 => "center", 9 => "center", 10 => "center", 11 => "center", 12 => "center", 13 => "center", 14 => "center", 15 => "center", 16 => "center", 17 => "center", 18 => "center", 19 => "center", 20 => "center", 21 => "center", 22 => "center", 23 => "center", 24 => "center");

        return $o_TablaHtmlx->generaTabla($arrayCabecera, $verPaquetesIncompleto, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);

        // require_once '../../cvista/actomedico/ServicoCTP.php';
    }

    /////////////////////////////////////////Fin de Funciones del PENDEX XD///////////////////////////////////////////
//----------------------------------------------------------------------------------------   
//----------------------------EQUIVALENCIAS CPT-------------------------------------------
//----------------------------------------------------------------------------------------

    public function abrirEquivalenciasCPT() {
        //  $oLRrhh = new LRrhh();
        require_once '../../cvista/actomedico/vistaEquivalenciasCPT.php';
//        return $resultado;
    }

    public function ACargarTablaMxserpro($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->LCargarTablaMxserpro($datos);
        $arrayCabecera = array("0" => "IdProd", "1" => "Descripcion Producto", "2" => "c_estado");
        $arrayTamano = array(0 => "65", 1 => "*", 2 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayAlineacion = array("0" => "left", "1" => "left", "2" => "left");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "true");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function AbuscarTablaCPT($datos) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->LbuscarTablaCPT($datos);
        $arrayCabecera = array("0" => "IdCPT", "1" => "CodigoCPT", "2" => "vDescripcion", "3" => "bEstado");
        $arrayTamano = array(0 => "30", 1 => "20", 2 => "*", 3 => "20");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "true", 2 => "false", 3 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "center");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function AbuscarCPTcod($datos) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->LbuscarCPTcod($datos);
        $arrayCabecera = array("0" => "IdCPT", "1" => "CodigoCPT", "2" => "vDescripcion", "3" => "bEstado");
        $arrayTamano = array(0 => "30", 1 => "40", 2 => "*", 3 => "20");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default");
        $arrayHidden = array(0 => "false", 1 => "true", 2 => "false", 3 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "center");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function AbuscarMxSerProcod($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->LbuscarMxSerProcod($datos);
        $arrayCabecera = array("0" => "IdProd", "1" => "Descripcion Producto", "2" => "c_estado");
        $arrayTamano = array(0 => "65", 1 => "*", 2 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro");
        $arrayAlineacion = array("0" => "left", "1" => "left", "2" => "left");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "true");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function AcargarRegistroMxserpro($datos) { //Inserta datos de dos tablas a una sola tabla en comun
        $o_TablaHtmlx = new tablaDHTMLX();

        $arrayFilas = array();
        $arrayFilas[0][0] = 1;
        $arrayFilas[0][1] = $datos["iIdCPT"];
        $arrayFilas[0][2] = $datos["vCPTdescripcion"];
        $arrayFilas[0][3] = 0;
        $arrayFilas[0][4] = 0;
        $arrayFilas[0][5] = "../../../../fastmedical_front/imagen/icono/grabar.png ^ guardar";

        $arrayCabecera = array("0" => "iId", "1" => "iIdCPT", "2" => "Descripcion CPT", "3" => "idSerProd", "4" => "Descrip_Prod", "5" => "Accion");
        $arrayTamano = array(0 => "50", 1 => "30", 2 => "*", 3 => "80", 4 => "*", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img");
        $arrayAlineacion = array("0" => "left", "1" => "left", "2" => "left", "3" => "left", "4" => "left", "5" => "left");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", "3" => "false", "4" => "false", "5" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function AexamenesRelacionados($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLActoMedico = new LActoMedico();
        $arrayFilas = $oLActoMedico->LexamenesRelacionados($datos);
        //iIdCPTxServicio,c_cod_ser_pro,iIdCPT,dFechaCreacion
        $arrayCabecera = array("0" => "Id Relacion", "1" => "Cod Producto", "2" => "Id CPT", "3" => "Producto", "4" => "Estado", "5" => "Accion");
        $arrayTamano = array(0 => "50", 1 => "100", 2 => "50", 3 => "*", 4 => "50", 5 => "50");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "img");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "center", "3" => "left", "4" => "center", "5" => "center");
        $arrayHidden = array("0" => "false", "1" => "false", "2" => "false", "3" => "false", "4" => "true", "5" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------

    public function AguardarRegistroServicio($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->LguardarRegistroServicio($datos);
        return $resultado;
    }

    public function cambiarEstadoServicioRelacionado($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->cambiarEstadoServicioRelacionado($datos);
        return $resultado;
    }

    public function ApopapserviciosDuplicados($datos) {
        $oLActoMedico = new LActoMedico();
        require_once("../../cvista/actomedico/vistaCPTExtras.php");
    }

    public function AcargarServiciosDuplicados($datos) {
        $oLActoMedico = new LActoMedico();
//        $verPaquetesIncompleto = $oLActoMedico->obtenerDatosFiliacionActoMedico($datos);
        $verPaquetesIncompleto = $oLActoMedico->LcargarServiciosDuplicados($datos);
        $o_TablaHtmlx = new tablaDHTMLX();


        $arrayCabecera = array(0 => "c_cod_ser_pro", 1 => "iIdServicioGrupoEtareo", 2 => "iIdCPT", 3 => "idGrupoEtario", 4 => "nEdadToma", 5 => "iNumeroAtenciones", 6 => "iOrden", 7 => "descri", 8 => "v_desc_ser_pro", 9 => "c_cod_ser_pro");

        $arrayTamano = array(0 => "100", 1 => "50", 2 => "80", 3 => "80", 4 => "80", 5 => "80", 6 => "80", 7 => "100", 8 => "650", 9 => "90");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default");
        $arrayHidden = array(0 => "true", 1 => "true", 2 => "true", 3 => "true", 4 => "true", 5 => "true", 6 => "true", 7 => "true", 8 => "false", 9 => "false");
        $arrayAling = array(0 => "left", 1 => "center", 2 => "left", 3 => "center", 4 => "left", 5 => "center", 6 => "left", 7 => "center", 8 => "left", 9 => "left");

        return $o_TablaHtmlx->generaTabla($arrayCabecera, $verPaquetesIncompleto, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function AactualizarEstadoDeServicioGrupoEtarioPersona($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->LactualizarEstadoDeServicioGrupoEtarioPersona($datos);
        return $resultado;
    }

    public function subirFotoProcimientoDiente($datos) {
        $BigImageMaxSize = 720;
        $DestinationDirectory = '../../../imagen/';
        $Quality = 100;
        print_r($datos["data"]);
        foreach ($_FILES as $file) {

            $ImageName = $file['name'];
            $TempSrc = $file['tmp_name'];
            $ImageType = $file['type'];
            if (is_array($ImageName)) {
                $c = count($ImageName);
                for ($i = 0; $i < $c; $i++) {
                    $processImage = true;
                    if (!isset($ImageName[$i]) || !is_uploaded_file($TempSrc[$i])) {
                        echo '<div class="error">Error occurred while trying to process <strong>' . $ImageName[$i] . '</strong>, may be file too big!</div>'; //output error
                    } else {
                        switch (strtolower($ImageType[$i])) {
                            case 'image/png':
                                $CreatedImage = imagecreatefrompng($TempSrc[$i]);
                                break;
                            case 'image/gif':
                                $CreatedImage = imagecreatefromgif($TempSrc[$i]);
                                break;
                            case 'image/jpeg':
                            case 'image/pjpeg':
                                $CreatedImage = imagecreatefromjpeg($TempSrc[$i]);
                                break;
                            default:
                                $processImage = false;
                        }
                        list($CurWidth, $CurHeight) = getimagesize($TempSrc[$i]);
                        $ImageExt = substr($ImageName[$i], strrpos($ImageName[$i], '.'));
                        $ImageExt = str_replace('.', '', $ImageExt);
                        $NewImageName = '12.' . $ImageExt;
                        $DestRandImageName = $DestinationDirectory . $NewImageName;
                        if ($processImage && resizeImage($CurWidth, $CurHeight, $BigImageMaxSize, $DestRandImageName, $CreatedImage, $Quality, $ImageType[$i])) {

                            $result.='<div style="border:1px solid black;padding-left:5px;width:90px;height:90px;padding-right:10px;border-radius:10px;">';
                            $result.= '<table style="border:0px solid;width:60px;height:60px;padding:3px;" cellpadding="0" cellspacing="0">';
                            $result.= '<tr>';
                            $result.= '<td><img src="../../../imagen/' . $NewImageName . '"  style="border:2px solid black;width:60px;height:60px;"></td>';
                            $result.= '<td><div style="border:0px solid;">
					<table>
					<tr>
					<td><button   
					onclick="volverAcargar();" style="border: 1px solid black; border-radius:5px;width:23px; height: 23px; "><img src="../../../../fastmedical_front/imagen/icono/otro.png"></button></td>
					</tr>
					<tr>
					<td><button   style="border: 1px solid black; border-radius:5px;width:23px; height: 23px;"><img src="../../../../fastmedical_front/imagen/icono/ver.png"></button></td>
					</tr>
					<tr>
					<td><button  onclick="quitarImagen();" style="border: 1px solid black; border-radius:5px;width:23px; height: 23px; "><img src="../../../../fastmedical_front/imagen/icono/cancelar.png"></button></td>
					</tr>
					</table></div></td>';
                            $result.= '</tr>';
                            $result.= '</table>';
                            $result.='</div>';
                        }
                    }
                }
            }
        }
        return $result;
    }

    function resizeImage($CurWidth, $CurHeight, $MaxSize, $DestFolder, $SrcImage, $Quality, $ImageType) {
        if ($CurWidth <= 0 || $CurHeight <= 0) {
            return false;
        }
        $ImageScale = min($MaxSize / $CurWidth, $MaxSize / $CurHeight);
        $NewWidth = ceil($ImageScale * $CurWidth);
        $NewHeight = ceil($ImageScale * $CurHeight);

        if ($CurWidth < $NewWidth || $CurHeight < $NewHeight) {
            $NewWidth = $CurWidth;
            $NewHeight = $CurHeight;
        }
        $NewCanves = imagecreatetruecolor($NewWidth, $NewHeight);
        if (imagecopyresampled($NewCanves, $SrcImage, 0, 0, 0, 0, $NewWidth, $NewHeight, $CurWidth, $CurHeight)) {
            switch (strtolower($ImageType)) {
                case 'image/png':
                    imagepng($NewCanves, $DestFolder);
                    break;
                case 'image/gif':
                    imagegif($NewCanves, $DestFolder);
                    break;
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewCanves, $DestFolder, $Quality);
                    break;
                default:
                    return false;
            }
            if (is_resource($NewCanves)) {
                imagedestroy($NewCanves);
            }
            return true;
        }
    }

    function cropImage($CurWidth, $CurHeight, $iSize, $DestFolder, $SrcImage, $Quality, $ImageType) {
        if ($CurWidth <= 0 || $CurHeight <= 0) {
            return false;
        }
        if ($CurWidth > $CurHeight) {
            $y_offset = 0;
            $x_offset = ($CurWidth - $CurHeight) / 2;
            $square_size = $CurWidth - ($x_offset * 2);
        } else {
            $x_offset = 0;
            $y_offset = ($CurHeight - $CurWidth) / 2;
            $square_size = $CurHeight - ($y_offset * 2);
        }
        $NewCanves = imagecreatetruecolor($iSize, $iSize);
        if (imagecopyresampled($NewCanves, $SrcImage, 0, 0, $x_offset, $y_offset, $iSize, $iSize, $square_size, $square_size)) {
            switch (strtolower($ImageType)) {
                case 'image/png':
                    imagepng($NewCanves, $DestFolder);
                    break;
                case 'image/gif':
                    imagegif($NewCanves, $DestFolder);
                    break;
                case 'image/jpeg':
                case 'image/pjpeg':
                    imagejpeg($NewCanves, $DestFolder, $Quality);
                    break;
                default:
                    return false;
            }
            if (is_resource($NewCanves)) {
                imagedestroy($NewCanves);
            }
            return true;
        }
    }

    public function adjuntarFotoOdontograma($datos) {
        require_once("../../cvista/actomedico/mostrarFormularioSubirFoto.php");
    }

    public function abrirPopadVisorImagen($datos) {
        require_once("../../cvista/actomedico/abrirPopadVisorImagen.php");
    }

    public function verificarCantidadVersionImagenXHistoriaDiente($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->verificarCantidadVersionImagenXHistoriaDiente($datos);
        return $resultado[0][0];
    }

    public function grabarImagenHistoriaDiente($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->grabarImagenHistoriaDiente($datos);
        return $resultado;
    }

    public function cerrarAntecedenteOdontograma($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->cerrarAntecedenteOdontograma($datos);
        return $resultado;
    }

    public function cambiaraEstadoImagenesVersionesAnteriores($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->cambiaraEstadoImagenesVersionesAnteriores($datos);
        return $resultado;
    }

    public function updateObsHistoriaDiente($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->updateObsHistoriaDiente($datos);
        return $resultado;
    }

    public function updateCarasDiente($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->updateCarasDiente($datos);
        return $resultado;
    }

    public function cargarTablaAfiliaciones($datos) {
        require_once("tablaAngelSayes.php");
        $tabla = new TablaAngelSayes();
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->cargarTablaAfiliaciones($datos);
        $arrayWidth = array(0 => "50", 1 => "442");
        $arrayTitulos = array(0 => "Id", 1 => "Afiliacion");
        $arrayAlign = array(0 => "center", 1 => "left");
        $arrayType = array(0 => "text", 1 => "text");
        $arrayCursor = array(0 => "pointer", 1 => "pointer");
        $arrayFunctionXCelda = array(0 => "cargarMantenimientoAfiliacionesModulo", 1 => "cargarMantenimientoAfiliacionesModulo");
        $arrayImagenPorCelda = array(0 => "0", 1 => "0");
        $arrayUrlImagen = array(0 => "", 1 => "");
        $arrayFunction = array(0 => "", 1 => "");
        $arrayTitle = array(0 => "", 1 => "");
        $numDatosEnviadosFuncionCadena = 1;
        $scroll = 0;
        $height = 570;
        $resultado = $tabla->contructorTabla($scroll, $numDatosEnviadosFuncionCadena, $arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height);

//        $count = count($resultado);
//
//
//        $rs = '<table cellspacing="1" style="border:0px solid;">
//                <tr style="background-image:url(\'../../../../fastmedical_front/imagen/icono/fondogrid.png\');height: 30px;">
//                    <td style="width: 90px;border:0px solid #006631">
//                <center><p style="font-size:18px;font-family: segoe UI;color:black"><b>Codigo</b></p></center>
//                </td>
//                <td style="width: 600px;border:0px solid #006631">
//                <center><p style="font-size:18px;font-family: segoe UI;color:black"><b>Afiliacion</b></p></center>
//                </td>
//                <td style="width: 10px;border:0px solid #006631">
//                <center><p style="font-size:18px;font-family: segoe UI;color:black"><b>...</b></p></center>
//                </td>
//                </tr>';
//        $contador = count($resultado);
//        for ($x = 0; $x <= $contador - 1; $x++) {
//            if ($x % 2 == 0) {
//                $color = '#1B843C';
//            } else {
//                $color = '#1B843C';
//            }
//            $id = "'" . $resultado[$x][0] . "'";
//            $nombre = "'" . $resultado[$x][1] . "'";
//            $rs.='<tr onClick="cargarMantenimientoAfiliacionesModulo(' . $id . ',' . $nombre . ')" style="background-color:' . $color . ';" onmouseout=\'this.style.background="#1B843C";\' onmouseover=\'this.style.background="#006631";\'>
//                        <td>
//                    <center><p style="font-size:12px;font-family: segoe UI;color:white">' . $resultado[$x][0] . '</p></center>
//                    </td>
//                    <td>
//                        <p style="font-size:12px;font-family: segoe UI;color:white;padding-left:10px;">' . $resultado[$x][1] . '</p>
//                    </td>
//                    <td>
//                        <a href="javascript:cargarMantenimientoAfiliacionesModulo(' . $id . ',' . $nombre . ')"><img src="../../../../fastmedical_front/imagen/icono/btn_EditarAngel.png" style="width: 30px;"></a>
//                    </td>
//                    </tr>';
//        }
//        $rs.='</table>';
//        $rs.='<br><br><p style="color:white;font-size:16;font-family:verdana;padding-left:350px;">Total : ' . ($count) . '<br><br>';

        return $rs;
    }

    public function quitarImagen($datos) {
        unlink($datos['ruta']);
    }

    public function mostrarImagenOdontograma($nomfileupload, $uploadFile, $numeric, $version) {
        $result = '';
        $result.='<div style="border:0px solid black;padding-left:5px;width:90px;height:90px;padding-right:10px;border-radius:10px;">';
        $result.= '<table style="border:0px solid;width:60px;height:60px;padding:3px;" cellpadding="0" cellspacing="0">';
        $result.= '<tr>';
        $result.= '<td>
        <a href="../../../hospitalizacion/visorImagen/visor.php?url=../../carpetaDocumentos/imagenesOdontograma/' . $nomfileupload . ' &rotacion=rot0" target="_blank"><div id="contenedorImagen' . $numeric . '"><img  src="' . $uploadFile . '"  style="cursor: pointer;border-radius:20px;border:1px solid black;width:100px;height:100px;"></div></a></td>';
        $result.= '<td><div style="border:0px solid;">
					<table>
					<tr>
					<td><button   
					onclick="volverAcargar(' . $numeric . ');" style="cursor: pointer;border: 1px solid black; border-radius:5px;width:23px; height: 23px; "><img src="../../../../fastmedical_front/imagen/icono/otro.png"></button></td>
					</tr>
					<tr>
					<td></td>
					</tr>
					<tr>
					<td></td>
					</tr>
					</table></div></td>';
        $result.= '</tr>';
        $result.='<div style="border:0px solid;">
					</div>';
        $result.= '</table>';
        $result.='</div>';
        $result.='<input type="hidden" id="url' . $numeric . '" value="' . $uploadFile . '">';
        $result.='<input type="hidden" id="rotacion' . $numeric . '" value="0">';
        $result.='<input type="hidden" id="comidin' . $numeric . '" value="0">';
        $result.='<input type="hidden" id="width' . $numeric . '" value="">';
        $result.='<input type="hidden" id="version' . $numeric . '" value="' . $version . '">';
        $result.='<input type="hidden" id="height' . $numeric . '" value="">';
        return $result;
    }

    //----------------------------------------------------------------------------------

    function AmostrarLeyenda($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->LmostrarLeyenda($datos);
        $rs = '<table cellspacing="1" style="border:0px solid;">
      <tr style="background-image:url(\'../../../../fastmedical_front/imagen/icono/fondogrid.png\');height: 30px;">
      <td style="width: 200px;border:0px solid #006631">
      <center><p style="font-size:18px;font-family: segoe UI;color:#006631"><b>LEYENDA</b></p></center>
      </td>
      </tr>';
        $contador = count($resultado);
        for ($x = 0; $x <= $contador - 1; $x++) {
            $j = 0;
            if ($resultado[$x][2] == '1' && $resultado[$x][3] == '3' && $resultado[$x][4] == '2') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Azules/" . $resultado[$x][1] . "></a><br><b>Buen Estado</b>";
            } else if ($resultado[$x][2] == '0' && $resultado[$x][3] == '3' && $resultado[$x][4] == '2') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Rojos/" . $resultado[$x][1] . "></a><br><b>Mal Estado</b>";
            } else if ($resultado[$x][2] == '' && $resultado[$x][3] == '1' && $resultado[$x][4] == '1') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Rojos/" . $resultado[$x][1] . "></a>";
            } else if ($resultado[$x][2] == '' && $resultado[$x][3] == '2' && $resultado[$x][4] == '1') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Azules/" . $resultado[$x][1] . "></a>";
            } else if ($resultado[$x][2] == '0' && $resultado[$x][3] == '2' && $resultado[$x][4] == '2') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Azules/" . $resultado[$x][1] . "></a>";
            } else if ($resultado[$x][2] == '0' && $resultado[$x][3] == '3' && $resultado[$x][4] == '1') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Rojos/" . $resultado[$x][1] . "></a><br><b>Mal Estado</b>";
            } else if ($resultado[$x][2] == '1' && $resultado[$x][3] == '3' && $resultado[$x][4] == '1') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Azules/" . $resultado[$x][1] . "></a><br><b>Buen Estado</b>";
            } else if ($resultado[$x][2] == '0' && $resultado[$x][3] == '2' && $resultado[$x][4] == '1') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Azules/" . $resultado[$x][1] . "></a><br><b>Buen Estado</b>";
            }

            $rs.='<tr style="background-color:' . $color . ';" onmouseout=\'this.style.background="#1B843C";\' onmouseover=\'this.style.background="#006631";\'>                 
                    <td>
                    <center><p style="font-size:10px;font-family: arial;color:white">' . $resultado[$x][0] . '</p></center>
                    </td>
                    </tr>
      <tr >
      <td style="background-color:white;">
      <center><a>' . $respuesta[$j][1] . '</a></center>
            <td>
            <p style="display: none; font-size:12px;font-family: segoe UI;color:white;padding-left:10px;">' . $resultado[$x][2] . '</p>
            </td>
            <td>
            <p style="display: none; font-size:12px;font-family: segoe UI;color:white;padding-left:10px;">' . $resultado[$x][3] . '</p>
            </td>
            <td>
            <p style="display: none; font-size:12px;font-family: segoe UI;color:white;padding-left:10px;">' . $resultado[$x][4] . '</p>
            </td>
              
      </tr>';
            $j++;
        }
        $rs.='</table>';
        return $rs;
    }

    // b.vDescripcion,h.vRura,a.bColor,b.iColor,b.iDientesAfectados
    function AhistoriaLeyenda($datos) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->LhistoriaLeyenda($datos);
        $rs = '<table cellspacing="1" style="border:0px solid;">
      <tr style="background-image:url(\'../../../../fastmedical_front/imagen/icono/fondogrid.png\');height: 30px;">
      <td style="width: 200px;border:0px solid #006631">
      <center><p style="font-size:18px;font-family: segoe UI;color:#006631"><b>LEYENDA</b></p></center>
      </td>
      </tr>';
        $contador = count($resultado);
        for ($x = 0; $x <= $contador - 1; $x++) {
            $j = 0;
            if ($resultado[$x][2] == '1' && $resultado[$x][3] == '3' && $resultado[$x][4] == '2') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Azules/" . $resultado[$x][1] . "></a><br><b>Buen Estado</b>";
            } else if ($resultado[$x][2] == '0' && $resultado[$x][3] == '3' && $resultado[$x][4] == '2') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Rojos/" . $resultado[$x][1] . "></a><br><b>Mal Estado</b>";
            } else if ($resultado[$x][2] == '' && $resultado[$x][3] == '1' && $resultado[$x][4] == '1') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Rojos/" . $resultado[$x][1] . "></a>";
            } else if ($resultado[$x][2] == '' && $resultado[$x][3] == '2' && $resultado[$x][4] == '1') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Azules/" . $resultado[$x][1] . "></a>";
            } else if ($resultado[$x][2] == '0' && $resultado[$x][3] == '2' && $resultado[$x][4] == '2') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Azules/" . $resultado[$x][1] . "></a>";
            } else if ($resultado[$x][2] == '0' && $resultado[$x][3] == '3' && $resultado[$x][4] == '1') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Rojos/" . $resultado[$x][1] . "></a><br><b>Mal Estado</b>";
            } else if ($resultado[$x][2] == '1' && $resultado[$x][3] == '3' && $resultado[$x][4] == '1') {
                $respuesta[$j][1] = "<a><img width='50px' height='30px' align='center' src=../../../../fastmedical_front/imagen/odontograma/Azules/" . $resultado[$x][1] . "></a><br><b>Buen Estado</b>";
            }

            $rs.='<tr style="background-color:' . $color . ';" onmouseout=\'this.style.background="#1B843C";\' onmouseover=\'this.style.background="#006631";\'>                 
                    <td>
                    <center><p style="font-size:10px;font-family: arial;color:white">' . $resultado[$x][0] . '</p></center>
                    </td>
                    </tr>
      <tr >
      <td style="background-color:white;">
      <center><a>' . $respuesta[$j][1] . '</a></center>
            <td>
            <p style="display: none; font-size:12px;font-family: segoe UI;color:white;padding-left:10px;">' . $resultado[$x][2] . '</p>
            </td>
            <td>
            <p style="display: none; font-size:12px;font-family: segoe UI;color:white;padding-left:10px;">' . $resultado[$x][3] . '</p>
            </td>
            <td>
            <p style="display: none; font-size:12px;font-family: segoe UI;color:white;padding-left:10px;">' . $resultado[$x][4] . '</p>
            </td>
              
      </tr>';
            $j++;
        }
        $rs.='</table>';
        return $rs;
    }

    //-------------------------------------------------------------------
    public function listarHistoriaOdontogramaxPersona($datos) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->listarHistoriaOdontogramaxPersona($datos);
        $arrayCabecera = array(0 => "Fecha", 1 => "Descripcion", 2 => "Diente", 3 => "Tercero", 4 => "Situacion", 5 => "Doctor", 6 => "url", 7 => "programacion", 8 => "diente", 9 => "Observacion", 10 => "diente1", 11 => "diente2", 12 => "diente3", 13 => "diente4", 14 => "diente5", 15 => "diente6");
        $arrayTamano = array(0 => "60", 1 => "*", 2 => "80", 3 => "*", 4 => "*", 5 => "*", 6 => "*", 7 => "*", 8 => "*", 9 => "*", 10 => "*", 11 => "*", 12 => "*", 13 => "*", 14 => "*", 15 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "ro", 4 => "ro", 5 => "ro", 6 => "ro", 7 => "ro", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro", 12 => "ro", 13 => "ro", 14 => "ro", 15 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default", 11 => "default", 12 => "default", 13 => "default", 14 => "default", 15 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "false", 3 => "true", 4 => "true", 5 => "true", 6 => "true", 7 => "true", 8 => "true", 9 => "true", 10 => "true", 11 => "true", 12 => "true", 13 => "true", 14 => "true", 15 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "left", 4 => "left", 5 => "left", 6 => "left", 7 => "left", 8 => "left", 9 => "left", 10 => "left", 11 => "left", 12 => "left", 13 => "left", 14 => "left", 15 => "left");

        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function listadoHistoriaDiente($idPrograma) {
        $oLActoMedico = new LActoMedico();
        $resultado = $oLActoMedico->listadoHistoriaDiente($idPrograma);
        return $resultado;
    }

    public function cuerpoHIstoriaODontograma($historiaOdontograma) {
        $cadenHistoriaOdontograma = '';
        foreach ($historiaOdontograma as $key => $value) {
            $cadenHistoriaOdontograma.='
                <br><fieldset style=" margin:5px;">
                <legend>' . utf8_encode($value[0]) . '</legend>
';
            $cadenHistoriaOdontograma.='
                <br><center><table  style="border:1px solid #87A57E" width="600" cellpadding="0" cellspacing="0">
                        <tr >
                            <td style="border:1px solid #87A57E;font-size:14px;" bgcolor="#87A57E" align="center"><font><font color="black"><b>Diente 1: </b></font></font></td>
                            <td style="border:1px solid #87A57E;font-size:14px;" bgcolor="#87A57E" align="center"><font><font color="black"><b>Diente 2: </b></font></font></td>
                            <td style="border:1px solid #87A57E;font-size:14px;" bgcolor="#87A57E" align="center"><font><font color="black"><b>Por Tercero: </b></font></font></td>
                            <td style="border:1px solid #87A57E;font-size:14px;" bgcolor="#87A57E" align="center"><font><font color="black"><b>Estado: </b></font></font></td>
                        </tr>
                        <tr >
                            <td style="border:1px solid #87A57E;font-size:12px;" bgcolor="#FBFBFB" align="center">' . utf8_encode($value[1]) . '</td>
                            <td style="border:1px solid #87A57E;font-size:12px;" bgcolor="#FBFBFB" align="center">' . utf8_encode($value[2]) . '</td>
                            <td style="border:1px solid #87A57E;font-size:12px;" bgcolor="#FBFBFB" align="center">' . utf8_encode($value[10]) . '</td>
                            <td style="border:1px solid #87A57E;font-size:12px;" bgcolor="#FBFBFB" align="center">' . utf8_encode($value[11]) . '</td>
                        </tr>
                </table></center>';
            $cadena = '';
            for ($x = 3; $x <= 8; $x++) {
                $cadena.=$value[$x] . ' ';
            }
            $cadenHistoriaOdontograma.='
                <center><table style="border:1px solid #87A57E" width="600" cellpadding="0" cellspacing="0">
                         <tr>
                            <td style="border:1px solid #87A57E;font-size:14px;" bgcolor="#87A57E" align="center"><font color="black"><b>Caras: </b></font></td>
                            <td style="border:1px solid #87A57E;font-size:14px;" bgcolor="#87A57E" align="center"><font color="black"><b>Observacion 1: </b></font></td>
                            <td style="border:1px solid #87A57E;font-size:14px;" bgcolor="#87A57E" align="center"><font color="black"><b>Imagen: </b></font></td>
                        </tr>
                         <tr>
                            <td style="border:1px solid #87A57E;font-size:12px;">
                            <font>' . utf8_encode($cadena) . '</font></td>
                            <td style="border:1px solid #87A57E;font-size:12px;" bgcolor="#F8F8F8" align="center"><font>' . utf8_encode($value[9]) . '</font></td>
                            <td style="border:1px solid #87A57E;font-size:12px;" bgcolor="#F8F8F8" align="center"><font>' . utf8_encode($value[12]) . '</font></td>
                        </tr>
                </table></center><br></fieldset>';
        }
        $resultado = $cadenHistoriaOdontograma;
        return $cadenHistoriaOdontograma;
    }

    function obtenerlistaAsignadasAFiliacion($datos) {
        $oLActoMedico = new LActoMedico();
        $datosComboAsignadas = $oLActoMedico->obtenerlistaAsignadasAFiliacion($datos);
        $cb_comboModuloAsiganados = new Combo($datosComboAsignadas);
        $comboHTML_01 = $cb_comboModuloAsiganados->getOptionsListaHTML();
        $row_ochg = "onchange=\"\"";
        $multiple = "multiple=\"multiple\"";
        $size = "size=\"15\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<select style=\"width:100%;border:2px solid #006631;font-size:14px;font-family:verdana;\" name=\"lst_seleccionadas\" id=\"lst_seleccionadas\" $size $multiple " . $row_ochg . ">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_filtro . $comboHTML_01 . $row_fin_cb;
        return utf8_encode($comboHTML);
    }

    function obtenerlistaANoAsignadasAfiliacion($datos) {
        $oLActoMedico = new LActoMedico();
        $datosComboNoAsignadas = $oLActoMedico->obtenerlistaANoAsignadasAfiliacion($datos);
        $cb_comboModuloNoAsiganados = new Combo($datosComboNoAsignadas);
        $comboHTML_01 = $cb_comboModuloNoAsiganados->getOptionsListaHTML();
        $row_ochg = "onchange=\"\"";
        $multiple = "multiple=\"multiple\"";
        $size = "size=\"15\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr>";
        $row_fin = "</tr></table>";
        $row_etiqueta = "";
        $row_filtro = "<select style=\"width:100%;border:2px solid #006631;font-size:14px;font-family:verdana;\" name=\"lst_Noseleccionadas\" id=\"lst_Noseleccionadas\" $size $multiple " . $row_ochg . ">";
        $row_fin_cb = "</select>";
        $comboHTML = $row_filtro . $comboHTML_01 . $row_fin_cb;
        return utf8_encode($comboHTML);
    }

    function eliminarAnterioresSeleccionadosAfiliaciones($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->eliminarAnterioresSeleccionadosAfiliaciones($datos);
        return $rs;
    }

    function guardarNuevaSeleccionAfiliaciones($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->guardarNuevaSeleccionAfiliaciones($datos);
        return $rs;
    }

    function arrayDatosConsultaCitaHistoria($datos) {
        $oLActoMedico = new LActoMedico();
        $rs = $oLActoMedico->arrayDatosConsultaCitaHistoria($datos);
        return $rs;
    }

    function aCargarTablaProcedientosConsulta($resultadoDatos) {
        require_once("tablaAngelSayes.php");
        $tabla = new TablaAngelSayes();
        $oLActoMedico = new LActoMedico();
        $array = $oLActoMedico->lCargarTablaProcedientosConsulta($resultadoDatos);
        $arrayWidth = array(0 => "150", 1 => "80", 2 => "150", 3 => "150", 4 => "150", 5 => "150", 6 => "150");
        $arrayTitulos = array(0 => "Num. Orden ", 1 => "Fecha", 2 => "Afiliacion", 3 => "Estado", 4 => "IdDetalle", 5 => "Descripcion", 6 => "Estado");
        $arrayAlign = array(0 => "center", 1 => "center", 2 => "left", 3 => "center", 4 => "center", 5 => "left", 6 => "center");
        $arrayType = array(0 => "text", 1 => "text", 2 => "text", 3 => "text", 4 => "text", 5 => "text", 6 => "text");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default");
        $arrayFunctionXCelda = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "");
        $arrayImagenPorCelda = array(0 => "0", 1 => "0", 2 => "0", 3 => "0", 4 => "0", 5 => "0", 6 => "0");
        $arrayUrlImagen = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "");
        $arrayFunction = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "");
        $arrayTitle = array(0 => "", 1 => "", 2 => "", 3 => "", 4 => "", 5 => "", 6 => "");
        $numDatosEnviadosFuncionCadena = 1;
        $height = 220;
        $scroll = 0;
        $resultado = $tabla->contructorTabla($scroll, $numDatosEnviadosFuncionCadena, $arrayFunctionXCelda, $arrayTitle, $arrayFunction, $arrayImagenPorCelda, $arrayUrlImagen, $array, $arrayWidth, $arrayTitulos, $arrayAlign, $arrayType, $arrayCursor, $height);
    }

    public function ArefrescarVPaquetes($datos) {
        $datosPersona['codpersona'] = $datos["codpersona"];

        require_once("../../cvista/actomedico/modulosHC/vPaquetes.php");
    }

    public function AeditarServicioGrupoEtario($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultadoPeriodoEdad1 = $o_LActoMedico->LlistarPeriodoEdad();
        $resultadoTipoServicioCPT1 = $o_LActoMedico->LlistarTipoServicioCPT();
//        $resultadoDatos = $o_LActoMedico->Llistar(); 
        require_once("../../cvista/actomedico/editarEdadServicio.php");
    }

    public function AmodificarServicioGrupoEtario($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultado = $o_LActoMedico->LmodificarServicioGrupoEtario($datos);
        return $resultado;
    }

    public function actualizarEstadoObligatorio($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultado = $o_LActoMedico->LactualizarEstadoObligatorio($datos);
        return $resultado;
    }

    public function listaAtencionespapanicolaum($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultado = $o_LActoMedico->listaAtencionespapanicolaum($datos);
        return $resultado;
    }

    public function aListarTablaLeyendaReporteTriaje($datos) {
        $oLActoMedico = new LActoMedico();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLActoMedico->aCargarDatosPareElGraficoHistoriaTriaje($datos);
        //print_r($arrayFilas);
        $arrayCabecera = array(0 => "Edad Mes", 1 => "Valor", 2 => "Typo",);
        $arrayTamano = array(0 => "*", 1 => "*", 2 => "*");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default");
        $arrayHidden = array(0 => "false", 1 => "false", 2 => "true");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left");

        return $o_TablaHtmlx->generaTabla($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
    }

    public function aCargarGraficoHistoriaTriaje($datos) {
        $o_LActoMedico = new LActoMedico();
        $datosResultado = $o_LActoMedico->aCargarDatosPareElGraficoHistoriaTriaje($datos);
        $countadorFilas = count($datosResultado);
        $data = "var data =[";
        $iAnio = 0;
        $anioCont = 1;
        $varCero = 0;

        for ($x = 0; $x <= $countadorFilas - 1; $x++) {
            $type = $datosResultado[$x][2];
            $vType = '';
            if ($type == 2) {
                $vType = 'sales8';
                $vType3 = 'sales10';
            } else {
                $vType = 'sales1';
                $vType3 = 'sales';
            }
            if ($datosResultado[$x][8] != 0) {
                $iAnio++;
                $vType2 = 'sales7';
                $iAnio = $anioCont;
                $anioCont++;
            } else {
                $vType2 = 'sales1';
                $iAnio = $varCero;
            }

            if ($x < $countadorFilas - 1) {
                $data.= '{sales2 :"' . $datosResultado[$x][7] . '",sales3:"' . $datosResultado[$x][6] . '",sales4:"' . $datosResultado[$x][5] . '",sales5:"' . $datosResultado[$x][4] . '",sales6:"' . $datosResultado[$x][3] . '",' . $vType2 . ':"' . $datosResultado[$x][8] . '",' . $vType . ':"' . $datosResultado[$x][1] . '",sales9:"' . $datosResultado[$x][9] . '",' . $vType3 . ':"' . $datosResultado[$x][10] . '",year:"' . round($datosResultado[$x][0]) . '"},';
            } else if ($x == $countadorFilas - 1) {
                $data.= '{sales2 :"' . $datosResultado[$x][7] . '",sales3:"' . $datosResultado[$x][6] . '",sales4:"' . $datosResultado[$x][5] . '",sales5:"' . $datosResultado[$x][4] . '",sales6:"' . $datosResultado[$x][3] . '",' . $vType2 . ':"' . $datosResultado[$x][8] . '",' . $vType . ':"' . $datosResultado[$x][1] . '",sales9:"' . $datosResultado[$x][9] . '",' . $vType3 . ':"' . $datosResultado[$x][10] . '",year:"' . round($datosResultado[$x][0]) . '"}];';
            }
        }

        $objeto = '
               chart =  new dhtmlXChart({
                            view:"scatter",
                                        container:"divContenedorGraficoTriaje",
                                        value:"#sales8#",
                                        label:"#sales8##sales10# (#year# meses)",
                                        xValue: "#year#",
                                        offset:0,
                            yAxis:{
                                title:"' . $datos['vTitulo'] . '",
                                lines: true
                            },
                            xAxis:{
                                title:"Edad Meses",
                                lines: true
                            },
                            item:{
                                radius:10,
                                borderColor:"#296A3D",
                                borderWidth:3,
                                color:"green",
                                type:"t"
                            }
        });
            chart.addSeries({
            view: "area",
            color: "#D3EE36",
            alpha: 0.3,
            value:"#sales2#",
            lines: true,
            tooltip:{
                template:"#sales2#"
            }
        });
             chart.addSeries({
            view: "area",
            color: "#58DCCD",
            alpha: 0.3,
            value:"#sales3#",
            lines: true,
            tooltip:{
                template:"#sales3#"
            }
        });chart.addSeries({
            view: "area",
             color: "#E33FC7",
            alpha: 0.2,
            value:"#sales4#",
            lines: true,
            tooltip:{
                template:"#sales4#"
            }
        });chart.addSeries({
            view: "area",
             color: "#EE4339",
            alpha: 0.2,
            value:"#sales5#",
            lines: true,
            tooltip:{
                template:"#sales5#"
            }
        });
             chart.addSeries({
            view: "area",
             color: "black",
            alpha: 0.1,
            value:"#sales6#",
            lines: true,
            tooltip:{
                template:"#sales6#"
            }
        });
         chart.addSeries({
            view: "bar",
             color: "#CFCFCF",
            alpha: 0.2,
            label: "#sales9#",
            value:"#sales7#",
            lines: false,
            width: 0
            
        });';


        $contructor = 'chart.parse(data, "json");';
        $resultado = $data . $objeto . $contructor;
        return $resultado;
    }

    function aInsertaActualizaSintomatico($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultado = $o_LActoMedico->lInsertaActualizaSintomatico($datos);
        return $resultado;
    }
    function aActualizarNumeroDiasSintomatico($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultado = $o_LActoMedico->lActualizarNumeroDiasSintomatico($datos);
        return $resultado;
    }
     function aListarSintomaticos($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultado = $o_LActoMedico->lListarSintomaticos($datos);
        return $resultado;
    }
    
    function aGenerarSintomaticoRespiratorio($datos) {
        $o_LActoMedico = new LActoMedico();
        $resultado = $o_LActoMedico->lGenerarSintomaticoRespiratorio($datos);
        return $resultado[0][0];
    }
   
    
    

}

?>
