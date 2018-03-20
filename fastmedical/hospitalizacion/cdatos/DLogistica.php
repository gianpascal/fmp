<?php

include_once("../../../pholivo/Conexion.php");
include_once("../../../pholivo/adophp/Adophp.class.php");

class DLogistica extends Adophp {

    private $cnx;

    public function __construct($cnx = '') {
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx; // Para SQL dsn Windows
        parent::__construct('Spanish', $this->cnx);
    }

    public function getArrayCategorias() {
        parent::ConnectionOpen("pnsCategoriaProductos", "dbweb");
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function getArrayAfiliaciones() { //ya no se utiliza
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("c_tipoe", '04');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function getArrayProductos($prod) {
        parent::ConnectionOpen("pnsConsultaTarifa", "dbweb");
        parent::SetParameterSP("bus", "6");
        parent::SetParameterSP("pv1", $prod);
        parent::SetParameterSP("pv2", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function CargarPaquetes($datos) {
        parent::ConnectionOpen("pnsConsultaTarifa", "dbweb");
        parent::SetParameterSP("bus", "8");
        parent::SetParameterSP("pv1", $datos['paquete']);
        parent::SetParameterSP("pv2", $datos['afiliacion']);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function cargarPreciosServiciosyProductos($cod) {
        parent::ConnectionOpen("pnsConsultaTarifa", "dbweb");
        parent::SetParameterSP("bus", "7");
        parent::SetParameterSP("pv1", $cod);
        parent::SetParameterSP("pv2", '');
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function dServiciosProgramables() {
        parent::ConnectionOpen("pnsConsultaTarifa", "dbweb");
        parent::SetParameterSP("bus", "6");
        parent::SetParameterSP("pv1", '');
        parent::SetParameterSP("pv2", $_SESSION['host']);

        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function getArrayStock($prod) {
        parent::ConnectionOpen("pnsConsultaTarifa", "dbweb");
        parent::SetParameterSP("bus", "2");
        parent::SetParameterSP("pv1", $prod);
        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function getArrayPrecios($codProd) {
        parent::ConnectionOpen("pnsProductos", "dbweb");
        parent::SetParameterSP("bus", "11");
        parent::SetParameterSP("pv1", $codProd);

        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function getdetalleProducto($codProd) {
        parent::ConnectionOpen("pnsProductos", "dbweb");
        parent::SetParameterSP("bus", "12");
        parent::SetParameterSP("pv1", $codProd);

        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function getInfoProductos($codProd) {
        parent::ConnectionOpen("pnsProductos", "dbweb");
        parent::SetParameterSP("bus", "5");
        parent::SetParameterSP("pv1", $codProd);

        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function getOrdenes($c_cod_per) {
        parent::ConnectionOpen("paxselectctacte", "dbweb");
        parent::SetParameterSP("codigo", $c_cod_per);
        parent::SetParameterSP("mode", "");

        parent::SetSelect("*");
        $resultadoArray = parent::executeSPArrayX();
        return $resultadoArray;
    }

    public function precioServicios($idCentroCostos, $idAfiliaciones) {
        parent::ConnectionOpen("pnsPrecios", "dbweb");
        parent::SetParameterSP("$1", '01');
        parent::SetParameterSP("$2", $idCentroCostos);
        parent::SetParameterSP("$3", $idAfiliaciones);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getCentroCostos($idCentroCostos) {
        parent::ConnectionOpen("pnsCentroCostos", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $idCentroCostos);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function resultadoPrecioProcedimientos($idFiliacion, $cCostos, $procedimiento, $c_cod_ser_pro) {
        parent::ConnectionOpen("pnsPrecios", "dbweb");
        parent::SetParameterSP("$1", '02');
        parent::SetParameterSP("$2", $idFiliacion);
        parent::SetParameterSP("$3", $cCostos);
        parent::SetParameterSP("$4", $procedimiento);
        parent::SetParameterSP("$5", $c_cod_ser_pro);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function centroCostoXServicio($c_cod_ser_pro) {
        parent::ConnectionOpen("pnsCentroCostos", "dbweb");
        parent::SetParameterSP("$1", '07');
        parent::SetParameterSP("$2", $c_cod_ser_pro);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    function comboCategorias() {
        parent::ConnectionOpen("pnsConsultaTarifa", "dbweb");
        parent::SetParameterSP("bus", '3');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    function comboAfiliaciones() {
        parent::ConnectionOpen("pnsConsultaTarifa", "dbweb");
        parent::SetParameterSP("bus", '4');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

    public function getTarifasProcedimientosProductos($datos) {
        parent::ConnectionOpen("pnsPrecios", "dbweb");
        parent::SetParameterSP("$1", '03');
        parent::SetParameterSP("$2", $datos['afiliacionActiva']);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("$4", '');
        parent::SetParameterSP("$5", $datos['nombreProcedimiento']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

}

?>
