<?php

require_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../../pholivo/Conexion.php");

class DTesoreria extends Adophp {

    private $cnx;
    private $oRecord;

    public function __construct($cnx = Array()) {
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx;
        parent::__construct('Spanish', $this->cnx);
    }

    public function getArrayPersonaOrden($patron, $parametro) {
        parent::ConnectionOpen("pnsOrdenPersona", "dbweb");
        parent::SetParameterSP("$1", $parametro);
        parent::SetParameterSP("$2", $patron);


        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArrayTipoDocumento() {
        parent::ConnectionOpen("pnsBuscaPersonas", "dbweb");
        parent::SetParameterSP("$1", '04');
        parent::SetParameterSP("$2", '');

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArrayDatosPersonales($codigoPersona, $aux) {
        parent::ConnectionOpen("pnsDatosPacienteCitas", "dbweb");
        parent::SetParameterSP("$1", '1');
        parent::SetParameterSP("$2", $codigoPersona);
        parent::SetParameterSP("$3", '');
        parent::SetParameterSP("vUsuario", strtoupper($_SESSION["login_user"]));
        parent::SetParameterSP("vHostname", strtoupper($_SESSION['host']));

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function getArrayOrdenes($codigoPersona) {
        parent::ConnectionOpen("pnsOrdenPersona", "dbweb");
        parent::SetParameterSP("$1", '06');
        parent::SetParameterSP("$2", $codigoPersona);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
     public function getdetalleOrden($c_nro_doc) {
        parent::ConnectionOpen("pnsOrdenPersona", "dbweb");
        parent::SetParameterSP("$1", '08');
        parent::SetParameterSP("$2", $c_nro_doc);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function dcargarTablaPacientes() {
        parent::ConnectionOpen("nsmPracticaDiego", "dbweb");
        parent::SetParameterSP("@bus", 1);
        parent::SetParameterSP("@pv1", '');
        parent::SetParameterSP("@pv2", '');
        parent::SetParameterSP("@pv3", '');
        parent::SetParameterSP("@pv4", '');
        $resultado = parent::executeSPArrayX();
        parent::Close();
        return $resultado;
    }

}

?>