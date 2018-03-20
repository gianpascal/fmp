<?php
Class MessageList{
public $ErrorMessages= Array();
	public function __construct(){
		$this->Fill();
	}
	public function Fill(){
		$this->ErrorMessages['adophp'][0]="No Puede Conectarse a la Base de Datos!";
		$this->ErrorMessages['adophp'][1]="No Puede Seleccionar la Base de Datos!";
		$this->ErrorMessages['adophp'][2]="No se puede Ejecutar la Consulta";
		$this->ErrorMessages['adophp'][3]="No se puede Ejecutar el Procedimiento Almacenado";
	}
}
?>