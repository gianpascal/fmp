<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
include_once("../../../pholivo/adophp/Adophp.class.php");
include_once("../../../pholivo/Conexion.php");

class DLlamadaPaciente extends Adophp {


    public function __construct($cnx = Array(),$_eCita='') {
        $this->cnx = empty($cnx)?Conexion::getInitDsnMSSQLSimedh():$cnx;
        parent::__construct('Spanish',$this->cnx);

    }
    public function verColas($iPantalla) {
        parent::ConnectionOpen("pnsLlamadaPaciente","dbweb");
        parent::SetParameterSP("$1","1");
        parent::SetParameterSP("$2",$iPantalla);
        parent::SetParameterSP("$3",strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("$4",strtoupper($_SESSION['host']));
        $resultado=parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultado;
    }
        public function getArrayCabeceraMantPantallas(){
        parent::ConnectionOpen("pnsMantenimientoPantallas","dbweb");
        parent::SetParameterSP("accion", "1");
        parent::SetParameterSP("codigoPantalla", "");
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }
    function getArrayAmbientesFisicosxPantalla($datos) {
        parent::ConnectionOpen("pnsMantenimientoPantallas","dbweb");
        parent::SetParameterSP("accion", "2");
        parent::SetParameterSP("codigopantalla",$datos["codigopantalla"]);
        $resultadoArray = parent::executeSPArrayX();
        parent::ConnectionClose();
        return $resultadoArray;
    }


}
?>
