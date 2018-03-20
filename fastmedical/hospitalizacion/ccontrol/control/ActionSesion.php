<?php

//require_once("../../../pholivo/Session.class.php");
//require_once("../../../hospitalizacion/cdatos/DSesion.php");
require_once("../../clogica/LSesion.php");

///////////****CLASE DE SESIONES****////////////////
class ActionSesion{
	public function __construct(){

	}
///////////****CIERRA LA SESION****////////////////
	public function cerrarSesion($parametros)
	{
		$o_LSesion = new LSesion();
                $cerrar = $o_LSesion->cerrarSesion($parametro);
        //echo "<input id='codigoOculto'  type='text' value='".$arrayFilas[0][0]."' />

	}

        public function actualizarSesion($parametros)
	{
		$o_LSesion = new LSesion();
                $cerrar = $o_LSesion->actualizarSesion($parametro);
        //echo "<input id='codigoOculto'  type='text' value='".$arrayFilas[0][0]."' />

	}


        }
?>
