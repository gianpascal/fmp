<?php
/***********************************************************
 *** Recupera la session de la BD
 *** Recupera variables registragas en el archivo de ingreso
 *** carga los permisos del usuario.
 ***
 ************************************************************/
//session_start();
//require_once("../../../hospitalizacion/cdatos/DSesion.php");
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
      //  session_start(); //Cargando la sesión
        session_name("SIMEDH");
        $sesion=&new Sesion();
       // $sesion->setIp();//añadido
        $sesion->inicia();
        $sesion->encriptar(false,true);
        $sesion->escribir($_SESSION); //Añadido
    }
    public function setSession($sess){
         session_start(); //cargando sess
        $this->sess = $sess;
    }
    public function getPermisos(){
        session_start();
        $dSesion = new DSesion();
        $this->permisos = $dSesion->getArrayPermisoFormulario($this->sess['id_sistema'],$this->sess['id_usuario']);
        return $this->permisos;
    }
    public function setArrayDsn($dsn){
        $this->arrayDsn = $this->sess['dsn'];
    }
    public function getArrayDsn(){
        session_start(); //adicionado
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
//Conexion::$arrayDsnUserMSSQL = Conexion::getInitDsnMSSQLAuditoria();
Permisos::$arrayPermisosFormularios = $_SESSION['permiso_formulario'];
Permisos::$arrayPermisosServicios = $_SESSION['permiso_formulario_servicio'];
$usuario=strtoupper($_SESSION['login_user']);
$nuevaSesion=$_SESSION['Nuevo'];
//echo $nuevaSesion;
?>