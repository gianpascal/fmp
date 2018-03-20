<?php
include_once("../../../pholivo/Conexion.php");
include_once("../../../pholivo/adophp/Adophp.class.php");

class DFormulario extends Adophp {
	private $dsn;
	private $oRecord;
        
        public function __construct($dsn=''){
            $this->dsn = empty($dsn)?Conexion::getInitDsnMSSQLAuditoriaWeb():$dsn;
            parent::__construct('Spanish',$this->dsn);
	}
        //Busca empleados que no son usuarios
	public function listaEmpleadosNoUsuarios($opcion,$valor,$id_sistema){////
            parent::ConnectionOpen("sp_lista_empleados_no_usuarios","permisos");
            parent::SetParameterSP("$1",$opcion);
            parent::SetParameterSP("$2",$valor);
            parent::SetParameterSP("$3",$id_sistema);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
        //Lista empleados que son usuarios
	public function listaUsuarios($opcion,$valor,$id_sistema){////
            parent::ConnectionOpen("sp_lista_usuario","permisos");
            parent::SetParameterSP("$1",$opcion);
            parent::SetParameterSP("$2",$valor);
            parent::SetParameterSP("$3",$id_sistema);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
        //Carga datos de usuarios habilitados o deshabilitados
	public function fun_pn_usuarios_habilitados($opcion,$valor,$habilitado,$id_sistema){////
            parent::ConnectionOpen("sp_pn_usuarios_habilitados","permisos");
            parent::SetParameterSP("$1",$opcion);
            parent::SetParameterSP("$2",$valor);
            parent::SetParameterSP("$3",$habilitado);
            parent::SetParameterSP("$4",$id_sistema);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
        //Mostrar el arbol de puestos de trabajo por centro de costos
        public function seleccionarCategoria(){//Selecciona categoria de puesto de trabajo
            $this->dsn = Conexion::getInitDsnMSSQLSimedh();
            parent::__construct('Spanish',$this->dsn);
            parent::ConnectionOpen("pnsEmpleados","dbweb");
            parent::SetParameterSP("$1",'02');
            $resultado=parent::executeSPArrayX();
            parent::Close();
            return $resultado;
            //print_r($resultado);
        }

        public function getListaPuestos($datos) {
            $this->dsn = Conexion::getInitDsnMSSQLSimedh();
            parent::__construct('Spanish',$this->dsn);
            parent::ConnectionOpen("pnsPuestosPorCentroDeCosto","dbweb");
            parent::SetParameterSP("accion","03");
            parent::SetParameterSP("iIdCentroCosto",$datos["idCCostos"]);
            parent::SetParameterSP("vNombrePuesto",$datos["puesto"]);
            parent::SetParameterSP("iidCategoriaPuesto",$datos["categoria"]);
            parent::SetParameterSP("tipoEstado",$datos["estado"]);//Repetido
            $resultado=parent::executeSPArrayX();
            parent::Close();
            return $resultado;
            /*
            $this->dsn = Conexion::getInitDsnMSSQLSimedh();
            parent::__construct('Spanish',$this->dsn);
            parent::ConnectionOpen("pnsEmpleados","dbweb");
            parent::SetParameterSP("$1",'03');
            parent::SetParameterSP("$2",$datos["idCCostos"]);
            parent::SetParameterSP("$3",$datos["puesto"]);//esto puede estar fallando
            parent::SetParameterSP("$4",$datos["categoria"]);
            parent::SetParameterSP("$5",$datos["estado"]);//Repetido
            parent::SetParameterSP("$6","");
            parent::SetParameterSP("$7","");
            $resultado=parent::executeSPArrayX();
            parent::Close();
            return $resultado;
            */
        }

        public function getNombrePerfil($idsistema,$idperfil){
            parent::ConnectionOpen("pnsPerfil","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",$idperfil);
            $resultado=parent::executeSPArrayX();
            parent::Close();
            return $resultado;
        }

        //Para listar perfiles en general de acuerdo al sistema seleccionado
	public function listaPerfiles($id_sistema){////
            parent::ConnectionOpen("sp_lista_perfil","permisos");
            parent::SetParameterSP("$1",'%');
            parent::SetParameterSP("$2",$id_sistema);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
        //Lista los usuarios de las bases de datos de acuerdo al sistema
	public function listaUsuarioBD($id_sistema){////
            parent::ConnectionOpen("sp_lista_nombre_usuariobd","permisos");
            parent::SetParameterSP("$1",$id_sistema);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
        //Lista los formularios por cada perfil
        public function listaPerfilFormulario($activo,$idsistema,$idperfil,$nomformulario){////
            if($activo==1){
                parent::ConnectionOpen("sp_lista_perfil_formulario_hab","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idperfil);
            }
            else{
                parent::ConnectionOpen("sp_lista_perfil_formulario","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idperfil);
                parent::SetParameterSP("$3","%".$nomformulario."%");
            }
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        //Lista servicios de un formulario de un perfil
        public function listaPerfilServicio($idsistema,$idperfil,$idformulario){////
            parent::ConnectionOpen("sp_lista_perfil_servicio","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",$idperfil);
            parent::SetParameterSP("$3",$idformulario);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        //Lista servicios
        public function listaServicio($nomservicio){////
            parent::ConnectionOpen("sp_lista_servicio","permisos");
            parent::SetParameterSP("$1","%".$nomservicio."%");
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        //Lista formularios
        public function listaFormulario($idsistema,$nomformulario){////
            parent::ConnectionOpen("sp_lista_formulario","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2","%".$nomformulario."%");
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        //Lista permisos
        public function listaPermiso($idsistema,$idpersona,$nomformulario){////
            parent::ConnectionOpen("sp_lista_permiso_formulario","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",$idpersona);
            parent::SetParameterSP("$3","%".$nomformulario."%");
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        //Lista servicios de formulario de permiso
        public function listaPermisoServicio($idsistema,$idformulario,$idpersona){////
            parent::ConnectionOpen("sp_lista_permiso_servicio","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",$idformulario);
            parent::SetParameterSP("$3",$idpersona);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        //Para guardar nuevo usuario
	public function fn_mante_usuario($opt,$per,$sis,$pef,$log,$pux,$hab,$ubd){////
            parent::ConnectionOpen("sp_mante_usuario","permisos");
            parent::SetParameterSP("$1",$opt);
            parent::SetParameterSP("$2",0);//No se necesita el iid_usuario porque es autoincremental
            parent::SetParameterSP("$3",$per);
            parent::SetParameterSP("$4",$sis);
            parent::SetParameterSP("$5",$pef);
            parent::SetParameterSP("$6",$log);
            parent::SetParameterSP("$7",$pux);
            parent::SetParameterSP("$8",$hab);
            parent::SetParameterSP("$9",$ubd);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
        //Para actualizar usuario, como perfil por ejemplo
	public function fun_pn_actualiza_perfil($id_sistema,$idpersona,$id_perfil,$id_usuariobd){////
            parent::ConnectionOpen("sp_pn_actualiza_perfil","permisos");
            parent::SetParameterSP("$1",$id_sistema);
            parent::SetParameterSP("$2",$idpersona);
            parent::SetParameterSP("$3",$id_perfil);
            parent::SetParameterSP("$4",$id_usuariobd);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
        //Luego de grabar nuevo usuario, asigna permisos a formularios de acuerdo a perfil
	public function fn_carga_perfil_formulario($id_sistema,$id_perfil,$idpersona){////
            parent::ConnectionOpen("sp_carga_perfil_formulario","permisos");
            parent::SetParameterSP("$1",$id_sistema);
            parent::SetParameterSP("$2",$id_perfil);
            parent::SetParameterSP("$3",$idpersona);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
        //Luego de grabar nuevo usuario, asigna los servicios a los formularios de acuerdo a perfil
	public function fn_carga_perfil_servicio($id_sistema,$id_perfil,$idpersona){////
            parent::ConnectionOpen("sp_carga_perfil_servicio","permisos");
            parent::SetParameterSP("$1",$id_sistema);
            parent::SetParameterSP("$2",$id_perfil);
            parent::SetParameterSP("$3",$idpersona);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
	//Verifica si este login asignado pertenece a otra persona
	public function fn_busca_login($idpersona,$login){
            parent::ConnectionOpen("sp_busca_login","permisos");
            parent::SetParameterSP("$1",$login);
            parent::SetParameterSP("$2",$idpersona);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
        //Deshabilita un usuario de la lista de usuarios habilitados
	public function fn_habilitar_usuario($habilita,$idusuario,$idsistema){////Habilita o deshabilita un Usuario de Sistema
            parent::ConnectionOpen("sp_habilitar_usuario","permisos");
            parent::SetParameterSP("$1",$habilita);
            parent::SetParameterSP("$2",$idusuario);//iid_usuario
            parent::SetParameterSP("$3",$idsistema);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}

        public function sp_lista_formulario_tree($idsistema,$idformulario,$select){////
            //$idsistema:2 porque tiene que capturar todo del HMLO, $select era 1 para seleccionar solo los campos que necesito (ya no lo uso)
            parent::ConnectionOpen("sp_lista_formulario_tree","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",$idformulario);
            parent::SetParameterSP("$3","%");
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}

        public function sp_lista_formulario_tree2($idsistema,$idformulario,$select){////
            //$idsistema:2 porque tiene que capturar todo del HMLO, $select era 1 para seleccionar solo los campos que necesito (ya no lo uso)
            parent::ConnectionOpen("sp_lista_formulario_tree2","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",$idformulario);
            parent::SetParameterSP("$3","%");
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}

	public function sp_lista_formulario_hijos($idsistema,$idformulario,$nomformulario){////
            parent::ConnectionOpen("sp_lista_formulario_hijos","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",$idformulario);
            parent::SetParameterSP("$3",$nomformulario);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
	
	public function sp_lista_formulario_hermanos($idsistema,$idformulario,$nomformulario){////
            parent::ConnectionOpen("sp_lista_formulario_hermanos","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",$idformulario);
            parent::SetParameterSP("$3",$nomformulario);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
	}
        //Habilita-Deshabilita formulario de un perfil
        public function spHabFormDePerfil($idsistema,$idperfil,$idformulario,$estado){////
            if($estado==1){//Está habilitado -> deseo deshabilitarlo
                parent::ConnectionOpen("sp_elimina_perfil_formulario","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idperfil);
                parent::SetParameterSP("$3",$idformulario);
            }
            else{//Está deshabilitado -> deseo habilitarlo
                parent::ConnectionOpen("sp_inserta_perfil_formulario","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idperfil);
                parent::SetParameterSP("$3",$idformulario);
                parent::SetParameterSP("$4",1);
            }
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        //Habilita-Deshabilita formulario de un permiso
        public function spHabFormDePermiso($idsistema,$idpersona,$idformulario,$estado){////
            if($estado==1){//Está habilitado -> deseo deshabilitarlo
                parent::ConnectionOpen("sp_elimina_permiso_formulario","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idpersona);
                parent::SetParameterSP("$3",$idformulario);
            }
            else{//Está deshabilitado -> deseo habilitarlo
                parent::ConnectionOpen("sp_inserta_permiso_formulario","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idpersona);
                parent::SetParameterSP("$3",$idformulario);
                parent::SetParameterSP("$4",1);
            }
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        //Habilita-Deshabilita servicio de formulario de perfil
        public function spHabServDePerfil($idsistema,$idperfil,$idformulario,$idservicio,$estado){////
            if($estado==1){//Está habilitado -> deseo deshabilitarlo
                parent::ConnectionOpen("sp_elimina_perfil_servicio","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idperfil);
                parent::SetParameterSP("$3",$idformulario);
                parent::SetParameterSP("$4",$idservicio);
            }
            else{//Está deshabilitado -> deseo habilitarlo
                parent::ConnectionOpen("sp_inserta_perfil_servicio","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idperfil);
                parent::SetParameterSP("$3",$idformulario);
                parent::SetParameterSP("$4",$idservicio);
                parent::SetParameterSP("$5",1);
            }
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        //Habilita-Deshabilita servicio de formulario de permiso
        public function spHabServDePermiso($idsistema,$idpersona,$idformulario,$idservicio,$estado){////
            if($estado==1){//Está habilitado -> deseo deshabilitarlo
                parent::ConnectionOpen("sp_elimina_permiso_servicio","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idpersona);
                parent::SetParameterSP("$3",$idformulario);
                parent::SetParameterSP("$4",$idservicio);
            }
            else{//Está deshabilitado -> deseo habilitarlo
                parent::ConnectionOpen("sp_inserta_permiso_servicio","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idpersona);
                parent::SetParameterSP("$3",$idformulario);
                parent::SetParameterSP("$4",$idservicio);
                parent::SetParameterSP("$5",1);
            }
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        //Habilita-Deshabilita servicio de formulario
        public function spHabServDeForm($idsistema,$idformulario,$idservicio,$estado){////
            if($estado==1){//Está habilitado -> deseo deshabilitarlo
                parent::ConnectionOpen("sp_elimina_formulario_servicio","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idformulario);
                parent::SetParameterSP("$3",$idservicio);
            }
            else{//Está deshabilitado -> deseo habilitarlo
                parent::ConnectionOpen("sp_inserta_formulario_servicio","permisos");
                parent::SetParameterSP("$1",$idsistema);
                parent::SetParameterSP("$2",$idformulario);
                parent::SetParameterSP("$3",$idservicio);
                parent::SetParameterSP("$4",1);
            }
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        //Lista servicios de formulario
        public function listaFormularioServicio($idsistema,$idformulario,$nomservicio){////
            parent::ConnectionOpen("sp_cargar_servicio","permisos");
            parent::SetParameterSP("$1",$idsistema);
            parent::SetParameterSP("$2",$idformulario);
            parent::SetParameterSP("$3",$nomservicio);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }

        public function spMantePerfil($accion,$idSistema,$idPerfil,$nomPerfil){////
            parent::ConnectionOpen("sp_mante_perfil","permisos");
            parent::SetParameterSP("$1",$accion);
            parent::SetParameterSP("$2",$idSistema);
            parent::SetParameterSP("$3",$idPerfil);
            parent::SetParameterSP("$4",$nomPerfil);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }

        public function spEliminarPerfil($idSistema,$idPerfil){////
            parent::ConnectionOpen("sp_eliminar_perfil","permisos");
            parent::SetParameterSP("$1",$idSistema);
            parent::SetParameterSP("$2",$idPerfil);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        
        public function spManteFormulario($accion,$idSistema,$idForm,$nomForm,$fileForm,$descForm,$nivelForm,$imgForm,$ordenForm,$abrirForm,$habForm,$finalForm,$dependeForm){////
            parent::ConnectionOpen("sp_mante_formulario","permisos");
            parent::SetParameterSP("$1",$accion);
            parent::SetParameterSP("$2",$idSistema);
            parent::SetParameterSP("$3",$idForm);
            parent::SetParameterSP("$4",$nomForm);
            parent::SetParameterSP("$5",$fileForm);
            parent::SetParameterSP("$6",$descForm);
            parent::SetParameterSP("$7",$nivelForm);
            parent::SetParameterSP("$8",$imgForm);
            parent::SetParameterSP("$9",$ordenForm);
            parent::SetParameterSP("$10",$abrirForm);
            parent::SetParameterSP("$11",$habForm);
            parent::SetParameterSP("$12",$finalForm);
            parent::SetParameterSP("$13",$dependeForm);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }

        public function spEliminarFormulario($idSistema,$idFormulario){////
            parent::ConnectionOpen("sp_eliminar_formulario","permisos");
            parent::SetParameterSP("$1",$idSistema);
            parent::SetParameterSP("$1",$idFormulario);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }

        public function spManteServicio($accion,$idServicio,$nomServicio,$descServicio,$boton,$icono){
            parent::ConnectionOpen("sp_mante_servicio","permisos");
            parent::SetParameterSP("$1",$accion);
            parent::SetParameterSP("$2",$idServicio);
            parent::SetParameterSP("$3",$nomServicio);
            parent::SetParameterSP("$4",$descServicio);
            parent::SetParameterSP("$5",$boton);
            parent::SetParameterSP("$6",$icono);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }

        public function spEliminarServicio($idServicio){
            parent::ConnectionOpen("sp_eliminar_servicio","permisos");
            parent::SetParameterSP("$1",$idServicio);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }

        public function spListaSistema($idSistema){////
            parent::ConnectionOpen("sp_lista_sistema","permisos");
            parent::SetParameterSP("$1",$idSistema);
            parent::SetSelect("*");
            parent::SetPagination('ALL');
            return parent::executeSPArrayX();
        }
        
	public function __destruct(){
		parent::Close();	
	}		
}
?>