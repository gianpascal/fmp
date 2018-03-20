<?php

include_once("../../../pholivo/Conexion.php");
include_once("../../../pholivo/adophp/Adophp.class.php");

class DUsuario extends Adophp {

    private $dsn;

    public function __construct($dsn = '') {
        $this->dsn = empty($dsn) ? Conexion::getInitDsnMSSQLAuditoriaWeb() : $dsn;
        parent::__construct('Spanish', $this->dsn);
    }

    //Para guardar nuevo usuario
    public function spManteUsuario($accion, $idPersona, $idSistema, $idPerfil, $login, $password, $habilitado, $idUserDataBase) {////
        parent::ConnectionOpen("sp_mante_usuario", "permisos");
        parent::SetParameterSP("$1", $accion);
        parent::SetParameterSP("$2", 0); //No se necesita el iid_usuario porque es autoincremental
        parent::SetParameterSP("$3", $idPersona);
        parent::SetParameterSP("$4", $idSistema);
        parent::SetParameterSP("$5", $idPerfil);
        parent::SetParameterSP("$6", $login);
        parent::SetParameterSP("$7", $password);
        parent::SetParameterSP("$8", $habilitado);
        parent::SetParameterSP("$9", $idUserDataBase);
        parent::SetSelect("*");
        parent::SetPagination('ALL');
        return parent::executeSPArrayX();
    }

    public function listaPerfiles($codPerson) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("idPerfil", '');
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPerson);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function listaActividad() {
        parent::ConnectionOpen("sp_permiso_actividad", "permisos");
        parent::SetParameterSP("accion", '1');
        parent::SetParameterSP("idPerfil", '');
        parent::SetParameterSP("idSistema", '');
        parent::SetParameterSP("codPersona", '');
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function DlistaExisteActividad($codPersona) {
        parent::ConnectionOpen("sp_permiso_actividad", "permisos");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("cCodigoActividad", '');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("vUsuario", $_SESSION["login_user"]);
        parent::SetParameterSP("vHost",  $_SESSION['host']);
        parent::SetParameterSP("dFecha", $_SESSION['getdate']);
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;           
    }
    
    public function getUsuario($codPersona) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '4');
        parent::SetParameterSP("idPerfil", '');
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function verificaPuesto($codPersona) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '7');
        parent::SetParameterSP("idPerfil", '');
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function guardarUsuario($usuario, $codPersona, $idPerfil) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '6');
        parent::SetParameterSP("idPerfil", $idPerfil);
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", $usuario);
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function guardarPermisosFormulario($codPersona, $idPerfil) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("idPerfil", $idPerfil);
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function guardarPermisosServicio($codPersona, $idPerfil) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '3');
        parent::SetParameterSP("idPerfil", $idPerfil);
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function listaPerfilesXUsuario($codPersona) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '8');
        parent::SetParameterSP("idPerfil", '');
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function listaFormulariosXPerfilXUsuario($codPersona, $idPerfil) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '9');
        parent::SetParameterSP("idPerfil", $idPerfil);
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function listaServiciosXFormulariosXPerfilXUsuario($codPersona, $idFormulario) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '10');
        parent::SetParameterSP("idPerfil", $idFormulario);
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function modificarUsuario($codPersona, $idPerfil) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '11');
        parent::SetParameterSP("idPerfil", $idPerfil);
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function modificarActividad($codPersona, $codActividad) {
        parent::ConnectionOpen("sp_permiso_actividad", "permisos");
        parent::SetParameterSP("accion", '2');
        parent::SetParameterSP("cCodigoActividad", $codActividad);
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("vUsuario", $_SESSION["login_user"]);
        parent::SetParameterSP("vHost",  $_SESSION['host']);
        parent::SetParameterSP("dFecha", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;           
    }

    public function modificarPermisosFormulario($codPersona, $idPerfil) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '12');
        parent::SetParameterSP("idPerfil", $idPerfil);
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

    public function modificarPermisosServicio($codPersona, $idPerfil) {
        parent::ConnectionOpen("sp_permiso_usuario", "permisos");
        parent::SetParameterSP("accion", '13');
        parent::SetParameterSP("idPerfil", $idPerfil);
        parent::SetParameterSP("idSistema", '2');
        parent::SetParameterSP("codPersona", $codPersona);
        parent::SetParameterSP("codEmpleado", '');
        parent::SetParameterSP("loginBase", '');
        $resultadoArray = parent::executeSPArrayX();
        parent::Close();
        return $resultadoArray;
    }

}

?>
