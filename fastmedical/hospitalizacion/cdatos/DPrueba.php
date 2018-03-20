<?php
include_once("../../../pholivo/Conexion.php");
include_once("../../../pholivo/AbstraccionDato.php");
class DPrueba extends TSPResult{
	private $cnx;
	private $oRecord;
	public function __construct($cnx=''){
		$this->cnx = empty($cnx)?Conexion::getPgConexion():$cnx;	
		parent::__construct($this->cnx);
			
	}

	public function getPruebadni($tdoc,$dni){				
		parent::setMNombre_SP("sel_prueba"); 
		parent::pg_Parametros_SP("$1",$tdoc);
		parent::pg_Parametros_SP("$2",$dni);
		parent::pg_Campos_Select("*");
		parent::pg_Poner_Esquema("hospitalizacion");
		parent::pg_Paginacion('ALL');
		$resultado=parent::executeSPArray();
			return $resultado;	
	}		
}
?>