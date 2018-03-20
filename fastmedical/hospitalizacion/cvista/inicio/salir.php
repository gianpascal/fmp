<?php
//SALIMOS Y CERRAMOS SESSION
//require_once("ingreso.php");
//require_once("Connections/coneccion.php");
//require_once("funciones/funciones_pg.php");
//require_once("funciones/class_sesion.php");
//$sesion->encriptar(true,false);
require_once("../../../pholivo/Session.class.php");
require_once("../../../pholivo/Conexion.php");
require_once("../../../pholivo/adophp/Adophp.class.php");
require_once("../../../hospitalizacion/cdatos/DSesion.php");

        session_start();



        session_start();
    	session_unset();
	session_destroy();
	//session_write_close();
        session_name("SIMEDH");
         session_start();
         //session_register('sess');
//         session_unregister('sess');
         session_unset();
         session_destroy();
         session_write_close();

	 header("Location: ../../../index.php?razon=1");
        
?>