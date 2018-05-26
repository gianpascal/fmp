<?php

require_once("../../cdatos/DCaja.php");

class LCaja {
    /*
      private $dCaja;
      public function __construct(){
      $this->dCaja = new DCaja();
      }
      public function getListaCajaGeneral($sector='',$habilitado=''){
      $sector = $sector==''?'%':$sector;
      $habilitado = $habilitado==''?1:$habilitado;
      switch($habilitado){
      case 0: $habilitado1='t'; $habilitado2='f';	break;
      case 1: $habilitado1='t'; $habilitado2='t';	break;
      case 2: $habilitado1='f'; $habilitado2='f';	break;
      }
      $record = $this->dCaja->getArrayListaCajaGeneral($sector,$habilitado1,$habilitado2);
      $resultadoArray = array();
      foreach ($record as $fila){
      $habilitado = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/agt_action_success.png" border="0" alt="HABILITADO" title="HABILITADO"/>';
      $deshabilitado = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/agt_action_fail.png" border="0" alt="DESHABILITADO" title="DESHABILITADO"/>';
      $fila[4] = $fila[4]=='t'?$habilitado:$deshabilitado;
      $fila['opcion']='
      <a href="#" onclick=myajax.Link("../../ccontrol/control/control.php?p1=caj_detalle_trabajador&caja='.$fila[0].'","resumen_caja")>
      <img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/add_user2.png" border="0" alt="DETALLES" title="DETALLES"/></a>&nbsp;
      <a href="#" onclick=myajax.Link("../../ccontrol/control/control.php?p1=caj_detalle_comprobante&caja='.$fila[0].'","resumen_caja")>
      <img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/mostrar.png" border="0" alt="DETALLES" title="DETALLES"/></a>&nbsp;
      <a href="#" onclick=myajax.Link("../../ccontrol/control/control.php?p1=caj_detalle_ingreso_caja&caja='.$fila[0].'","resumen_caja")>
      <img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/barras.png" border="0" alt="ESTADISTICA" title="ESTADISTICA"/></a>';
      array_push($resultadoArray,$fila);
      }
      return $resultadoArray;
      }
      public function getListaCajaResumen(){
      $record = $this->dCaja->getArrayListaCajaResumen();
      $resultadoArray = array();
      foreach ($record as $fila){
      array_push($resultadoArray,$fila);
      }
      return $resultadoArray;
      }
      public function getSeleccionaListaSector($sector=''){
      $sector = $sector==''?'%':$sector;
      $record = $this->dCaja->getArraySector($sector);
      $resultadoArray = array();
      foreach ($record as $fila){
      $resultadoArray[$fila[0]] = $fila[1];
      }
      return $resultadoArray;
      }
      public function getSeleccionaListaEstado(){
      $record = array("0"=>"TODOS","1"=>"HABILITADO","2"=>"DESHABILITADO");
      $resultadoArray = array();
      foreach ($record as $fila){
      array_push($resultadoArray,$fila);
      }
      return $resultadoArray;
      }
      public function getListaDetalleTrabajador($caja){
      $record = $this->dCaja->getArrayListaDetalleTrabajador($caja);
      $resultadoArray = array();
      foreach ($record as $fila) {
      $habilitado = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/agt_action_success.png" border="0" alt="HABILITADO" title="HABILITADO"/>';
      $deshabilitado = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/agt_action_fail.png" border="0" alt="DESHABILITADO" title="DESHABILITADO"/>';
      $fila[6] = $fila[6]=='t'?$habilitado:$deshabilitado;
      $fila['opcion']='
      <a href="#" onclick=myajax.Link("'.$_SESSION['path_principal'].'hospitalizacion/ccontrol/control/control.php?p1=caj_cajero_datos&persona='.$fila[0].'&caja='.$fila[4].'&incluye=1","grid_cajero_datos")><img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/mostrar.png" border="0" alt="MOSTRAR" title="MOSTRAR"/></a>';
      array_push($resultadoArray,$fila);
      }
      return $resultadoArray;
      }
      public function getListaTrabajadorComprobante($persona,$caja){
      $record = $this->dCaja->getArrayListaTrabajadorComprobante($persona,$caja);
      $resultadoArray = array();
      foreach ($record as $fila) {
      $habilitado = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/agt_action_success.png" border="0" alt="HABILITADO" title="HABILITADO"/>';
      $deshabilitado = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/agt_action_fail.png" border="0" alt="DESHABILITADO" title="DESHABILITADO"/>';
      $fila[6] = $fila[6]=='t'?$habilitado:$deshabilitado;
      array_push($resultadoArray,$fila);
      }
      return $resultadoArray;
      }
      public function getRowTrabajadorComprobante(){
      return $this->dCaja->getRow();
      }
      public function getListaCajaComprobante($caja){
      $record = $this->dCaja->getArrayListaCajaComprobante($caja);
      $resultadoArray = array();
      foreach ($record as $fila){
      $habilitado = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/agt_action_success.png" border="0" alt="HABILITADO" title="HABILITADO"/>';
      $deshabilitado = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/agt_action_fail.png" border="0" alt="DESHABILITADO" title="DESHABILITADO"/>';
      $estadoyes = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/aprobado.gif" border="0" alt="APROBADO" title="APROBADO"/>';
      $estadono = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/no_aprobado.gif" border="0" alt="NO APROBADO" title="NO APROBADO"/>';
      $fila[6] = $fila[6]=='t'?$estadoyes:$estadono;
      $fila[7] = $fila[7]=='t'?$habilitado:$deshabilitado;
      array_push($resultadoArray,$fila);
      }
      return $resultadoArray;
      }
      public function getListaComprobanteSerie(){
      $record = $this->dCaja->getArrayListaComprobanteSerie();
      $resultadoArray = array();
      foreach ($record as $fila){
      $habilitado = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/agt_action_success.png" border="0" alt="HABILITADO" title="HABILITADO"/>';
      $deshabilitado = '<img src="'.$_SESSION['path_principal'].'../fastmedical_front/imagen/icono/agt_action_fail.png" border="0" alt="DESHABILITADO" title="DESHABILITADO"/>';
      $fila[5] = $fila[5]=='t'?$habilitado:$deshabilitado;
      array_push($resultadoArray,$fila);
      }
      return $resultadoArray;
      }

     */

