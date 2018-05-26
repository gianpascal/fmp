<?php

require_once("../../../pholivo/Html.php");
require_once("../../clogica/LCaja.php");
require_once("../../../pholivo/tablaDHTMLX.php");

class ActionCaja {
    /* 	private $oLCaja;
      private $record;
      public function __construct(){

      }
      public function listaCajaGeneral($sector,$habilitado){
      $oLCaja = new LCaja();
      $arrayFilas = $oLCaja->getListaCajaGeneral($sector,$habilitado);
      $arrayCabecera = array('0'=>"CAJA","1"=>"UBICACION","5"=>"SECTOR","7"=>"ING DIARIO","8"=>"ESTADO","4"=>"HABILITADO","opcion"=>"OPCIONES");
      $oTabla = new Tabla($arrayCabecera,$arrayFilas,'col1','col2','filaEncimaNaranja','titleb','parametro','');
      $tablaHTML = $oTabla->getTabla();
      $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
      $row_fin= "</table>";
      return $row_ini.$tablaHTML.$row_fin;
      }
      public function listaCajaResumen(){
      $oLCaja = new LCaja();
      $arrayFilas = $oLCaja->getListaCajaResumen();
      $arrayCabecera = array('1'=>"SECTOR","2"=>"CAJAS","3"=>"INGRESO");
      $oTabla = new Tabla($arrayCabecera,$arrayFilas,'col1','col2','filaEncimaNaranja','titleb','parametro','');
      $tablaHTML = $oTabla->getTabla();
      $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
      $row_fin= "</table>";
      return $row_ini.$tablaHTML.$row_fin;
      }
      public function seleccionListaSector($sector){
      $oLCaja = new LCaja();
      $arrayCombo = $oLCaja->getSeleccionaListaSector($sector);
      $oCombo = new Combo($arrayCombo);
      $sector = $sector==''?'SE003':$sector;
      $comboHTML = $oCombo->getOptionsHTML($sector);
      return $oCombo->getSelecccionHTML($comboHTML,'cmb_sector','combo_ancho','onchange',"seleccionaSector_Habilitado()");
      }
      public function seleccionListaEstado($estado){
      $estado = $estado==''?'1':$estado;
      $oLCaja = new LCaja();
      $arrayCombo = $oLCaja->getSeleccionaListaEstado();
      $oCombo = new Combo($arrayCombo);
      $comboHTML = $oCombo->getOptionsHTML($estado);
      return $oCombo->getSelecccionHTML($comboHTML,'cmb_habilitado','combo_ancho','onchange',"seleccionaSector_Habilitado()");
      }
      public function listaDetalleTrabajador($caja){
      $oLCaja = new LCaja();
      $arrayFilas = $oLCaja->getListaDetalleTrabajador($caja);
      $arrayCabecera = array('0'=>"ID","1"=>"NOMBRE","2"=>"APE. PATERNO","3"=>"APE. MATERNO","6"=>"ESTADO","opcion"=>"VER");
      $oTabla = new Tabla($arrayCabecera,$arrayFilas,'col1','col2','filaEncimaNaranja','titleb','parametro','');
      $tablaHTML = $oTabla->getTabla();
      $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
      $row_fin= "</table>";
      return $tablaHTML = $row_ini.$tablaHTML.$row_fin;
      }
      public function listaTrabajadorComprobante($persona,$caja){
      $oLCaja = new LCaja();
      $arrayFilas = $oLCaja->getListaTrabajadorComprobante($persona,$caja);
      $this->record = $oLCaja->getRowTrabajadorComprobante();
      $arrayCabecera = array('5'=>"ID","7"=>"COMPROBANTE","6"=>"ESTADO");
      $oTabla = new Tabla($arrayCabecera,$arrayFilas,'col1','col2','filaEncimaNaranja','titleb','parametro','');
      $tablaHTML = $oTabla->getTabla();
      $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
      $row_fin= "</table>";
      return $tablaHTML = $row_ini.$tablaHTML.$row_fin;
      }
      public function listaTrabajadorComprobanteRow(){
      return $this->record;
      }
      public function muestraCajeroDatos($persona,$caja){
      $tablaHTML = $this->listaTrabajadorComprobante($persona,$caja);
      $row = $this->listaTrabajadorComprobanteRow();
      $tablaHTML_ini = "<div style='height:100px; width:100%; overflow:auto'><table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
      $tablaHTML_fin= "</table></div>";
      $tablaInteriorHTML = '<table width="100%" cellpadding="0" cellspacing="1px">
      <tr><td width="23%" align="center"><img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/kuser_big.png" /></td>
      <td width="77%">
      <table width="100%">
      <tr class="col1"><td width="50%">Nombre</td><td width="50%">'.$row['vnombre'].'&nbsp;</td></tr>
      <tr class="col2"><td>Apellido Paterno</td><td>'.$row['vapellido_pat'].'&nbsp;</td></tr>
      <tr class="col1"><td>Apellido Materno</td><td>'.$row['vapellido_mat'].'&nbsp;</td></tr>
      </table>
      </td></tr></table>';
      return $tablaHTML = $tablaInteriorHTML.$tablaHTML_ini.$tablaHTML.$tablaHTML_fin;
      }
      public function listaCajaComprobante($caja){
      $oLCaja = new LCaja();
      $arrayFilas = $oLCaja->getListaCajaComprobante($caja);
      $arrayCabecera = array('2'=>"ID","0"=>"NOMBRE","4"=>"SERIE","5"=>"NUMERO","6"=>"ESTADO","7"=>"HABILITADO");
      $oTabla = new Tabla($arrayCabecera,$arrayFilas,'col1','col2','filaEncimaNaranja','titleb','parametro','');
      $tablaHTML = $oTabla->getTabla();
      $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
      $row_fin= "</table>";
      return $tablaHTML = $row_ini.$tablaHTML.$row_fin;
      }
      public function listaComprobanteSerie(){
      $oLCaja = new LCaja();
      $arrayFilas = $oLCaja->getListaComprobanteSerie();
      $arrayCabecera = array('0'=>"ID","6"=>"NOMBRE","1"=>"SERIE","4"=>"NUMERO","5"=>"HABILITADO");
      $oTabla = new Tabla($arrayCabecera,$arrayFilas,'col1','col2','filaEncimaNaranja','titleb','parametro','');
      $tablaHTML = $oTabla->getTabla();
      $row_ini = "<table width='100%' border='0' cellpadding='0' cellspacing='1px' class='grid'>";
      $row_fin= "</table>";
      return $tablaHTML = $row_ini.$tablaHTML.$row_fin;
      }
      public function muestraDetalleComprobante($caja){
      $tablaCajaComprobanteHTML = $this->ListaCajaComprobante($caja);
      $tablaComprobanateSerieHTML = $this->listaComprobanteSerie();
      $divHTML = '<div id="caja_comprobante" style="float:left; width:55%; padding:2px; margin: 5px 0px 5px 5px; height:260px;">
      <fieldset class="RG">
      <legend>CAJA - COMPROBANTES</legend>
      <div id="grid_caja_comprobante" style=" height:160px; width:100%; overflow:auto; vertical-align:top; border:solid #CCCCCC; border-width:0.1em">';
      $divHTML .=	$tablaCajaComprobanteHTML;
      $divHTML .= '</div></fieldset></div>
      <div id="comprobante" style="float:left; width:40%; padding:2px; margin: 5px 5px 5px 10px; height:260px;">
      <fieldset class="RG">
      <legend>LISTADO COMPROBANTES</legend>
      <div id="grid_comprobante" style=" height:160px; width:100%; overflow:auto; vertical-align:top; border:solid #CCCCCC; border-width:0.1em">';
      $divHTML .=	$tablaComprobanateSerieHTML;
      $divHTML .= '</div></fieldset></div>';
      return $divHTML;
      }
     */

