<?php
include_once("../../../pholivo/Conexion.php");
include_once("../../../pholivo/AbstraccionDato.php");
class DTree extends TSPResult {
	private $cnx;
	private $oRecord;
	public function __construct($cnx=''){
		$this->cnx = empty($cnx)?Conexion::getPgConexion():$cnx;	
		parent::__construct($this->cnx);
			
	}
	
	public function getArrayOficina(){						
		parent::setMNombre_SP(""); 
		parent::pg_Campos_Select(" * ");
		parent::pg_Campos_From(" nucleo.oficina ");
		parent::pg_Campos_Condicion(" niv_oficina='0' AND hab_oficina='t' ORDER BY cod_oficina ");	
		parent::pg_Paginacion('ALL');
		parent::pg_Poner_Esquema("nucleo");
		parent::executeCSQL();
		$resultado=parent::pg_Get_Row();					
		return $resultado;
	}
	
	public function getArrayOficinaInterno($cod_oficina){	
		parent::setMNombre_SP(""); 
		parent::pg_Campos_Select(" * ");
		parent::pg_Campos_From(" nucleo.oficina ");
		parent::pg_Campos_Condicion(" der_oficina='".trim($cod_oficina)."' AND hab_oficina='t' AND es_centro_costo='f' ORDER BY cod_oficina ");	
		parent::pg_Paginacion('ALL');
		parent::pg_Poner_Esquema("nucleo");
		//echo parent::Escribir_Consulta();
		parent::executeCSQL();
		$resultado=parent::pg_Get_Row();					
		return $resultado;
	}
		
	public function __destruct(){
		parent::Close();	
	}		
}
?>