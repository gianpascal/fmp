<?php

include_once("../../clogica/LCarnetizacion.php");
require_once("../../../pholivo/tablaDHTMLX.php");

class ActionCarnetizacion {

    public function __construct() {
        
    }

//creado por el lobo 24/09/2012
    public function AmenuCarnetizacion() {
        $oLCarnetizacion = new LCarnetizacion();
        $comboTipoDocumentos = $oLCarnetizacion->comboTipoDocumento();
        $comboTipoCertifica = $oLCarnetizacion->comboTipoCertifica();
        require_once('../../../hospitalizacion/cvista/carnetizacion/vistaCarnetizacion.php');
    }

    public function AbuscarPersonaCarnetizacion($datos) {
        $oLCarnetizacion = new LCarnetizacion();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $oLCarnetizacion->LbuscarPersonaCarnetizacion($datos);
        $cboActividadesTipoCertificado = $oLCarnetizacion->LcargarComboTipoCertificado();
        $cboActividadesTipoCertificado = is_array($cboActividadesTipoCertificado) ? $cboActividadesTipoCertificado : array();

        $cboProcedencia = $oLCarnetizacion->LcargarComboProcedencia();
        $cboProcedencia = is_array($cboProcedencia) ? $cboProcedencia : array();

        $columnaCombo = 6;
        $columnaCombo1 = 7;
        $arrayCabecera = array(0 => "idPacienteLaboratorio", 1 => "cod Per", 2 => "Nombre", 3 => "Ver", 4 => "DNI", 5 => "Certificado", 6 => "Tipo Certificado", 7 => "Procedencia", 8 => "Resultado", 9 => "Fec. Emisión", 10 => "Fec. Caducidad", 11 => "Impreso", 12 => "Entregado", 13 => "bImpreso", 14 => "bEntregado", 15 => "idCertificado", 16 => "iidEntregaCertificados", 17 => "iIdSubTipoCertificado", 18 => "fechaActual", 19 => "fechaCaducidad", 20 => "iIdProcedenciaCarnetizacion", 21 => "Imprimir", 22 => "Nombre", 23 => "Paterno", 24 => "Materno", 25 => "Apellidos", 26 => "Permiso Impresion", 27 => "Estado Impresicion", 28 => "Duplicado");
        $arrayTamano = array(0 => "20", 1 => "60", 2 => "200", 3 => "60", 4 => "60", 5 => "130", 6 => "110", 7 => "90", 8 => "80", 9 => "60", 10 => "70", 11 => "60", 12 => "60", 13 => "60", 14 => "60", 15 => "60", 16 => "60", 17 => "60", 18 => "60", 19 => "60", 20 => "60", 21 => "60", 22 => "60", 23 => "60", 24 => "60", 25 => "60", 26 => "60", 27 => "60", 28 => "60");
        $arrayTipo = array(0 => "ro", 1 => "ro", 2 => "ro", 3 => "img", 4 => "ro", 5 => "ro", 6 => "co", 7 => "co", 8 => "ro", 9 => "ro", 10 => "ro", 11 => "ro", 12 => "ro", 13 => "ro", 14 => "ro", 15 => "ro", 16 => "ro", 17 => "ro", 18 => "ro", 19 => "ro", 20 => "ro", 21 => "img", 22 => "ro", 23 => "ro", 24 => "ro", 25 => "ro", 26 => "ro", 27 => "ro", 28 => "ro");
        $arrayCursor = array(0 => "default", 1 => "default", 2 => "default", 3 => "default", 4 => "default", 5 => "default", 6 => "default", 7 => "default", 8 => "default", 9 => "default", 10 => "default", 11 => "default", 12 => "default", 13 => "default", 14 => "default", 15 => "default", 16 => "default", 17 => "default", 18 => "default", 19 => "default", 20 => "default", 21 => "pointer", 22 => "default", 23 => "default", 24 => "default", 25 => "default", 26 => "default", 27 => "default", 28 => "default");
        $arrayHidden = array(0 => "true", 1 => "false", 2 => "false", 3 => "false", 4 => "false", 5 => "false", 6 => "false", 7 => "false", 8 => "false", 9 => "false", 10 => "false", 11 => "false", 12 => "false", 13 => "true", 14 => "true", 15 => "true", 16 => "true", 17 => "true", 18 => "true", 19 => "true", 20 => "true", 21 => "false", 22 => "true", 23 => "true", 24 => "true", 25 => "true", 26 => "true", 27 => "true", 28 => "false");
        $arrayAling = array(0 => "left", 1 => "left", 2 => "left", 3 => "center", 4 => "center", 5 => "center", 6 => "center", 7 => "center", 8 => "center", 9 => "center", 10 => "center", 11 => "center", 12 => "center", 13 => "center", 14 => "center", 15 => "center", 16 => "center", 17 => "center", 18 => "center", 19 => "center", 20 => "center", 21 => "center", 22 => "center", 23 => "center", 24 => "center", 25 => "center", 26 => "center", 27 => "center", 28 => "center");
        //return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor,$arrayHidden,$arrayAlineacion);
//        return $o_TablaHtmlx->generaTablaFullCombo($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling);
        return $o_TablaHtmlx->generaTablaFullComboCartetizacion($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling, $cboActividadesTipoCertificado, '', $columnaCombo, $columnaCombo1, $cboProcedencia);
    }

