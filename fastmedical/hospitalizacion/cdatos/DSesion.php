<?php
/***********************************************************
 *** OBTIENE LOS PERMISOS DE USUARIO
 *** SOLICITA LA CARGA LAS CONEXIONES
 ************************************************************/
include_once("../../../pholivo/adophp/Adophp.class.php");
include_once("../../../pholivo/Conexion.php");
//include_once("../../../pholivo/AbstraccionDato.php");


//session_start();

class DSesion extends Adophp {
	private $cnx;
	private $oRecord;
	public function __construct($cnx=''){
		$this->cnx = empty($cnx)?Conexion::getInitDsnMSSQLAuditoriaWeb():$cnx;
		parent::__construct('Spanish',$this->cnx);
                //parent::__construct($this->cnx);
	}
	
	public function getAccionSesion($accion,$sesion, $tiempo, $sistema,$contenido,$idusuario,$tcaduca,$ip){
           // parent::ReiniciarSQL();
                //Conexion::$arrayDsnUserMSSQL = Conexion::getInitDsnMSSQLAuditoria();
            parent::Liberar_Parametros();
		parent::ConnectionOpen('pnsSesiones','permisos');
		parent::SetParameterSP("$1",$accion);
		parent::SetParameterSP("$2",$sesion);
                parent::SetParameterSP("$3",$tiempo);
		parent::SetParameterSP("$4",$ip);
		parent::SetParameterSP("$5",$contenido);
		parent::SetParameterSP("$6",$tcaduca);
                parent::SetParameterSP("$7",$idusuario);
//Falta tipo de datos
		$resultado=parent::executeSPArrayX();
               // echo parent::GetSql();
                parent::Close();
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