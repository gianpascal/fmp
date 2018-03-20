<?php
require_once("Html1.php");
	if($_POST){
		$parametros = $_POST;
		session_start();
	}else if($_GET){
		$parametros = $_GET;
		session_start();
	}
	switch ($parametros["accion"]){
		case "actualizar_datos_clase_tabla1":{
			$arrayFilas = Tabla1::actualizarColumnasTabla($parametros);
			var_dump($arrayFilas);
		}
		case "eliminar_fila_tabla1":{
			$respuesta = Tabla1::eliminarFilaTabla($parametros);
			//$tabla = $_SESSION[$parametros["idTabla"]];
			//var_dump($tabla);
			//$oTabla = $tabla[2];			
		}
	}
echo $respuesta;
?>