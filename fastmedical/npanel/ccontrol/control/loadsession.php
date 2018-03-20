<?php
/***********************************************************
 *** Recupera la session de la BD
 *** Recupera variables registragas en el archivo de ingreso
 *** carga los permisos del usuario.
 ***
 ************************************************************/
require_once("../../../panel/cdatos/DSesion.php");
require_once("../../../pholivo/Session.class.php");
require_once("../../../pholivo/funciones.php");
require_once("../../../pholivo/Conexion.php");
require_once("../../../pholivo/Permisos.php");
class LoadSession{
    public $arrayDsn;
    public $permisos;
    public $sess;

    public function __construct(){

    }
    public function loadSessionVar(){
        session_name("SIMEDH");
        $sesion=&new Sesion();
        $sesion->inicia();
        $sesion->encriptar(false,true);
    }
    public function setSession($sess){
        $this->sess = $sess;
    }
    public function getPermisos(){
        $dSesion = new DSesion();
        $this->permisos = $dSesion->getArrayPermisoFormulario($this->sess['id_sistema'],$this->sess['id_usuario']);
        return $this->permisos;
    }
    public function setArrayDsn($dsn){
        $this->arrayDsn = $this->sess['dsn'];
    }
    public function getArrayDsn(){
        $dSesion = new DSesion();
        $this->arrayDsn = $dSesion->getArrayUsuarioBaseDatos($this->sess['id_sistema'], $this->sess['id_usuario']);
        return $this->arrayDsn;
    }
}
$oSession = new LoadSession();
$oSession->loadSessionVar();
$oSession->setSession($_SESSION);
//print_r($_SESSION['permiso_formulario']);
//Conexion::$arrayDsnUser = $dsn;
//Conexion::$arrayDsnUser = Conexion::getInitDsnPg();
Conexion::$arrayDsnUserMSSQL = Conexion::getInitDsnMSSQLAuditoriaWeb();
Permisos::$arrayPermisosFormularios = $_SESSION['permiso_formulario'];
Permisos::$arrayPermisosServicios = $_SESSION['permiso_formulario_servicio'];
$usuario=strtoupper($_SESSION['login_user']);
?>