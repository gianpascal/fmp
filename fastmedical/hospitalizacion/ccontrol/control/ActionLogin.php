<?php
require_once("../../../pholivo/Html.php");
require_once("../../clogica/LLogin.php");
include_once("../../cdatos/DLogin.php");
///////////****PERMISO DE USUARIO****////////////////
class ActionLogin{
	public function __construct(){
		
	}
///////////****VALIDA LOS DATOS DEL FORMULARIO ****////////////////
///////////****SE PASAN COMO PARAMETROS EL USUARIO Y CONTRASEÑA ****////////////////
	public function validaUsuario1($parametros)
	{
		$oLLogin = new LLogin();
		$respuesta = $oLLogin->getArrayUsuario1($parametros);
		echo "<br>Paso 1";
                if($respuesta=='ok'){
                    $this->getUsuarioOficina();
                    echo "<br>Paso 2";
                    $this->getDatosInstitucion();
                    echo "<br>Paso 3";
                    $this->getUsuarioPermiso();
                    echo "<br>Paso 4";
                    $isLogin=1;
                    echo "<br>Paso 5";
                    $accion='INSERTAR';
                    
                   // $sesion=session_id();
                    $sesion=time().$_SESSION["login_user"];
                    $tiempo='1800';
                    $sistema=$_SESSION['iid_sistema'];
                    $contenido='mi contenido';
                    $idusuario=$_SESSION['id_usuario'];
                    $tcaduca='';
                    $ip=$_SESSION['host'];
                    $rs=$oLLogin->verificaSesion($accion,$sesion, $tiempo, $sistema,$contenido,$idusuario,$tcaduca,$ip,'');
                    //print_r($rs);
                    echo "<br>Paso 6";
                    $_SESSION['id']=$rs[0]['respuesta'];
// print_r($_SESSION);
                    //header("location: ../../cvista/inicio/inicio.php");
                }

		return $respuesta;
                    //header("location:../../index.php");
		
                

	}	
///////////****OBTIENE USUARIO****////////////////
	public function getUsuarioOficina()
	{
		/*$oLLogin = new LLogin();
		$respuesta = $oLLogin->getUsuarioOficina('%',$_SESSION['id_persona']);
                return false;*/
                $oLLogin = new LLogin();
                $empresa = '0001';//Es el id para el HMLO
		$respuesta = $oLLogin->getUsuarioOficina($_SESSION["id_persona"],$empresa);
		return $respuesta;
	}	
///////////****CAPTURA INSTITUCION DE USUARIO****////////////////
	public function getDatosInstitucion()
	{
		/*$oLLogin = new LLogin();
		$respuesta = $oLLogin->getDatosInstitucion('%',$_SESSION['id_persona']);				
		return false;*/
                $oLLogin = new LLogin();
                $empresa = '0001';//Es el id para el HMLO
		$respuesta = $oLLogin->getDatosInstitucion($_SESSION["id_persona"],$empresa);
		return false;
	}	
///////////****CAPTURA PERMISOS PARA FORMULARIO Y SERVICIOS****////////////////
	public function getUsuarioPermiso()
	{
		$oLLogin = new LLogin();
		///$valor=$oLLogin->getUsuarioPermisoFormulario('2',$_SESSION['id_usuario']);
                $valor=$oLLogin->getUsuarioPermisoFormulario('2',$_SESSION['id_persona']);
                if($valor==1){
                    //$respuesta = $oLLogin->getUsuarioPermisoServicio($_SESSION['id_usuario'],'2');
                    $respuesta = $oLLogin->getUsuarioPermisoServicio($_SESSION['id_persona'],'2');
                }
                return false;
	}	
	
	public function getCargaMenu()
	{
            session_start();
		$oLLogin = new LLogin();
		return $oLLogin->getCargaMenu('2','0',$_SESSION['id_usuario']);
	}
	
	public function getCargaMenuConsulta($idformulario)
	{
		$oLLogin = new LLogin();
		return $oLLogin->getCargaMenuConsulta($idformulario);
	}
        public function verificarSesion($accion,$sesion, $tiempo, $sistema,$contenido,$idusuario,$tcaduca,$ip,$id){
            $oLLogin = new LLogin();
            $rs=$oLLogin->verificaSesion($accion,$sesion,$tiempo, $sistema,$contenido,$idusuario,$tcaduca,$ip,$id);
            return $rs;
        }
        public function cerrarSesion(){
            $oLLogin = new LLogin();
                    if(isset ($_SESSION)){
                    $accion='CERRAR';
                    $sesion=session_id();
                    $tiempo='1800';
                    $sistema=$_SESSION['iid_sistema'];
                    $contenido='mi contenido';
                    $idusuario=$_SESSION['id_usuario'];
                    $tcaduca='';
                    $ip=$_SESSION['host'];
                    $id=$_SESSION['id'];
                    session_unset();
                    session_destroy();
                    }else{
                    $accion='CERRAR';
                    $sesion=session_id();
                    $tiempo='1800';
                    $sistema='2';
                    $contenido='';
                    $idusuario='';
                    $tcaduca='';
                    $ip='';
                    $id='';
                    }
                    $rs=$oLLogin->verificaSesion($accion,$sesion, $tiempo, $sistema,$contenido,$idusuario,$tcaduca,$ip,$id);
        }
}
?>
