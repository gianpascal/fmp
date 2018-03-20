<?php
require_once("../../../pholivo/Conexion.php");
require_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../cdatos/DSesion.php");
require_once("../../../pholivo/Session.class.php");
require_once("../../../pholivo/funciones.php");
require_once ("../../cdatos/DLogin.php");
/*
$login_user=RecibirParametros("l");
$id_user=RecibirParametros("u");
$pass_user=RecibirParametros("c");
$id_sistema=RecibirParametros("s");
*/
$login=RecibirParametros("login");
session_start();
$logueo = $_SESSION["logueo"];
$login_user=$logueo["l"];
$id_user=$logueo["u"];
$pass_user=$logueo["c"];
$id_sistema=$logueo["s"];
//$logueo["ip"] =getIp();
//$ip=$logueo["ip"];
/*echo session_id();
var_dump($logueo);
var_dump($_SESSION);
die("---------");
 *
 */
if(!empty($login) && $login == "1" && !empty($logueo)){

        $oDsn = new Conexion();
        $dsnPg = $oDsn->getInitDsnPg();

        //We have to sure to init a new session
        ///////////////////////////////////////
        session_name("SIMEDH");
        session_start();
        session_regenerate_id();
        session_write_close();
        ///////////////////////////////////////
 session_start();
        $sesion = &new Sesion();
        $sesion->setLogin($login_user);
        $sesion->setIdUsuario($id_user);
        $sesion->setSistema($id_sistema);        
        //$sesion->getIp();
       // $sesion->setIp();//añadido
        //$_SESSION['ip']= $sesion->getIp();
        $sesion->inicia();
        $sesion->encriptar(false,true);
        // echo session_id();

        session_name("SIMEDH");
        session_start();

        $sess['ip'] = $sesion->getIp();
        $sess["namepc"] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $sess['login_user'] = $login_user;
        $sess['id_sistema'] = $id_sistema;
        $sess['id_usuario'] = $id_user;

        //var_dump();

        $dSesion = new DSesion();
        $result = $dSesion->getArrayUsuarioBaseDatos($id_sistema,$id_user);
        $permisos = $dSesion->getArrayPermisoFormulario($id_sistema, $id_user);
        $permisos_servicios = $dSesion->getArrayPermisoServicio($id_sistema, $id_user);

        $dsn['dbuser'] = $result['vusuario_bd'];
        $dsn['dbpasw'] = $result['vclave_bd'];
        $dsn['dbname'] = $result['vdbname'];
        $dsn['dbhost'] = $result['vdbhost'];
        $dsn['dbdriv'] = $result['vdbtipo'];
        //$dsnMSSQL = Conexion::getMSSQLConexionX();
        //var_dump($dsnMSSQL);
        //$cnx = mssql_connect($dsnMSSQL["dbhost"],$dsnMSSQL["dbuser"],$dsnMSSQL["dbpasw"]);
        //echo $cnx;
        //die("----------");
        $sess["nombre_institucion"] = $result['institucion'];
        $sess["ruc_institucion"] =$result['ruc'];
        $sess["direccion_institucion"] = $result['direccion'];
        $sess["telefono_institucion"] = $result['telefono'];
        $sess['vnombre'] = $result['vnombre'];
        $sess['id_persona'] = $result['iid_persona'];
        $sess['cod_user'] = $result['iid_persona'];
        $sess['vcarpeta'] = $result['vcarpeta'];
        $sess["ano_eje"] = date("Y");
        $sess['path_principal']='../../../';
        $_SESSION['path_principal']='../../../';

  
        session_register('sess');
        session_register('dsn');
        session_register('permisos');
        session_register('permisos_servicios');
        session_write_close();
        header("Location: ".$sess['vcarpeta']);
        exit;
}else{
    session_start();
    $sesion = &new Sesion();
      //  $sesion->setIp(); //añadido
	$sesion->inicia();
	$dLogin = new DLogin();
	$permisos = $dLogin->getArrayPermisoFormulario($_SESSION['id_sistema'],$_SESSION['id_usuario']);

	$permisos_servicios = $dLogin->getArrayPermisoServicio($sess['id_sistema'],$sess['id_usuario']);

	$arreglo=parse_url($HTTP_REFERER);
}
?>
