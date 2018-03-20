<?php
session_start();
include_once("../../cdatos/DLogin.php");
//include_once("../cdatos/DLogin.php");
class LLogin{
	private $dLogin;
	private $array;
        
	public function __construct(){
		$this->dLogin = new DLogin();
	}

        public function getArrayUsuarioBD($parametros){
		$this->dLogin->getArrayUsuarioBD($parametros['p4'],$parametros['p2'],$parametros['p3']);
                //sistema,usuario,clave
                if($this->dLogin->pTotRows>0)
		{
                    $array=$this->dLogin->GetRow();
                    $_SESSION["vnom_usuariobd"] = $array['vnom_usuariobd'];
                    $_SESSION["vclave_usuariobd"] = $array['vclave_usuariobd'];
                    return 1;
		}
		else
		{
                    return 0;
		}
	}

        public function getArrayUsuario($parametros){
		$this->dLogin->getArrayUsuario($parametros['p4'],$parametros['p2'],$parametros['p3']);
                //sistema,usuario,clave
                if($this->dLogin->pTotRows>0)
		{
                        $array=$this->dLogin->GetRow();
                        //session_start();
                        //print_r($array);
                        $_SESSION["iid_usuario"] = $array['iid_usuario'];
                        $_SESSION["iid_sistema"] = $array['iid_sistema'];
                        $_SESSION["iid_perfil"] = $array['iid_perfil'];
                        $_SESSION["vlogin_usuario"] = $array['vlogin_usuario'];
                        $_SESSION["c_cod_per"] = $array['c_cod_per'];
                        $_SESSION["c_iddide"] = $array['c_iddide'];
                        $_SESSION["c_ndide"] = $array['c_ndide'];
                        $_SESSION["v_nomper"] = $array['v_nomper'];
                        $_SESSION["v_apepat"] = $array['v_apepat'];
                        $_SESSION["v_apemat"] = $array['v_apemat'];
                        //$_SESSION['ccosto'] = $array['v_desc_ccos'];
                        $_SESSION["path_principal"] = '../../../';
                        return 1;
		}
		else
		{
                    return 0;
		}
	}
	
	public function getUsuarioOficina($idpersona,$idempresa){
		$this->dLogin->getArrayUsuarioOficina($idpersona,$idempresa);
		if($this->dLogin->pTotRows>0){
			$array=$this->dLogin->GetRow();
			//session_name("SIMEDH");
			//session_start();
                        $_SESSION["c_cod_ccos"] = $array['c_cod_ccos'];
                        $_SESSION["c_cod_cargo"] = $array['c_cod_cargo'];
			$_SESSION["v_desc_ccos"] = $array['v_desc_ccos'];
		}
		return false;
	}
	
	public function getDatosInstitucion($idpersona,$idempresa){
		$array = $this->dLogin->getArrayDatosInstitucion($idpersona,$idempresa);
		if(!empty($array)){
			//session_name("SIMEDH");
			//session_start();
                        $_SESSION["v_noment"] = $array['v_noment'];
			$_SESSION["c_nro_ruc"] = $array['c_nro_ruc'];
			$_SESSION["c_dirleg"] = $array['c_dirleg'];
		}
		return false;
	}
	/*
	public function getUsuarioPermisoFormulario($parametros){
		$this->dLogin->getArrayUsuarioPermisoFormulario($parametros['p1'],$parametros['p2']);
		$total=$this->dLogin->pg_Total_Rows();
		$permiso_formulario = array();
		if($total>0){
			$N=0;
			do{	
				$row=$this->dLogin->pg_Get_Row();	
				$permiso_formulario['id_formulario']=$row['habilitar_formulario'];	
				$this->dLogin->pg_Move_Next();
				$N=$N+1;	
			}while($total>$N);
			session_name("SIMEDH");
			session_start();	
			$_SESSION['permiso_formulario']=$permiso_formulario;
			$resultado=1;
		}
		else	$resultado=0;	
				
		return 	$resultado;
	}*/

        public function getUsuarioPermisoFormulario($idsistema,$idpersona){
                $rs = $this->dLogin->getArrayUsuarioPermisoFormulario($idsistema,$idpersona);
		$total=$this->dLogin->pTotRows;
		$permiso_formulario = array();
		if($total>0){
			foreach($rs as $fila){
                            $permiso_formulario[$fila['iid_formulario']]=$fila;//Esto es al estilo Luisao
                            //$permiso_formulario['iid_formulario']=$fila['bhabilitar_permiso_formulario'];
                        }
                	//session_start();
                        $_SESSION['permiso_formulario_panel']=$permiso_formulario;
			$resultado=1;
		}
		else	$resultado=0;
		return 	$resultado;
	}

        public function getUsuarioPermisoServicio($idsistema,$idpersona){
		$rs = $this->dLogin->getArrayUsuarioPermisoServicio($idsistema,$idpersona);
		$total=$this->dLogin->pTotRows;
		$permiso_formulario_servicio = array();
		if($total>0){
			foreach($rs as $fila){
                            $permiso_formulario_servicio[$fila['iid_formulario']][$fila['vnom_servicio']]=1;
                        }
		}
		//session_name("SIMEDH");
		//session_start();
		$_SESSION['permiso_formulario_servicio_panel']=$permiso_formulario_servicio;
                //print_r($_SESSION['permiso_formulario_servicio']);
		return false;
	}
	
	public function getCargaMenu($idsistema,$nivel,$idpersona){
		$this->dLogin->getArrayCargaMenu($idsistema,$nivel,$idpersona);
		return $this->dLogin;									
	}
	
	public function getCargaMenuConsulta($idformulario){
		$this->dLogin->getArrayCargaMenuConsulta($idformulario);				
		return $this->dLogin;									
	}
}
?>