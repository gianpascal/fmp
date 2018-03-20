<?php

require_once("../../../pholivo/Conexion.php");
//require_once("../../../pholivo/AbstraccionDato.php");
include_once("../../../pholivo/adophp/Adophp.class.php");

class DCaja extends Adophp {

    private $cnx;

    function __construct($cnx = '') {
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx;
        parent::__construct('Spanish', $this->cnx);
    }

    /* 	public function getArrayListaCajaGeneral($sector,$habilitado1,$habilitado2){
      //		parent::setMNombre_SP("sel_caja2");
      //		parent::pg_Parametros_SP("$1",$sector);
      //		parent::pg_Parametros_SP("$2",$habilitado1);
      //		parent::pg_Parametros_SP("$3",$habilitado2);
      //		parent::pg_Campos_Select("*");
      //		parent::pg_Poner_Esquema(" hospitalizacion ");
      //		parent::pg_Paginacion('ALL');
      //		return parent::executeSPArray();

      parent::ConnectionOpen("sel_caja2","hospitalizacion");
      parent::SetParameterSP("$1",$sector);
      parent::SetParameterSP("$2",$habilitado1);
      parent::SetParameterSP("$3",$habilitado2);
      parent::SetSelect("*");
      return parent::ExecuteSPArray();
      }
      public function getArrayListaCajaResumen(){
      //		parent::setMNombre_SP("sp_lista_sector");
      //		parent::pg_Parametros_SP("$1",'%');
      //		parent::pg_Parametros_SP("$2",'%');
      //		parent::pg_Campos_Select("*");
      //		parent::pg_Poner_Esquema("nucleo");
      //		parent::pg_Paginacion("ALL");
      //		return parent::executeSPArray();

      parent::ConnectionOpen("sp_lista_sector","nucleo");
      parent::SetParameterSP("$1",'%');
      parent::SetParameterSP("$2",'%');
      parent::SetSelect("*");
      return parent::ExecuteSPArray();

      }
      public function getArraySector($sector){
      //		parent::setMNombre_SP("sp_lista_sector");
      //		parent::pg_Parametros_SP("$1",$sector);
      //		parent::pg_Parametros_SP("$2",'%');
      //		parent::pg_Campos_Select("*");
      //		parent::pg_Poner_Esquema(" nucleo ");
      //		parent::pg_Paginacion("ALL");
      //                $resultado=parent::executeSPArray();
      //		return $resultado;

      parent::ConnectionOpen("sp_lista_sector","nucleo");
      parent::SetParameterSP("$1",$sector);
      parent::SetParameterSP("$2",'%');
      parent::SetSelect("*");
      return parent::ExecuteSPArray();
      }
      public function getArrayListaDetalleTrabajador($caja){
      //		parent::setMNombre_SP("sel_caja_trabajador");
      //		parent::pg_Parametros_SP("$1",$caja);
      //		parent::pg_Parametros_SP("$2",'t');
      //		parent::pg_Parametros_SP("$3",'f');
      //		parent::pg_Campos_Select("*");
      //		parent::pg_Poner_Esquema(" hospitalizacion ");
      //		parent::pg_Paginacion("ALL");
      //		return parent::executeSPArray();
      parent::ConnectionOpen("sel_caja_trabajador","hospitalizacion");
      parent::SetParameterSP("$1",$caja);
      parent::SetParameterSP("$2",'t');
      parent::SetParameterSP("$3",'f');
      parent::SetSelect("*");
      return parent::ExecuteSPArray();
      }
      public function getArrayListaTrabajadorComprobante($persona,$caja){
      parent::setMNombre_SP("sel_trabajador_comprobante");
      parent::pg_Parametros_SP("$1",$persona);
      parent::pg_Parametros_SP("$2",$caja);
      parent::pg_Campos_Select("*");
      parent::pg_Poner_Esquema(" hospitalizacion ");
      parent::pg_Paginacion("ALL");
      parent::executeSP();
      parent::pg_Total_Rows();
      parent::executeSPArray();
      $this->record = parent::pg_Get_Row();
      return parent::executeSPArray();
      }
      public function getRow(){
      return $this->record;
      }
      public function getArrayListaCajaComprobante($caja){
      parent::setMNombre_SP("sel_caja_comprobante");
      parent::pg_Parametros_SP("$1",$caja);
      parent::pg_Campos_Select("*");
      parent::pg_Poner_Esquema(" hospitalizacion ");
      parent::pg_Paginacion("ALL");
      return parent::executeSPArray();
      }
      public function getArrayListaComprobanteSerie(){
      parent::setMNombre_SP("sel_comprobante_serie");
      parent::pg_Parametros_SP("$1",'%');
      parent::pg_Parametros_SP("$2",'t');
      parent::pg_Parametros_SP("$3",'f');
      parent::pg_Campos_Select("*");
      parent::pg_Poner_Esquema(" hospitalizacion ");
      parent::pg_Paginacion("ALL");
      return parent::executeSPArray();
      }
     */

