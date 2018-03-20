<?php
require_once("../../../pholivo/Html.php");
require_once("../../clogica/LPrueba.php");

class ActionPrueba{
	public function listaprueba($opcBusqueda,$patronBus){
		$o_LPrueba = new LPrueba();
		$arrayFilas = $o_LPrueba->getPruebaBus($opcBusqueda,$patronBus);
		$arrayFilas1 = $arrayFilas;
		$arraycabecera = array("2"=>"Ap. Paterno","3"=>"Ap. Materno","1"=>"Nombres","6"=>"T. Doc","5"=>"N Doc");
		$o_Html = new Tabla($arraycabecera,$arrayFilas1,'fila1','fila2','filaEncima','filaCabecera','0','MensajePrueba');
		return $o_Html->getTabla();
	}
}
?>