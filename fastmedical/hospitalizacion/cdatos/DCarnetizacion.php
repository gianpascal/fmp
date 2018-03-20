<?php

include_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../../pholivo/Conexion.php");

class DCarnetizacion extends Adophp {

    private $cnx;
    private $oRecord;

    public function __construct($cnx = Array()) {
        $this->cnx = empty($cnx) ? Conexion::getInitDsnMSSQLSimedh() : $cnx;
        parent::__construct('Spanish', $this->cnx);
    }

    //Lobo
    public function DbuscarPersonaCarnetizacion($datos) {
        parent::ConnectionOpen("pnsBuscarPersonaCarnetizacion", "dbweb");
        parent::SetParameterSP("@accion", '1');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varVarchar1", $datos["codigoPersona"]);
        parent::SetParameterSP("@varVarchar2", $datos["apellidoPaterno"]);
        parent::SetParameterSP("@varVarchar3", $datos["apellidoMaterno"]);
        parent::SetParameterSP("@varVarchar4", $datos["nombre"]);
        parent::SetParameterSP("@varVarchar5", $datos["fechaVenc"]);

        parent::SetParameterSP("@varVarchar6", $datos["fechaini"]);
        parent::SetParameterSP("@varVarchar7", $datos["numrDocumento"]);
        parent::SetParameterSP("@varVarchar8", $datos["tipoCertificado"]);
        parent::SetParameterSP("@varDatetime", $datos["fecha"]);
        parent::SetParameterSP("@varVarchar9", $datos["codigoManipulador"]);
        parent::SetParameterSP("@varVarchar10", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar11", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function comboTipoDocumento() {
        parent::ConnectionOpen("pnsAdmision", "dbweb");
        parent::SetParameterSP("$1", '29');
        parent::SetParameterSP("$2", '');
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lobo
    public function comboTipoCertifica() {
        parent::ConnectionOpen("pnsBuscarPersonaCarnetizacion", "dbweb");
        parent::SetParameterSP("@accion", '2');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');
        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        parent::SetParameterSP("@varVarchar8", '');
        parent::SetParameterSP("@varDatetime", '');
        parent::SetParameterSP("@varVarchar9", '');
        parent::SetParameterSP("@varVarchar10", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar11", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lobo
    public function DbuscarPorBotonPersonaCarnetizacion($datos) {
        parent::ConnectionOpen("pnsBuscarPersonaCarnetizacion", "dbweb");
        parent::SetParameterSP("@accion", '3');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varVarchar1", $datos["codigoPersona"]);
        parent::SetParameterSP("@varVarchar2", $datos["apellidoPaterno"]);
        parent::SetParameterSP("@varVarchar3", $datos["apellidoMaterno"]);
        parent::SetParameterSP("@varVarchar4", $datos["nombre"]);
        parent::SetParameterSP("@varVarchar5", '');

        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", $datos["numrDocumento"]);
        parent::SetParameterSP("@varVarchar8", $datos["tipoCertificado"]);
        parent::SetParameterSP("@varDatetime", $datos["fecha"]);
        parent::SetParameterSP("@varVarchar9", '');
        parent::SetParameterSP("@varVarchar10", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar11", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lobo
    public function DbuscarCboCantidadCertificadoPorTipo($datos) {
        parent::ConnectionOpen("pnsBuscarPersonaCarnetizacion", "dbweb");
        parent::SetParameterSP("@accion", '4');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');

        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        parent::SetParameterSP("@varVarchar8", $datos["idTipoCertifiado"]);
        parent::SetParameterSP("@varDatetime", $datos["fechaCalendario"]);
        parent::SetParameterSP("@varVarchar9", $datos["idSubTipoCertifiado"]);
        parent::SetParameterSP("@varVarchar10", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar11", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lobo
    public function DcargarComboTipoCertificado() {
        parent::ConnectionOpen("pnsBuscarPersonaCarnetizacion", "dbweb");
        parent::SetParameterSP("@accion", '5');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');

        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        parent::SetParameterSP("@varVarchar8", '');
        parent::SetParameterSP("@varDatetime", '');
        parent::SetParameterSP("@varVarchar9", '');
        parent::SetParameterSP("@varVarchar10", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar11", $_SESSION['host']);
        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    //Lobo
    public function DactualizarTipoCertificado($datos) {
        parent::ConnectionOpen("pnsBuscarPersonaCarnetizacion", "dbweb");
        parent::SetParameterSP("@accion", '6');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varVarchar1", $datos["idCertificado"]);
        parent::SetParameterSP("@varVarchar2", $datos["idTipoCertifiado"]);
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');

        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        parent::SetParameterSP("@varVarchar8", '');
        parent::SetParameterSP("@varDatetime", '');
        parent::SetParameterSP("@varVarchar9", '');
        parent::SetParameterSP("@varVarchar10", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar11", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DconfirmarImpresion($datos) {
        parent::ConnectionOpen("pnsBuscarPersonaCarnetizacion", "dbweb");
        parent::SetParameterSP("@accion", '7');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varVarchar1", $datos["idCertificado"]);
        parent::SetParameterSP("@varVarchar2", $datos["estado"]);
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');

        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        parent::SetParameterSP("@varVarchar8", '');
        parent::SetParameterSP("@varDatetime", '');
        parent::SetParameterSP("@varVarchar9", '');
        parent::SetParameterSP("@varVarchar10", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar11", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DconfirmarEntregado($datos) {
        parent::ConnectionOpen("pnsBuscarPersonaCarnetizacion", "dbweb");
        parent::SetParameterSP("@accion", '8');
        parent::SetParameterSP("@varInt1", $datos["idSubTipoCertificado"] );
        parent::SetParameterSP("@varVarchar1", $datos["idCertificado"]);
        parent::SetParameterSP("@varVarchar2", $datos["estado"]);
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');

        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        parent::SetParameterSP("@varVarchar8", '');
        parent::SetParameterSP("@varDatetime", '');
        parent::SetParameterSP("@varVarchar9", '');
        parent::SetParameterSP("@varVarchar10", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar11", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }

    public function DactualizarCertificado($datos) {
        parent::ConnectionOpen("pnsBuscarPersonaCarnetizacion", "dbweb");
        parent::SetParameterSP("@accion", '9');
        parent::SetParameterSP("@varInt1", $datos["idSubTipoCertificado"] );
        parent::SetParameterSP("@varVarchar1", $datos["idCertificado"]);
        parent::SetParameterSP("@varVarchar2", $datos["fechaCaducidad"]);
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');

        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        parent::SetParameterSP("@varVarchar8", '');
        parent::SetParameterSP("@varDatetime", '');
        parent::SetParameterSP("@varVarchar9", '');
        parent::SetParameterSP("@varVarchar10", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar11", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
    
      public function DcargarComboProcedencia() {
        parent::ConnectionOpen("pnsBuscarPersonaCarnetizacion", "dbweb");
        parent::SetParameterSP("@accion", '10');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varVarchar1", '');
        parent::SetParameterSP("@varVarchar2", '');
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');

        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        parent::SetParameterSP("@varVarchar8", '');
        parent::SetParameterSP("@varDatetime", '');
        parent::SetParameterSP("@varVarchar9", '');
        parent::SetParameterSP("@varVarchar10", '');
        parent::SetParameterSP("@varVarchar11", '');

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
    
      public function DactualizarProcedencia($datos) {
        parent::ConnectionOpen("pnsBuscarPersonaCarnetizacion", "dbweb");
        parent::SetParameterSP("@accion", '11');
        parent::SetParameterSP("@varInt1", '');
        parent::SetParameterSP("@varVarchar1", $datos["idCertificado"]);
        parent::SetParameterSP("@varVarchar2", $datos["idProcedencia"]);
        parent::SetParameterSP("@varVarchar3", '');
        parent::SetParameterSP("@varVarchar4", '');
        parent::SetParameterSP("@varVarchar5", '');

        parent::SetParameterSP("@varVarchar6", '');
        parent::SetParameterSP("@varVarchar7", '');
        parent::SetParameterSP("@varVarchar8", '');
        parent::SetParameterSP("@varDatetime", '');
        parent::SetParameterSP("@varVarchar9", '');
        parent::SetParameterSP("@varVarchar10", $_SESSION["login_user"]);
        parent::SetParameterSP("@varVarchar11", $_SESSION['host']);

        $resultado = parent::executeSPArrayX();
        return $resultado;
    }
    

}

?>