    private $oLCaja;
    private $record;

    public function __construct() {
        
    }

    public function mostrarCierreCaja() {
        require_once("../../cvista/caja/vCierreCaja.php");
    }

    public function listadoCajas($datos) {
        $o_LCaja = new LCaja();
        $rs = $o_LCaja->obtenerListadoCajas();
        $seleccionado = '';
        $resultadoArray = array();
        foreach ($rs as $fila) {
            $op = $fila[0];
            $resultadoArray[$op] = htmlentities($fila[0]);
        }
        $o_ComboCajas = new Combo($resultadoArray);
        //$comboHTML_01 = $o_ComboSede->getOptionsHTMLFirstSelected();
        $comboHTML_01 = $o_ComboCajas->getOptionsHTML($seleccionado);
        //$row_ochg = "onchange=\"myajax.Link('../../ccontrol/control/control.php?p1=busqueda_filtro_sede&opcionBusqueda='+document.getElementById('hOpcionBusqueda').value+'&patron='+document.getElementById('cal01').getElementsByTagName('input')[6].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[5].value+'-'+document.getElementById('cal01').getElementsByTagName('input')[4].value+'&sede='+document.getElementById('hIdFiltroSede').value,'divConsulCronograma');\"";
        $row_ochg = "onchange=\"" . $datos["funcionEjecutar"] . "\"";
        $row_ini = "<table width=\"100%\" align=\"left\"><tr><td align=\"left\" width=\"50%\" style=\"font-family:Arial;font-size:11pt\">";
        $row_fin = "</tr></table>";
        $row_etiqueta = "</td>";
        $row_filtro = "<td align=\"left\" width=\"50%\" style=\"font-family:Arial;font-size:11pt\"><select align=\"center\" style=\"font-family:Arial;font-size: 11pt\" name=\"cb_filtroCajas\" id=\"cb_filtroCajas\" " . $row_ochg . ">";
        $row_fin_cb = "</select></td>";
        $comboHTML = $row_ini . $row_etiqueta . $row_filtro . $comboHTML_01 . $row_fin_cb . $row_fin;
        return $comboHTML;
    }

