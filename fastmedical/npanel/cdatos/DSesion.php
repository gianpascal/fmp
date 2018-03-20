<?php
include_once("../../../pholivo/Conexion.php");
include_once("../../../pholivo/adophp/Adophp.class.php");
class DSesion extends Adophp {
	private $arrayCnx;
	private $oRecord;
	public function __construct($arrayCnx = Array()){				

            $this->arrayCnx = empty($arrayCnx)?Conexion::getInitDsnPg():$arrayCnx;
            parent::__construct('Spanish', $this->arrayCnx);
            //$this->arrayCnx   va a ser $dsn
	}				
	
	public function getAccionSesion($accion='',$sesion='', $tiempo='', $sistema='',$contenido='',$usuario='',$ip=''){					
            parent::ReiniciarSQL();
                
		parent::ConnectionOpen('fn_manejador_session','acceso');		
		parent::SetParameterSP("$1",$accion,'VARCHAR');
		parent::SetParameterSP("$2",$sesion,'VARCHAR');
		parent::SetParameterSP("$3",$sistema,'INT');
		parent::SetParameterSP("$4",$tiempo,'INT');
		parent::SetParameterSP("$5",$ip,'VARCHAR');
		parent::SetParameterSP("$6",$contenido,'VARCHAR');
		parent::SetParameterSP("$7",$usuario,'VARCHAR');		
		parent::ExecuteSP();       
		$resultado = parent::GetRow();
		return $resultado;
	}
	
    public function getArrayUsuarioBaseDatos($sistema,$usuario){
                parent::__construct('Spanish',Conexion::getInitDsnPg());
                parent::ReiniciarSQL();

		parent::ConnectionOpen('sp_valida_usuariobd','acceso');
		parent::SetParameterSP("$1",$usuario,'INT');
		parent::SetParameterSP("$2",$sistema,'INT');
		parent::executeSP();
		$resultado = parent::GetRow();
		return $resultado;

	}

    public function getArrayPermisoFormulario($sistema,$usuario){
        parent::__construct('Spanish',Conexion::getInitDsnPg());
        parent::ReiniciarSQL();
		parent::ConnectionOpen('fn_permiso_formulario','acceso');
		parent::SetParameterSP("$1",$sistema,'INT');
		//parent::SetParameterSP("$2",'0','INT');
		parent::SetParameterSP("$2",$usuario,'INT');
		$resultado = parent::ExecuteSPArray();        
		return $resultado;
	}
    
    public function getArrayPermisoServicio($sistema,$usuario){
        parent::ReiniciarSQL();
		parent::ConnectionOpen('fn_permiso_servicio','acceso');
		parent::SetParameterSP("$1",$sistema,'INT');
		parent::SetParameterSP("$2",$usuario,'INT');
		$resultado = parent::ExecuteSPArray();
                //print_r($resultado);
		return $resultado;
	}

	public function __destruct(){
		parent::Close();	
	}		
}
?>