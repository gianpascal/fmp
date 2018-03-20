<?php
include_once("../../../pholivo/Conexion.php");
include_once("../../../pholivo/adophp/Adophp.class.php");

class DLogin extends Adophp {
	private $dsn;
	private $oRecord;

	public function __construct($dsn=''){
            $this->dsn = empty($dsn)?Conexion::getInitDsnMSSQLAuditoriaWeb():$dsn;
            parent::__construct('Spanish',$this->dsn);
	}

        public function getArrayUsuarioBD($sistema,$usuario,$clave){
            parent::ConnectionOpen("sp_lista_usuariobd","permisos");
            parent::SetParameterSP("iidsistema", 1);//$sistema=1 para panel
            parent::SetParameterSP("vlogin_usuario", $usuario);
            parent::SetParameterSP("vclave_usuario", sha1($clave));
            parent::SetSelect("*");
            parent::SetPagination("ALL");
            parent::ExecuteSP();
            $resultado=parent::GetRow();
            return $resultado;
        }

        public function getArrayUsuario($sistema,$usuario,$clave){
            $this->dsn = empty($dsn)?Conexion::getInitDsnMSSQLAuditoriaWeb():$dsn;
            parent::__construct('Spanish',$this->dsn);
            parent::ConnectionOpen("sp_per_usuario","permisos");
            parent::SetParameterSP("iidsistema", 1);//$sistema=1 para panel
            parent::SetParameterSP("vlogin_usuario", $usuario);
            parent::SetParameterSP("vclave_usuario", sha1($clave));
            parent::SetSelect("*");
            parent::SetPagination("ALL");
            parent::ExecuteSP();
            $resultado=parent::GetRow();
            return $resultado;
        }
	
	public function getArrayUsuarioOficina($idpersona,$idempresa){
            parent::ConnectionOpen("sp_lista_cargo_ofic_trab","permisos");
            parent::SetParameterSP("cidpersona", $idpersona);
            parent::SetParameterSP("cidempresa", $idempresa);
            parent::SetSelect("*");
            parent::SetPagination("ALL");
            parent::ExecuteSP();
            $resultado=parent::GetRow();
            return $resultado;
	}	
	
	public function getArrayDatosInstitucion($idpersona,$idempresa){
            parent::ConnectionOpen("sp_lista_empresa","permisos");
            parent::SetParameterSP("cidpersona", $idpersona);
            parent::SetParameterSP("cidempresa", $idempresa);
            parent::SetSelect("*");
            parent::SetPagination("ALL");
            parent::ExecuteSP();
            $resultado=parent::GetRow();
            return $resultado;
	}

        public function getArrayUsuarioPermisoFormulario($idsistema,$idpersona){
            /*parent::ConnectionOpen("sp_lista_permiso_formulario","permisos");
            parent::SetParameterSP("iidsistema", $idsistema);
            parent::SetParameterSP("cidpersona", $idpersona);
            parent::SetSelect("*");
            parent::SetPagination("ALL");
            return parent::executeSPArrayX();*/
            parent::ConnectionOpen("menu","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",0);
            parent::SetParameterSP("$3",$idpersona);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}

	public function getArrayUsuarioPermisoServicio($idsistema,$idpersona){
            $this->dsn = empty($dsn)?Conexion::getInitDsnMSSQLAuditoriaWeb():$dsn;
            parent::__construct('Spanish',$this->dsn);
            parent::ConnectionOpen("sp_permiso_formulario_servicio","permisos");
            parent::SetParameterSP("iidsistema", $idsistema);
            parent::SetParameterSP("cidpersona", $idpersona);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
	//Actualmente no se usa, se usaria con la estructura del postgresql
	public function getArrayCargaMenu ($idsistema,$nivel,$idpersona){
            parent::ConnectionOpen("menu","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",0);
            parent::SetParameterSP("$3",$idpersona);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
	//Actualmente no se usa, se usaria con la estructura del postgresql
	public function getArrayCargaMenuConsulta ($idformulario){				
		parent::setMNombre_SP(""); 
		parent::pg_Campos_Select("distinct form");
		parent::pg_Campos_From(" pg_ts_form ");
		parent::pg_Campos_Condicion(" form=".$idformulario);
		parent::pg_Poner_Esquema("public");
		parent::pg_Paginacion("ALL");
		parent::executeCSQL();	
		$resultado=parent::pg_Get_Row();					
		return $resultado;		
	}
	
	public function __destruct(){
		parent::Close();	
	}		
}
?>