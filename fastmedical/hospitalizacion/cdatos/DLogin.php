<?php
include_once("../../../pholivo/Conexion.php");
//include_once("../../../pholivo/AbstraccionDato.php");
include_once("../../../pholivo/adophp/Adophp.class.php");

class DLogin extends Adophp {
	private $cnx;
	private $oRecord;
	public function __construct($cnx = Array()) {
        $this->cnx = empty($cnx)?Conexion::getInitDsnMSSQLAuditoriaWeb():$cnx;
        parent::__construct('Spanish',$this->cnx);
    }

        public function getAccionSesion($accion,$sesion, $tiempo, $sistema,$contenido,$idusuario,$tcaduca,$ip,$id){

		parent::ConnectionOpen('pnsSesiones','permisos');
		parent::SetParameterSP("$1",$accion);
		parent::SetParameterSP("$2",$sesion);
                parent::SetParameterSP("$3",$tiempo);
		parent::SetParameterSP("$4",$ip);
		parent::SetParameterSP("$5",$contenido);
		parent::SetParameterSP("$6",$tcaduca);
                parent::SetParameterSP("$7",$idusuario);
                parent::SetParameterSP("$8",$id);
		$resultado=parent::executeSPArrayX();
                parent::Close();
                return $resultado;
	}
	public function getArrayUsuario($sistema,$usuario,$clave){

            parent::ConnectionOpen("pnsLogueoSimedhWeb","permisos");
            parent::SetParameterSP("iidsistema", $sistema);//$sistema=1 para panel, $sistema=2 para simedh
            parent::SetParameterSP("vlogin_usuario", $usuario);
            parent::SetParameterSP("vclave_usuario", $clave);
            
            $resultado=parent::executeSPArrayX();
            parent::Close();
            return $resultado;
        }
	/*public function getArrayUsuarioOficina($cargo,$idpersona){
		parent::setMNombre_SP("sp_lista_cargo_ofic_trab"); 
		parent::pg_Parametros_SP("$1",$cargo);
		parent::pg_Parametros_SP("$2",$idpersona);
		parent::pg_Campos_Select("*");
		parent::pg_Poner_Esquema("nucleo");
		parent::pg_Paginacion('ALL');
		parent::executeSP();		
		$resultado=parent::pg_Get_Row();	
		return $resultado;
        }*/
///////////****OBTENCION DE COD, CARGO Y CENTRO DE COSTO DEL USUARIO****////////////////
        public function getArrayUsuarioOficina($idpersona,$idempresa){
            
            parent::ConnectionOpen("sp_lista_cargo_ofic_trab","permisos");
            parent::SetParameterSP("cidpersona", $idpersona);
            parent::SetParameterSP("cidempresa", $idempresa);
            parent::SetSelect("*");
            parent::SetPagination("ALL");
//            parent::ExecuteSP();
//            $resultado=parent::GetRow();
            $resultado=parent::executeSPArrayX();
            parent::Close();
            return $resultado;
	}
	

///////////****OBTIENE INSTITUCION DE USUARIO****////////////////
        public function getArrayDatosInstitucion($idpersona,$idempresa){
           
            parent::ConnectionOpen("sp_lista_empresa","permisos");
            parent::SetParameterSP("cidpersona", $idpersona);
            parent::SetParameterSP("cidempresa", $idempresa);
//            parent::ExecuteSP();
//            $resultado=parent::GetRow();
            $resultado=parent::executeSPArrayX();
            parent::Close();
            return $resultado;
	}
///////////****OBTIENE PERMISOS PARA FORMULARIO***////////////////
	public function getArrayUsuarioPermisoFormulario ($idsistema,$idpersona){
            
            parent::ConnectionOpen("menu","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",0);
            parent::SetParameterSP("$3",$idpersona);
            
            $resultado=parent::executeSPArrayX();
            parent::Close();
            return $resultado;
                /*parent::ConnectionOpen("menu","permisos");
            	parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",0);
                parent::SetParameterSP("$3",$idusuario);
		parent::SetSelect("*");
		parent::SetSchema("permisos");
		parent::SetPagination('ALL');
		return parent::executeSPArrayX();*/
                
	}
    ///////////****OBTIENE PERMISOS PARA SERVICIO***////////////////
	public function getArrayUsuarioPermisoServicio ($idpersona,$idsistema){
            //echo 'saaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
            parent::ConnectionOpen("sp_permiso_formulario_servicio","permisos");
            parent::SetParameterSP("$1", $idsistema);
            parent::SetParameterSP("$2", $idpersona);
            //echo 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee';
            $resultado=parent::executeSPArrayX();
             parent::Close();
            return $resultado;

	}
	
	public function getArrayCargaMenu ($idsistema,$nivel,$idpersona){
            
            parent::ConnectionOpen("menu","permisos");
            //parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$1",2);
            parent::SetParameterSP("$2",0);
            parent::SetParameterSP("$3",$idpersona);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            parent::Close();
            return parent::executeSPArrayX();
		
	}
	

	public function __destruct(){
		parent::Close();	
	}		
}
?>