    function getArrayListadoCajas() {
        parent::ConnectionOpen("pnsMantenimientoCierreCaja", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("numerocaja", "");
        parent::SetParameterSP("fechadeproceso", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getArrayResponsabledesuCaja($datos) {
        parent::ConnectionOpen("pnsMantenimientoCierreCaja", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("numerocaja", $datos["numerocaja"]);
        parent::SetParameterSP("fechadeproceso", "");
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function getArrayParteDiarioCierreCaja($datos) {
        parent::ConnectionOpen("pnsTesoreriaSerieCaja", "dbweb");
        parent::SetParameterSP("numerocaja", $datos["numerocaja"]);
        parent::SetParameterSP("fechadeproceso", $datos["fechadeproceso"]);
        parent::SetParameterSP("accion", '03');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    function updatecerrarCajaCierreCaja($datos) {
        parent::ConnectionOpen("pnsMantenimientoCierreCaja", "dbweb");
        parent::SetParameterSP("accion", "3");
        parent::SetParameterSP("numerocaja", $datos["numerocaja"]);
        parent::SetParameterSP("fechadeproceso", $datos["fechadeproceso"]);
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function updateanularCierreCaja($datos) {
        parent::ConnectionOpen("pnsMantenimientoCierreCaja", "dbweb");
        parent::SetParameterSP("accion", "4");
        parent::SetParameterSP("numerocaja", $datos["numerocaja"]);
        parent::SetParameterSP("fechadeproceso", $datos["fechadeproceso"]);
        parent::SetParameterSP("vNombreUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vNombreEstacion", strtoupper($_SESSION['host']));
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function selecciontipoComprobante($datos) {
        parent::ConnectionOpen("pnsMantenimientoCierreCaja", "dbweb");
        parent::SetParameterSP("accion", "5");
        parent::SetParameterSP("numerocaja", $datos["codCaja"]);
        parent::SetParameterSP("fechadeproceso", $datos["fechaHoy"]);
        parent::SetParameterSP("vNombreUsuario", '');
        parent::SetParameterSP("vNombreEstacion", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function reporteCajaPorCajero($datos) {
        parent::ConnectionOpen("pnsReporteCaja", "dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("numerocaja", $datos["codCaja"]);
        parent::SetParameterSP("txtFechaIni", $datos["txtFechaIni"]);
        parent::SetParameterSP("txtFechaFinal", $datos["txtFechaFinal"]);
        parent::SetParameterSP("vNombreUsuario", '');
        parent::SetParameterSP("vNombreEstacion", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }

    public function reporteCajaXpersona($datos) {
        parent::ConnectionOpen("pnsReporteCaja", "dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("numerocaja", $datos["codCaja"]);
        parent::SetParameterSP("txtFechaIni", $datos["txtFechaIni"]);
        parent::SetParameterSP("txtFechaFinal", $datos["txtFechaFinal"]);
        parent::SetParameterSP("vNombreUsuario", '');
        parent::SetParameterSP("vNombreEstacion", '');
        $resultado = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }
    
    public function lCargarReporteCaja($parametros) {
        parent::ConnectionOpen("pnsReporteCaja", "dbweb");
        parent::SetParameterSP("@accion", 1);
        parent::SetParameterSP("@varVarchar1", $parametros["p2"]);
        parent::SetParameterSP("@varVarchar2", $parametros["p3"]);
   
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }
     public function dExportarReporteCaja($parametros) {
        parent::ConnectionOpen("pnsReporteCaja", "dbweb");
        parent::SetParameterSP("@accion", 2);
        parent::SetParameterSP("@varVarchar1", $parametros["p2"]);
        parent::SetParameterSP("@varVarchar2", $parametros["p3"]);
   
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }
    


}

?>