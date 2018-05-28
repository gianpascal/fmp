<?php
class EPaciente{ 
		private $iid_persona;
		private $vnombre;
		private $vapellido_pat;
		private $vapellido_mat;
		private $fecha_nacimiento;
		private $csexo;
		private $iid_estado_civil;
		private $estado_civil;
		private $vnro_doc_identidad;
		private $tipo_documento;
		private $iid_tipo_documento;
		private $nro_historia_clinica;
		private $iid_tafiliacion;
		private $iid_mafiliacion;
		private $afiliacion;
		private $grupo_sanguineo;		
		private $telefono;
		private $celular;
		private $email;
		private $fax;
		private $cid_ubigeo;
		private $cano_ubigeo;
		private $vdireccion;

	public function __construct(
		$_iid_persona='',
		$_vnombre='',
		$_vapellido_pat='',
		$_vapellido_mat='',
		$_fecha_nacimiento='',
		$_csexo='',
		$_iid_estado_civil='',
		$_estado_civil='',
		$_vnro_doc_identidad='',
		$_tipo_documento='',
		$_iid_tipo_documento='',
		$_nro_historia_clinica='',
		$_iid_tafiliacion='',
		$_iid_mafiliacion='',
		$_afiliacion='',
		$_grupo_sanguineo='',		
		$_telefono='',
		$_celular='',
		$_email='',
		$_fax='',
		$_cid_ubigeo='',
		$_cano_ubigeo='',
		$_vdireccion=''){
		$this->iid_persona = $_iid_persona;
		$this->vnombre=$_vnombre;
		$this->vapellido_pat=$_vapellido_pat;
		$this->vapellido_mat=$_vapellido_mat;
		$this->fecha_nacimiento=$_fecha_nacimiento;
		$this->csexo=$_csexo;
		$this->iid_estado_civil=$_iid_estado_civil;
		$this->estado_civil=$_estado_civil;
		$this->vnro_doc_identidad=$_vnro_doc_identidad;
		$this->tipo_documento=$_tipo_documento;
		$this->iid_tipo_documento=$_iid_tipo_documento;
		$this->nro_historia_clinica=$_nro_historia_clinica;
		$this->iid_tafiliacion=$_iid_tafiliacion;
		$this->iid_mafiliacion=$_iid_mafiliacion;
		$this->afiliacion=$_afiliacion;
		$this->fecha_nacimiento=$_fecha_nacimiento;
		$this->grupo_sanguineo=$_grupo_sanguineo;		
		$this->telefono=$_telefono;
		$this->celular=$_celular;
		$this->email=$_email;
		$this->fax=$_fax;
		$this->cid_ubigeo=$_cid_ubigeo;
		$this->cano_ubigeo=$_cano_ubigeo;
		$this->vdireccion=$_vdireccion;
	}
	public function getIid_persona(){
		return $this->iid_persona;
	}
	public function setIid_persona($_iid_persona){ 
		$this->iid_persona = $_iid_persona; 
	}

	public function getVnombre(){
		return $this->vnombre;
	}
	public function setVnombre($_vnombre){ 
		$this->vnombre = $_vnombre; 
	}
	
	public function getVapellido_pat(){
		return $this->vapellido_pat;
	}
	public function setVapellido_pat($_vapellido_pat){ 
		$this->vapellido_pat = $_vapellido_pat; 
	}
	
	public function getVapellido_mat(){
		return $this->vapellido_mat;
	}
	public function setVapellido_mat($_vapellido_mat){ 
		$this->vapellido_mat = $_vapellido_mat; 
	}
	
	public function getFecha_nacimiento(){
		return $this->fecha_nacimiento;
	}
	public function setFecha_nacimiento($_fecha_nacimiento){ 
		$this->fecha_nacimiento = $_fecha_nacimiento; 
	}
	
	public function getCsexo(){
		return $this->csexo;
	}
	public function setCsexo($_csexo){ 
		$this->csexo = $_csexo; 
	}
	
	public function getIid_estado_civil(){
		return $this->iid_estado_civil;
	}
	public function setIid_estado_civil($_iid_estado_civil){ 
		$this->iid_estado_civil = $_iid_estado_civil; 
	}
	
	public function getEstado_civil(){
		return $this->estado_civil;
	}
	public function setEstado_civil($_estado_civil){ 
		$this->estado_civil = $_estado_civil; 
	}
	
	public function getVnro_doc_identidad(){
		return $this->vnro_doc_identidad;
	}
	public function setVnro_doc_identidad($_vnro_doc_identidad){ 
		$this->vnro_doc_identidad = $_vnro_doc_identidad; 
	}
	
	public function getTipo_documento(){
		return $this->tipo_documento;
	}
	public function setTipo_documento($_tipo_documento){ 
		$this->tipo_documento = $_tipo_documento; 
	}
	
	public function getIid_tipo_documento(){
		return $this->iid_tipo_documento;
	}
	public function setIid_tipo_documento($_iid_tipo_documento){ 
		$this->iid_tipo_documento = $_iid_tipo_documento; 
	}
	
	public function getNro_historia_clinica(){
		return $this->nro_historia_clinica;
	}
	public function setNro_historia_clinica($_nro_historia_clinica){ 
		$this->nro_historia_clinica = $_nro_historia_clinica; 
	}
	
	public function getIid_tafiliacion(){
		return $this->iid_tafiliacion;
	}
	public function setIid_tafiliacion($_iid_tafiliacion){ 
		$this->iid_tafiliacion = $_iid_tafiliacion; 
	}
	
	public function getIid_mafiliacion(){
		return $this->iid_mafiliacion;
	}
	public function setIid_mafiliacion($_iid_mafiliacion){ 
		$this->iid_mafiliacion = $_iid_mafiliacion; 
	}
	
	public function getAfiliacion(){
		return $this->afiliacion;
	}
	public function setAfiliacion($_afiliacion){ 
		$this->afiliacion = $_afiliacion; 
	}
	
	public function getGrupo_sanguineo(){
		return $this->grupo_sanguineo;
	}
	public function setGrupo_sanguineo($_grupo_sanguineo){ 
		$this->grupo_sanguineo = $_grupo_sanguineo; 
	}
	
	public function getTelefono(){
		return $this->telefono;
	}
	public function setTelefono($_telefono){ 
		$this->telefono = $_telefono; 
	}
	
	public function getCelular(){
		return $this->celular;
	}
	public function setCelular($_celular){ 
		$this->celular = $_celular; 
	}
	
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($_email){ 
		$this->email = $_email; 
	}
	
	public function getFax(){
		return $this->fax;
	}
	public function setFax($_fax){ 
		$this->fax = $_fax; 
	}
	
	public function getCid_ubigeo(){
		return $this->cid_ubigeo;
	}
	public function setCid_ubigeo($_cid_ubigeo){ 
		$this->cid_ubigeo = $_cid_ubigeo; 
	}
	
	public function getCano_ubigeo(){
		return $this->cano_ubigeo;
	}
	public function setCano_ubigeo($_cano_ubigeo){ 
		$this->cano_ubigeo = $_cano_ubigeo; 
	}
	
	public function getVdireccion(){
		return $this->vdireccion;
	}
	public function setVdireccion($_vdireccion){ 
		$this->vdireccion = $_vdireccion; 
	}	
}
?>