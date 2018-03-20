<?php
require_once("../../cdatos/DSesion.php");

class LSesion{
	private $o_DSesion;
	function __construct(){
		$this->o_DSesion = new DSesion();
	}
	function cerrarSesion(){
        session_start();
        //echo $session_id();
        $accion1='CERRAR';
        $sesion1=session_id();
        $tiempo=1800;
        $sistema=$_SESSION['iid_Sistema'];
                 $ip = $_SERVER['REMOTE_ADDR'];
                $rs = $this->o_DSesion->getAccionSesion1($accion1, $sesion1, $tiempo, $sistema,$_SESSION['contenido'],$_SESSION['id_usuario'],$ip);
                session_unset();
	session_destroy();
	//session_write_close();
        session_name("SIMEDH");
         session_start();
         session_register('sess');
         session_unregister('sess');
         session_unset();
         session_destroy();
         session_write_close();
         print_r($rs);
         
		return $rs;
              
	}

        function actualizarSesion(){
        session_start();
        //echo $session_id();
        $accion1='ACTUALIZAR';
        $sesion1=session_id();
        $tiempo=1800;
        $sistema=$_SESSION['iid_Sistema'];
                 $ip = $_SERVER['REMOTE_ADDR'];
                $rs = $this->o_DSesion->getAccionSesion($accion1, $sesion1, $tiempo, $sistema,$_SESSION['contenido'],$_SESSION['id_usuario'],$ip);
//        if($rs['0']['0']!=1){
//        session_unset();
//	session_destroy();//me destruira cuando abandone la página
//        }
	//session_write_close();
//        session_name("SIMEDH");
//         session_start();
//         session_register('sess');
//         session_unregister('sess');
//         session_unset();
//         session_destroy();
//         session_write_close();
         print_r($rs);
		return $rs;
	}


}
?>