    public function AbuscarPorBotonPersonaCarnetizacion($datos) {
        $oLCarnetizacion = new LCarnetizacion();
        $arrayCargarCantidadCarnetizacion = $oLCarnetizacion->LbuscarPorBotonPersonaCarnetizacion($datos);
        $cadena = '<table>';
        $cadena .= '<tr>';
        foreach ($arrayCargarCantidadCarnetizacion as $k => $value) {
            if ($value[0] == 1) {
                $cadena .= '<td>';
                $cadena .= '<font color="blue" size="2"> <b>' . 'Manipulador: ' . '</b></font>';
                $cadena .= '</td>';
                $cadena .= '<td>';
                $cadena .= "<input type='txt' id='txtNombre' name='txtNombre'disabled width='5px'height='15px'size='5' value='" . $value[1] . "' />";
                $cadena .= '</td>';
                $cadena .= '<td style="height: 15px" >';
                $cadena .= '</td>';
            }
            if ($value[0] == 2) {
                $cadena .= '<td>';
                $cadena .= '<font color="blue" size="2"> <b>' . 'No Manipulador: ' . '</b></font>';
                $cadena .= '</td>';
                $cadena .= '<td>';
                $cadena .= "<input type='txt' id='txtNombre' name='txtNombre'disabled width='5px'height='15px'size='5' value='" . $value[1] . "' />";
                //   <input id='txtnomDocumento' name='txtnomDocumento' type='hidden' value='" . $echodoc . "' />
                $cadena .= '</td>';
                $cadena .= '<td style="height: 15px" >';
                $cadena .= '</td>';
            }
            if ($value[0] == 3) {
                $cadena .= '<td>';
                $cadena .= '<font color="blue" size="2"> <b>' . 'Pres Nupcial: ' . '</b></font>';
                $cadena .= '</td>';
                $cadena .= '<td>';
                $cadena .= "<input type='txt' id='txtNombre' name='txtNombre'disabled width='5px'height='15px'size='5' value='" . $value[1] . "' />";
                $cadena .= '</td>';
                $cadena .= '<td style="height: 15px" >';
                $cadena .= '</td>';
            }
            if ($value[0] == 4) {
                $cadena .= '<td>';
                $cadena .= '<font color="blue" size="2"> <b>' . 'Cetificado Medico Preventivo: ' . '</b></font>';
                $cadena .= '</td>';
                $cadena .= '<td>';
                $cadena .= "<input type='txt' id='txtNombre' name='txtNombre'disabled width='5px'height='15px'size='5' value='" . $value[1] . "' />";
                $cadena .= '</td>';
                $cadena .= '<td style="height: 15px" >';
                $cadena .= '</td>';
            }
        }
        $cadena .= '</tr>';

        $cadena = $cadena . '</table>';
        return $cadena;
    }