    public function listarResponsabledesuCaja($datos) {
        $o_LCaja = new LCaja();
        $rs = $o_LCaja->obtenerResponsabledesuCaja($datos);
        return $rs;
    }

    public function mostrarTablaParteDiariaCierreCaja($datos) {
        $o_TablaHtmlx = new tablaDHTMLX();
        $oLCaja = new LCaja();
        $datos == '' ? $arrayFilas = array() : $arrayFilas = $oLCaja->obtenerParteDiarioCierreCaja($datos);
        $arrayCabecera = array("0" => "Id", "1" => "Código", "2" => "Descripción", "3" => "Total");
        $arrayTamano = array("0" => "50", "1" => "100", "2" => "*", "3" => "100");
        $arrayTipo = array("0" => "ro", "1" => "ro", "2" => "ro", "3" => "ro");
        $arrayAlineacion = array("0" => "center", "1" => "center", "2" => "left", "3" => "center");
        $arrayHidden = array("0" => "true", "1" => "false", "2" => "false", "3" => "false");
        return $o_TablaHtmlx->stringXml($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayAlineacion, 0, $arrayHidden);
    }

    public function cerrarCajaCierreCaja($datos) {
        $o_LCaja = new LCaja();
        $rs = $o_LCaja->cerrarCajaCierreCaja($datos);
        return $rs;
    }

    public function anularCierreCaja($datos) {
        $o_LCaja = new LCaja();
        $rs = $o_LCaja->anularCierreCaja($datos);
        return $rs;
    }

    public function selecciontipoComprobante($datos) {
        $o_LCaja = new LCaja();
        $rs = $o_LCaja->selecciontipoComprobante($datos);

        $cboSedeEmpresaArea = '<select id="cboComprobante" name="cboComprobante" style="width: 200px;" onchange="comprobantesEmitidos()">';
        $cboSedeEmpresaArea.='<option value="">- Seleccionar -</option>';
        foreach ($rs as $i => $value) {
            $cboSedeEmpresaArea.='<option  value="' . $value[2] . $value[0] . $value[1] . '">' . htmlentities($value[14]) . '</option>';
        }
        $cboSedeEmpresaArea.='</select>';
        return $cboSedeEmpresaArea;
    }

