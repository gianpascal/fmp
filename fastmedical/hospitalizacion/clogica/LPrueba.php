<?php
include_once("../../cdatos/DPrueba.php");
class Lprueba{
	private $Dprueba;
	public function __construct(){
		$this->Dprueba = new dprueba();
	}
	public function getPruebaBus($var1,$var2){
			$resultado = $this->Dprueba->getPruebadni($var1,$var2);			
			return $resultado;
	}
}
?>