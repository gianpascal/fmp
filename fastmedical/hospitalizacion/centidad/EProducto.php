<?php 
class EProducto{
	private $cod_art;
	private $nombre_item;
	private $iid_tafiliacion;
	public function __construct(){
			
	}
	public function getCod_art(){
		return $this->cod_art;
	}
	public function setCod_art($_cod_art){ 
		$this->cod_art = $_cod_art; 
	}
	
	public function getNombre_item(){
		return $this->nombre_item;
	}
	public function setNombre_item($_nombre_item){ 
		$this->nombre_item = $_nombre_item; 
	}
	
	public function getIid_tafiliacion(){
		return $this->iid_tafiliacion;
	}
	public function setIid_tafiliacion($_iid_tafiliacion){ 
		$this->iid_tafiliacion = $_iid_tafiliacion; 
	}
}
?>