    private $dCaja;

    public function __construct() {
        $this->dCaja = new DCaja();
    }

    public function obtenerListadoCajas() {
        $o_DCaja = new DCaja();
        $rs = $o_DCaja->getArrayListadoCajas();
        $resultadoArray = array();
        foreach ($rs as $indice => $fila) {
            $resultadoArray[$indice] = $fila;
        }
        return $resultadoArray;
    }

    public function obtenerResponsabledesuCaja($datos) {
        $o_DCaja = new DCaja();
        $rs = $o_DCaja->getArrayResponsabledesuCaja($datos);
        return utf8_encode($rs[0]["responsable"]);
    }

    public function obtenerParteDiarioCierreCaja($datos) {
        $o_DCaja = new DCaja();
        $rs = $o_DCaja->getArrayParteDiarioCierreCaja($datos);
        return $rs;
    }

    public function cerrarCajaCierreCaja($datos) {
        $o_DCaja = new DCaja();
        $rs = $o_DCaja->updatecerrarCajaCierreCaja($datos);
        return utf8_encode($rs[0]["respuesta"]);
    }

    public function anularCierreCaja($datos) {
        $o_DCaja = new DCaja();
        $rs = $o_DCaja->updateanularCierreCaja($datos);
        return utf8_encode($rs[0]["respuesta"]);
    }

    public function selecciontipoComprobante($datos) {
        $o_DCaja = new DCaja();
        $rs = $o_DCaja->selecciontipoComprobante($datos);
        return $rs;
    }

    public function reporteCajaPorCajero($datos) {
        $o_DCaja = new DCaja();
        $rs = $o_DCaja->reporteCajaPorCajero($datos);
        return $rs;
    }

    public function reporteCajaXpersona($datos) {
        $o_DCaja = new DCaja();
        $rs = $o_DCaja->reporteCajaXpersona($datos);
        return $rs;
    }

    public function lCargarReporteCaja($parametros) {
        $oDCaja = new Dcaja();
        $rs = $oDCaja->lCargarReporteCaja($parametros);
        foreach ($rs as $key => $value) {
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/exec.gif ^ procesar");
            array_push($rs[$key], "../../../../fastmedical_front/imagen/icono/anular.png ^ anular");
        }
        return $rs;
    }
    
    public function lExportarReporteCaja($parametros) {
        $oDCaja = new Dcaja();
        $rs = $oDCaja->dExportarReporteCaja($parametros);
       
        return $rs;
    }

}

?>