    public function AbuscarCboCantidadCertificadoPorTipo($datos) {
        $oLCarnetizacion = new LCarnetizacion();
        $arrayCargarCantidadCarnetizacion = $oLCarnetizacion->LbuscarCboCantidadCertificadoPorTipo($datos);
        $cadena = '<table>';
        $cadena .= '<tr>';
        foreach ($arrayCargarCantidadCarnetizacion as $k => $value) {
            if ($value[0] == 1) {
                $cadena .= '<td>';
                $cadena .= '<font color="blue" size="2"> <b>' . 'Manipulador: ' . '</b></font>';
                $cadena .= '</td>';
                $cadena .= '<td>';
                $cadena .= "<input type='txt' id='txtNombre' name='txtNombre'disabled width='5px'height='15px'size='5' value='" . $value[1] . "' />";
                $cadena .= '</td>';
                $cadena .= '<td style="height: 15px" >';
                $cadena .= '</td>';
            }
            if ($value[0] == 2) {
                $cadena .= '<td>';
                $cadena .= '<font color="blue" size="2"> <b>' . 'No Manipulador: ' . '</b></font>';
                $cadena .= '</td>';
                $cadena .= '<td>';
                $cadena .= "<input type='txt' id='txtNombre' name='txtNombre'disabled width='5px'height='15px'size='5' value='" . $value[1] . "' />";
                //   <input id='txtnomDocumento' name='txtnomDocumento' type='hidden' value='" . $echodoc . "' />
                $cadena .= '</td>';
                $cadena .= '<td style="height: 15px" >';
                $cadena .= '</td>';
            }
            if ($value[0] == 3) {
                $cadena .= '<td>';
                $cadena .= '<font color="blue" size="2"> <b>' . 'Pres Nupcial: ' . '</b></font>';
                $cadena .= '</td>';
                $cadena .= '<td>';
                $cadena .= "<input type='txt' id='txtNombre' name='txtNombre'disabled width='5px'height='15px'size='5' value='" . $value[1] . "' />";
                $cadena .= '</td>';
                $cadena .= '<td style="height: 15px" >';
                $cadena .= '</td>';
            }
            if ($value[0] == 4) {
                $cadena .= '<td>';
                $cadena .= '<font color="blue" size="2"> <b>' . 'Cetificado Medico Preventivo: ' . '</b></font>';
                $cadena .= '</td>';
                $cadena .= '<td>';
                $cadena .= "<input type='txt' id='txtNombre' name='txtNombre'disabled width='5px'height='15px'size='5' value='" . $value[1] . "' />";
                $cadena .= '</td>';
                $cadena .= '<td style="height: 15px" >';
                $cadena .= '</td>';
            }
        }
        $cadena .= '</tr>';

        $cadena = $cadena . '</table>';
        return $cadena;
    }

//    public function AcargarComboTipoCertificado() {
//        $oLCarnetizacion = new LCarnetizacion();
//        $cboActividadesTipoCertificado = $oLCarnetizacion->LcargarComboTipoCertificado();
//        $cboActividadesTipoCertificado = is_array($cboActividadesTipoCertificado) ? $cboActividadesTipoCertificado : array();
//        $combo = '';
//        $combo = '<select name="comboProcedencia" id="comboProcedencia" onchange="filterByProcedencia()" style="background-color: #B3EB75">';
//        $combo.='<option value="-1" selected="selelected" style="background-color: #FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>';
//        foreach ($cboActividadesTipoCertificado as $i => $value) {
//            $combo.='<option value="' . $value[0] . '" style="background-color:' . $value[2] . ' ;" >';
//            $combo.=htmlentities($value[1]) . '</option>';
//        }
//        $combo.='</select>';
//        return $combo;
//    }

    public function AactualizarTipoCertificado($datos) {
        $oLCarnetizacion = new LCarnetizacion();
        $res = $oLCarnetizacion->LactualizarTipoCertificado($datos);

        return $res;
    }

    public function AconfirmarImpresion($datos) {
        $oLCarnetizacion = new LCarnetizacion();
        $res = $oLCarnetizacion->LconfirmarImpresion($datos);

        return $res;
    }

    public function AconfirmarEntregado($datos) {
        $oLCarnetizacion = new LCarnetizacion();
        $res = $oLCarnetizacion->LconfirmarEntregado($datos);

        return $res;
    }

    public function AactualizarCertificado($datos) {
        $oLCarnetizacion = new LCarnetizacion();
        $resultado = $oLCarnetizacion->LactualizarCertificado($datos);
        $codigo = trim($datos["c_cod_per"]);
        $nombre_fichero = "../../../../carpetaDocumentos/materialesLaboratorio/fotosCarnet/" . $codigo . ".JPG";
        if (file_exists($nombre_fichero)) {//$datos["c_cod_per"] 
            $resa = '1';
        } else {
//            echo "El fichero $nombre_fichero existe";
            $resa = '0';
        }
        return $resa;
    }

    public function AactualizarProcedencia($datos) {
        $oLCarnetizacion = new LCarnetizacion();
        $res = $oLCarnetizacion->LactualizarProcedencia($datos);

        return $res;
    }

    public function AfotoPersonaCarnetizacion($datos) {
        $oLCarnetizacion = new LCarnetizacion();
        $codigo=$datos["c_cod_per"];
        $nombre_fichero = "../../../../carpetaDocumentos/materialesLaboratorio/fotosCarnet/" . $codigo . ".JPG";
        if (file_exists($nombre_fichero)) {//$datos["c_cod_per"] 
           $cadena = '<img width="80px" height="106px" align="left" src="../../../../carpetaDocumentos/materialesLaboratorio/fotosCarnet/'.$datos["c_cod_per"].'.JPG"/>';
        } else {
//            echo "El fichero $nombre_fichero existe";
          $cadena = '<img width="80px" height="106px" align="left" src="../../../../carpetaDocumentos/materialesLaboratorio/fotosCarnet/tufoto.JPG"/>';
        }

        return $cadena;
    }

}

?>