    public function menuMostrarReportePorNroCaja() {
        $o_LCaja = new LCaja();
        $resultado = $o_LCaja->obtenerListadoCajas();
        require_once("../../cvista/caja/ReportePorNumeroCaja.php");
        //return resultado;  
    }
    
    

    public function reporteCajaPorCajero($datos) {
        $o_LCaja = new LCaja();
        if($datos["fila"]==1){
        $resultado = $o_LCaja->reporteCajaPorCajero($datos);
        }
         if($datos["fila"]==2){
        $resu = $o_LCaja->reporteCajaXpersona($datos);
        }
        require_once("../../cvista/caja/ReporteNumeroCajaro.php");
        //return resultado;  
    }
    
    function aReporteCaja() {
        
        
        require_once('../../../hospitalizacion/cvista/caja/vReporteCaja.php');
    }
    
    function aCargarReporteCaja($parametros) {
        $o_LCaja = new LCaja();
        $o_TablaHtmlx = new tablaDHTMLX();
        $arrayFilas = $o_LCaja->lCargarReporteCaja($parametros);
        $arrayColores=array();
        $arrayCabecera = array(0 => "iIdPagos",
            1 => "Código",
            2 => "Paterno", 
            3 => "Materno", 
            4 => "Nombre", 
            5 => "Tipo Comprobate", 
            6 => "Serie",
            7 => "Comprobante", 
            8 => "Fecha Emisión", 
            9 => "Imponible", 
            10 => "IGV", 
            11 => "Total", 
            12 => "Descuento", 
            13 => "Ver",
            14 => "Anul");
          
        $arrayTamano = array(0 => "45", 
            1 => "45", 
            2 => "*", 
            3 => "*",
            4 => "*", 
            5 => "*",
            6 => "50", 
            7 => "50",
            8 => "100", 
            9 => "50", 
            10 => "50", 
            11 => "50", 
            12 => "50",
            13 => "30",           
            14 => "30");
        $arrayTipo = array(0 => "ro",
            1 => "ro", 
            2 => "ro",
            3 => "ro", 
            4 => "ro", 
            5 => "ro", 
            6 => "ro", 
            7 => "co", 
            8 => "ro", 
            9 => "ro", 
            10 => "ro", 
            11 => "ro", 
            12 => "ro",            
            13 => "img", 
            14 => "img");
        $arrayCursor = array(0 => "default", 
            1 => "default",
            2 => "default", 
            3 => "default",
            4 => "default",
            5 => "default", 
            6 => "default", 
            7 => "default", 
            8 => "default", 
            9 => "default", 
            10 => "default", 
            11 => "default", 
            12 => "default", 
            13 => "pointer", 
            14 => "pointer");
        $arrayHidden = array(0 => "true",
            1 => "false",
            2 => "false",
            3 => "false",
            4 => "false",
            5 => "false", 
            6 => "false",
            7 => "false",
            8 => "false",
            9 => "false",
            10 => "false", 
            11 => "false", 
            12 => "false",
            13 => "false",
        
            14 => "false");  
        $arrayAling = array(0 => "right", 
            1 => "left", 
            2 => "left", 
            3 => "left", 
            4 => "left",
            5 => "left", 
            6 => "left", 
            7 => "left", 
            8 => "left", 
            9 => "right", 
            10 => "right", 
            11 => "right", 
            12 => "rigth", 
            13 => "center",             
            14 => "center", 
            );
       return $o_TablaHtmlx->generaTablaFullCombo($arrayCabecera, $arrayFilas, $arrayTamano, $arrayTipo, $arrayCursor, $arrayHidden, $arrayAling, '');
    
    }
    function aExportarReporteCaja($parametros){
        $o_LCaja = new LCaja();
       
        $arrayFilas = $o_LCaja->lExportarReporteCaja($parametros);
          require_once '../../cvista/caja/vExportarReporteCaja.php';
    }
}

