<?php
session_start();
include_once("../../cdatos/DFormulario.php");

class LFormulario{
    
	private $dFormulario;
	private $array;
        
	public function __construct(){
            $this->dFormulario = new DFormulario();
	}
        //Buscador de empleados no registrados como usuarios
	public function listaEmpleadosNoUsuarios($opcion,$valor,$id_sistema){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->listaEmpleadosNoUsuarios($opcion,$valor,$id_sistema);
            $resultadoArray = array();
            //$f[0]: c_cod_per, $f[1]: c_iddide, $f[2]: descri, $f[3]: descri_r, $f[4]: c_ndide, $f[5]: v_nomper, $f[6]: v_apepat, $f[7]: v_apemat,
            foreach ($rs as $f) {
                $f['nom_com']=htmlentities($f[8]);
                $f['js'] = base64_encode($f[0]."|".$f[1]."|".$f[2]."|".$f[3]."|".$f[4]."|".htmlentities($f[5])."|".htmlentities($f[6])."|".htmlentities($f[7])."|".$id_sistema);
                array_push($resultadoArray,$f);
            }
            return $resultadoArray;
	}
        //Lista empleados que son usuarios
	public function listaUsuarios($opcion,$valor,$id_sistema){
            $rs = $this->dFormulario->listaUsuarios($opcion,$valor,$id_sistema);
            $resultadoArray = array();//$fila[0]: c_cod_per, $fila[9]: vlogin_usuario
            foreach ($rs as $fila) {
                //$fila['cadenaDatosUsuario'] = base64_encode($fila[0]."|".$fila[1]."|".$fila[2]."|".$fila[3]."|".$fila[4]."|".$fila[5]."|".$fila[6]."|".$fila[7]."|".$id_sistema);
                $fila['nom_com'] =  htmlentities($fila[8]);
                $fila['cadenaDatosUsuario'] = $fila[0]."-".$fila[9];
                array_push($resultadoArray,$fila);
            }
            return $resultadoArray;
	}
	//Carga los datos de usuarios habilitados
	public function fun_pn_usuarios_habilitados($opcion,$valor,$habilitado,$id_sistema,$id_formulario){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->fun_pn_usuarios_habilitados($opcion,$valor,$habilitado,$id_sistema);//Se envia 1 desde fondo.php
            //session_start();
            $Permisos_user = $_SESSION['permiso_formulario_servicio_panel'];//Ya está cargado esto al iniciar sesión
            //$ophabilita = $habilitado==1?0:1;
            if($habilitado==1){//Muestro habilitados
                $ophabilita=0;//Deseo deshabilitarlos
                $permiso1 = $Permisos_user[$id_formulario]['DESHABILITAR'];
                $permiso2 = $Permisos_user[$id_formulario]['EDITAR'];
            }
            else{//Muestro deshabilitados
                $ophabilita=1;//Deseo habilitarlos
                $permiso1 = $Permisos_user[$id_formulario]['HABILITAR'];
                $permiso2 = $Permisos_user[$id_formulario]['EDITAR'];
            }
            $icono1 = $habilitado==1?'agt_action_fail':'agt_action_success';
            $boton1_desh = "<img src='../../../../fastmedical_front/imagen/icono/".$icono1."_desh.png' alt='' title='' border='0'/>";
            $boton2_desh = "<img src='../../../../fastmedical_front/imagen/icono/editar_desh.png' alt='' title='' border='0'/>";
            $resultadoArray = array();
            //$f[0]: iid_usuario, $f[1]: c_cod_per
            foreach($rs as $f){
                $boton1 = "<a href='#' onclick=\"even_panel(1,'$ophabilita','$f[0]','$id_sistema');\">".
                           "<img src='../../../../fastmedical_front/imagen/icono/".$icono1.".png' alt='Deshabilitar' title='Deshabilitar' border='0'/></a>";
                $data = base64_encode($f[1]."|".$f[5]."|".$f[13]."|".$f[14]."|".$f[6]."|".htmlentities($f[7])."|".htmlentities($f[8])."|".htmlentities($f[9])."|".$id_sistema."|".$f[3]."|".$f[4]);
                $boton2 = "<a href='#' onclick=\"CargarVentana('buscador4','Nuevo Usuario del Sistema','../../ccontrol/control/control.php?".
                           "p1=MostrarPersona&c=$data&idformula=$id_formulario&estado=editar','500','300',false,true,'',1,'',10,10,10,10);\">".
                           "<img src='../../../../fastmedical_front/imagen/icono/editar.png' alt='Editar' title='Editar' border='0'/></a>";
                
                $f['v_nomper'] = htmlentities($f[7]);
                $f['v_apepat'] = htmlentities($f[8]);
                $f['v_apemat'] = htmlentities($f[9]);
                $f['vnom_perfil'] = htmlentities($f[15]);
                
                $f['bt'] = $permiso1=='1'?$boton1:$boton1_desh;
                $f['be'] = $permiso2=='1'?$boton2:$boton2_desh;
                $f['js'] = $f[1];//$f[1]: c_cod_per
                array_push($resultadoArray,$f);
            }
            return $resultadoArray;
	}
	//Utilizado para mostrar datos de trabajador que no es usuario del buscador antiguo
	public function listaPerfiles($id_sistema){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->listaPerfiles($id_sistema);
            //$fila[0]:iid_perfil, $fila[1]:iid_sistema, $fila[2]:vnom_perfil
            foreach ($rs as $fila) {
                $combo[$fila[0]]=htmlentities(trim($fila[2]));
            }
            return $combo;
	}
        //Utilizado para mostrar datos de trabajador que no es usuario del buscador antiguo
	public function listaUsuarioBD($id_sistema){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->listaUsuarioBD($id_sistema);
            //iid_usuariobd, vnom_usuariobd, vclave_usuariobd
            foreach ($rs as $fila) {
                $combo[$fila[0]]=trim($fila[1]);
            }
            return $combo;
	}
        function getArrayListaPerfiles($id_sistema){//Datos para el combo de perfiles
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->listaPerfiles($id_sistema);
            $combo = array();
            foreach($rs as $fila){
                $combo[$fila[0]]=htmlentities(trim($fila[2]));
            }
            return $combo;
        }
        //Dibuja tabla de perfiles
        public function getDetallePerfil($activo,$idsistema,$idperfil,$nomformulario){
            $rs = $this->dFormulario->listaPerfilFormulario($activo,$idsistema,$idperfil,$nomformulario);
            $resultadoArray = array();
            //$fila[1]: iid_formulario, $fila[2]: vnom_formulario
            foreach($rs as $fila){
                $fila["vnom_formulario"]=htmlentities($fila[2]);
                $fila["vdesc_formulario"]=htmlentities($fila[4]);
                
                if($fila["bfinal_formulario"]==1)
                    $fila["chk_final_formulario"] = "<input type='checkbox' checked disabled>";
                else
                    $fila["chk_final_formulario"] = "<input type='checkbox' disabled>";
                //Para habilitar-deshabilitar formulario
                if($fila["bhab_formulario"]==1){
                    $fila["chk_habilitado"] = "<input type='checkbox' checked disabled>";
                    $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_fail.png' alt='Deshabilitar' title='Deshabilitar'/>";
                }
                else
                    if($fila["bhab_formulario"]==0){
                        $fila["chk_habilitado"] = "<input type='checkbox' disabled>";
                        $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_success.png' alt='Habilitar' title='Habilitar'/>";
                    }
                    else
                        $fila["habilitado"] = "Nulo";
                
                $estado=$fila["bhab_formulario"];
                $fila["opciones"] = "<a href='#' onclick=\"habFormDePerfil($fila[1],'$fila[vnom_formulario]',$estado);\">".$imagenHab."</a>&nbsp;&nbsp;&nbsp;&nbsp;".
                                    "<a href='#' onclick=\"mostrarPerfilFormularioServicio($idsistema,$idperfil,$fila[1],'$fila[vnom_formulario]');\"><img src='../../../../fastmedical_front/imagen/icono/exec.gif' alt='Servicios' title='Servicios' border='0'/></a>";
                array_push($resultadoArray,$fila);
            }
            return $resultadoArray;
        }

        public function getNumeroServicios(){
            $rs = $this->dFormulario->listaServicio();
            $numero = $this->dFormulario->GetNumRows();
            return $numero;
        }
        //Dibuja tabla de formularios
        public function getDetalleFormulario($idsistema,$nomformulario){
            $rs = $this->dFormulario->listaFormulario($idsistema,$nomformulario);
            $resultadoArray = array();
            //fila[0]:iid_sistema, fila[1]:iid_formulario, fila[2]:vnom_formulario
            foreach($rs as $fila){
                $fila["vnom_formulario"]=htmlentities($fila[2]);
                $fila["vdesc_formulario"]=htmlentities($fila[4]);

                if($fila["bfinal_formulario"]==1)
                    $fila["chk_final_formulario"] = "<input type='checkbox' checked disabled>";
                else
                    $fila["chk_final_formulario"] = "<input type='checkbox' disabled>";
                //Para habilitar-deshabilitar formulario
                if($fila["bhabilitar_formulario"]==1){
                    $fila["chk_habilitado"] = "<input type='checkbox' checked disabled>";
                    $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_fail.png' alt='Deshabilitar' title='Deshabilitar'/>";
                }
                else{
                    $fila["chk_habilitado"] = "<input type='checkbox' disabled>";
                    $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_success.png' alt='Habilitar' title='Habilitar'/>";
                }
                $estado=$fila["bhabilitar_formulario"];

                $datos = base64_encode($fila[0]."|".$fila[1]."|".htmlentities($fila[2])."|".$fila[3]."|".htmlentities($fila[4])."|".$fila[5]."|".$fila[6]."|".$fila[7]."|".$fila[8]."|".$fila[9]."|".$fila[10]."|".$fila[11]);

                $fila["opciones"] = "<a href='#' onclick=\"eliminarFormulario('eliminar',$fila[1]);\"><img src='../../../../fastmedical_front/imagen/icono/op_rechazado.gif' alt='Eliminar' title='Eliminar' border='0'/></a>&nbsp;&nbsp;&nbsp;&nbsp;".
                                    "<a href='#' onclick=\"CargarVentana('popupManteFormulario','Registro de Formularios','../herramientas/manteFormulario.php?".
                                        "datos=$datos&accion=actualizar','305','350',false,true,'',1,'',10,10,10,10);\">".
                                        "<img src='../../../../fastmedical_front/imagen/icono/editar.png' alt='Editar' title='Editar' border='0'/></a>&nbsp;&nbsp;&nbsp;&nbsp;".
                                    "<a href='#' onclick=\"mostrarFormServ($idsistema,$fila[1],'$fila[vnom_formulario]');\"><img src='../../../../fastmedical_front/imagen/icono/exec.gif' alt='Servicios' title='Servicios' border='0'/></a>";
                array_push($resultadoArray,$fila);
            }
            return $resultadoArray;
        }
        //Dibuja tabla de servicios
        public function getDetalleServicio($nomservicio){
            $rs = $this->dFormulario->listaServicio($nomservicio);
            $resultadoArray = array();//$fila[0]:iid_servicio
            $ruta_boton=$_SESSION["path_principal"].'../fastmedical_front/imagen/btn/';
            $ruta_icono=$_SESSION["path_principal"].'../fastmedical_front/imagen/icono/';
            //$fila[0]:iid_servicio, $fila[1]:vnom_servicio, $fila[3]:vdesc_servicio, $fila[2]:vimagen_servicio, $fila[4]:vicono_servicio
            foreach($rs as $fila){
                $fila["vnom_servicio"]=htmlentities($fila[1]);
                $fila["vdesc_servicio"]=htmlentities($fila[3]);

                $imagen_boton = $ruta_boton.$fila["vimagen_servicio"];
                $imagen_icono = $ruta_icono.$fila["vicono_servicio"];
                $fila["boton"] = "<img src=$imagen_boton alt='No Registrado' title='Boton' border='0'/>";
                $fila["icono"] = "<img src=$imagen_icono alt='No Registrado' title='Icono' border='0'/>";
                $fila["opciones"] = "<a href='#' onclick=\"eliminarServicio('eliminar',$fila[0]);\">".
                                    "<img src='../../../../fastmedical_front/imagen/icono/op_rechazado.gif' alt='Eliminar' title='Eliminar' border='0'/></a>&nbsp;&nbsp;&nbsp;&nbsp;".
                                    "<a href='#' onclick=\"CargarVentana('popupManteServicio','Registro de Sevicios','../herramientas/manteServicio.php?".
                                    "p2=$fila[0]&p3=$fila[1]&p4=$fila[3]&p5=$fila[2]&p6=$fila[4]&accion=actualizar','305','220',false,true,'',1,'',10,10,10,10);\">".
                                    "<img src='../../../../fastmedical_front/imagen/icono/editar.png' alt='Editar' title='Editar' border='0'/></a>";
                array_push($resultadoArray,$fila);
                //CargarVentana('popupManteServicio','Registro de Sevicios','../herramientas/manteServicio.php?accion=\'insertar\'','305','200',false,true,'',1,'',10,10,10,10);
            }
            return $resultadoArray;
        }
        //Dibuja tabla de servicios de un formulario de perfil
        public function getPerfFormServ($idsistema,$idperfil,$idformulario){
            $rs = $this->dFormulario->listaPerfilServicio($idsistema,$idperfil,$idformulario);
            $resultadoArray = array();//$fila[2]:iid_servicio, $fila[3]:vnom_servicio
            $ruta_boton=$_SESSION["path_principal"].'../fastmedical_front/imagen/btn/';
            $ruta_icono=$_SESSION["path_principal"].'../fastmedical_front/imagen/icono/';
            foreach($rs as $fila){
                //Para habilitar-deshabilitar servicio de formulario de perfil
                $fila["vnom_servicio"]=htmlentities($fila[3]);
                $fila["vdesc_servicio"]=htmlentities($fila[4]);
                
                if($fila["bhab_servicio"]==1){
                    $fila["chk_habilitado"] = "<input type='checkbox' checked disabled>";
                    $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_fail.png' alt='Deshabilitar' title='Deshabilitar'/>";
                }
                else{
                    $fila["chk_habilitado"] = "<input type='checkbox' disabled>";
                    $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_success.png' alt='Habilitar' title='Habilitar'/>";
                }
                $estado=$fila["bhab_servicio"];

                $imagen_boton = $ruta_boton.$fila["vimagen_servicio"];
                $imagen_icono = $ruta_icono.$fila["vicono_servicio"];
                $fila["boton"] = "<img src=$imagen_boton alt='No Registrado' title='Boton' border='0'/>";
                $fila["icono"] = "<img src=$imagen_icono alt='No Registrado' title='Icono' border='0'/>";
                $fila["opciones"] = "<a href='#' onclick=\"habServDePerfil($idsistema,$idperfil,$idformulario,$fila[2],'$fila[vnom_servicio]',$estado);\">".$imagenHab."</a>";
                array_push($resultadoArray,$fila);
            }
            return $resultadoArray;
        }
        //Dibuja tabla de servicios de un formulario de permiso
        public function getPermisoFormServ($idsistema,$idformulario,$idpersona){
            $rs = $this->dFormulario->listaPermisoServicio($idsistema,$idformulario,$idpersona);
            $resultadoArray = array();//$fila[2]:iid_servicio, $fila[3]:vnom_servicio
            $ruta_boton=$_SESSION["path_principal"].'../fastmedical_front/imagen/btn/';
            $ruta_icono=$_SESSION["path_principal"].'../fastmedical_front/imagen/icono/';
            foreach($rs as $fila){
                //Para habilitar-deshabilitar servicio de formulario de permiso
                $fila["vnom_servicio"]=htmlentities($fila[3]);
                $fila["vdesc_servicio"]=htmlentities($fila[4]);

                if($fila["bhabilitar_servicio"]==1){
                    $fila["chk_habilitado"] = "<input type='checkbox' checked disabled>";
                    $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_fail.png' alt='Deshabilitar' title='Deshabilitar'/>";
                }
                else{
                    $fila["chk_habilitado"] = "<input type='checkbox' disabled>";
                    $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_success.png' alt='Habilitar' title='Habilitar'/>";
                }
                $estado=$fila["bhabilitar_servicio"];

                $imagen_boton = $ruta_boton.$fila["vimagen_servicio"];
                $imagen_icono = $ruta_icono.$fila["vicono_servicio"];
                $fila["boton"] = "<img src=$imagen_boton alt='No Registrado' title='Boton' border='0'/>";
                $fila["icono"] = "<img src=$imagen_icono alt='No Registrado' title='Icono' border='0'/>";
                $fila["opciones"] = "<a href='#' onclick=\"habServDePermiso($idsistema,'$idpersona',$idformulario,$fila[2],'$fila[vnom_servicio]',$estado);\">".$imagenHab."</a>";
                array_push($resultadoArray,$fila);
            }
            return $resultadoArray;
        }
        //Dibuja tabla de servicios de formulario
        public function getFormServ($idsistema,$idformulario,$nomservicio){
            $rs = $this->dFormulario->listaFormularioServicio($idsistema,$idformulario,$nomservicio);
            $resultadoArray = array();//$fila[2]:iid_servicio, $fila[3]:vnom_servicio
            $ruta_boton=$_SESSION["path_principal"].'../fastmedical_front/imagen/btn/';
            $ruta_icono=$_SESSION["path_principal"].'../fastmedical_front/imagen/icono/';
            foreach($rs as $fila){
                //Para habilitar-deshabilitar servicio de formulario
                $fila["vnom_servicio"]=htmlentities($fila[3]);
                $fila["vdesc_servicio"]=htmlentities($fila[4]);

                if($fila["bhab_servicio"]==1){
                    $fila["chk_habilitado"] = "<input type='checkbox' checked disabled>";
                    $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_fail.png' alt='Deshabilitar' title='Deshabilitar'/>";
                }
                else{
                    $fila["chk_habilitado"] = "<input type='checkbox' disabled>";
                    $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_success.png' alt='Habilitar' title='Habilitar'/>";
                }
                $estado=$fila["bhab_servicio"];

                $imagen_boton = $ruta_boton.$fila["vimagen_servicio"];
                $imagen_icono = $ruta_icono.$fila["vicono_servicio"];
                $fila["boton"] = "<img src=$imagen_boton alt='No Registrado' title='Boton' border='0'/>";
                $fila["icono"] = "<img src=$imagen_icono alt='No Registrado' title='Icono' border='0'/>";
                $fila["opciones"] = "<a href='#' onclick=\"habServDeForm($idsistema,$idformulario,$fila[2],'$fila[vnom_servicio]',$estado);\">".$imagenHab."</a>";
                //idsistema,idformulario,idservicio,nomserv,estado
                array_push($resultadoArray,$fila);
            }
            return $resultadoArray;
        }
        //Dibuja tabla de permisos-formularios, los formularios de un usuario
        public function getDetallePermiso($idsistema,$idpersona,$nomformulario){
            $rs = $this->dFormulario->listaPermiso($idsistema,$idpersona,$nomformulario);
            $resultadoArray = array();

            foreach($rs as $fila){
                $fila["vnom_formulario"]=htmlentities($fila[2]);
                $fila["vdesc_formulario"]=htmlentities($fila[4]);

                if($fila["bfinal_formulario"]==1)
                    $fila["chk_final_formulario"] = "<input type='checkbox' checked disabled>";
                else
                    $fila["chk_final_formulario"] = "<input type='checkbox' disabled>";
                //Para habilitar-deshabilitar formulario
                if($fila["bhabilitar_permiso_formulario"]==1){
                    $fila["chk_habilitado"] = "<input type='checkbox' checked disabled>";
                    $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_fail.png' alt='Deshabilitar' title='Deshabilitar'/>";
                }
                else{
                    $fila["chk_habilitado"] = "<input type='checkbox' disabled>";
                    $imagenHab = "<img src='../../../../fastmedical_front/imagen/icono/agt_action_success.png' alt='Habilitar' title='Habilitar'/>";
                }
                //fila[1]:iid_formulario, fila[2]:vnom_formulario
                $estado=$fila["bhabilitar_permiso_formulario"];
                $fila["opciones"] = "<a href='#' onclick=\"habFormDePermiso($fila[1],'$fila[vnom_formulario]',$estado);\">".$imagenHab."</a>&nbsp;&nbsp;&nbsp;&nbsp;".
                                    "<a href='#' onclick=\"mostrarPermisoFormServ($idsistema,'$idpersona',$fila[1],'$fila[vnom_formulario]');\"><img src='../../../../fastmedical_front/imagen/icono/exec.gif' alt='Servicios' title='Servicios' border='0'/></a>";
                array_push($resultadoArray,$fila);
            }
            return $resultadoArray;
        }

        public function spHabFormDePerfil($idsistema,$idperfil,$idformulario,$estado){
            $rs = $this->dFormulario->spHabFormDePerfil($idsistema,$idperfil,$idformulario,$estado);
            return $rs;
        }

        public function spHabFormDePermiso($idsistema,$idpersona,$idformulario,$estado){
            $rs = $this->dFormulario->spHabFormDePermiso($idsistema,$idpersona,$idformulario,$estado);
            return $rs;
        }

        public function spHabServDePerfil($idsistema,$idperfil,$idformulario,$idservicio,$estado){
            $rs = $this->dFormulario->spHabServDePerfil($idsistema,$idperfil,$idformulario,$idservicio,$estado);
            return $rs;
        }
        
        public function spHabServDePermiso($idsistema,$idpersona,$idformulario,$idservicio,$estado){
            $rs = $this->dFormulario->spHabServDePermiso($idsistema,$idpersona,$idformulario,$idservicio,$estado);
            return $rs;
        }

        public function spHabServDeForm($idsistema,$idformulario,$idservicio,$estado){
            $rs = $this->dFormulario->spHabServDeForm($idsistema,$idformulario,$idservicio,$estado);
            return $rs;
        }

        public function spMantePerfil($accion,$idSistema,$idPerfil,$nomPerfil){
            $rs = $this->dFormulario->spMantePerfil($accion,$idSistema,$idPerfil,$nomPerfil);
            return $rs;
        }
        //Cargar arbol de puestos por centros de costo
        public function seleccionarCategoria(){//Selecciona categoria de puesto de trabajo
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->seleccionarCategoria();
            $resultadoArray = array();

            foreach($rs as $fila) {
                $op=$fila[0];
                $resultadoArray[$op]=htmlentities($fila[1]);
            }
            return $resultadoArray;
        }

        public function getListaPuestos($datos){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->getListaPuestos($datos);
            return $rs;
        }

        public function getNombrePerfil($idsistema,$idperfil){
            $rs = $this->dFormulario->getNombrePerfil($idsistema,$idperfil);
            return $rs;
        }

        public function spEliminarPerfil($idSistema,$idPerfil){
            $rs = $this->dFormulario->spEliminarPerfil($idSistema,$idPerfil);
            return $rs;
        }

        public function spManteFormulario($accion,$idSistema,$idForm,$nomForm,$fileForm,$descForm,$nivelForm,$imgForm,$ordenForm,$abrirForm,$habForm,$finalForm,$dependeForm){
            $rs = $this->dFormulario->spManteFormulario($accion,$idSistema,$idForm,$nomForm,$fileForm,$descForm,$nivelForm,$imgForm,$ordenForm,$abrirForm,$habForm,$finalForm,$dependeForm);
            return $rs;
        }

        public function spEliminarFormulario($idSistema,$idFormulario){
            $rs = $this->dFormulario->spEliminarFormulario($idSistema,$idFormulario);
            return $rs;
        }

        public function spManteServicio($accion,$idServicio,$nomServicio,$descServicio,$boton,$icono){
            $rs = $this->dFormulario->spManteServicio($accion,$idServicio,$nomServicio,$descServicio,$boton,$icono);
            return $rs;
        }

        public function spEliminarServicio($idServicio){
            $rs = $this->dFormulario->spEliminarServicio($idServicio);
            return $rs;
        }

        public function spListaSistema($idSistema){
            $rs = $this->dFormulario->spListaSistema($idSistema);
            return $rs;
        }
        //Para guardar nuevo usuario
	public function fn_mante_usuario($opt,$per,$sis,$pef,$log,$pux,$hab,$ubd){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->fn_mante_usuario($opt,$per,$sis,$pef,$log,$pux,$hab,$ubd);
            return $rs;
	}
        //Para actualizar usuario, como perfil por ejemplo
	public function fun_pn_actualiza_perfil($id_sistema,$idpersona,$id_perfil,$id_usuariobd){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->fun_pn_actualiza_perfil($id_sistema,$idpersona,$id_perfil,$id_usuariobd);
            return $rs;
	}
        //Luego de grabar nuevo usuario
	public function fn_carga_perfil_formulario($id_sistema,$id_perfil,$idpersona){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->fn_carga_perfil_formulario($id_sistema,$id_perfil,$idpersona);
            return $rs;
	}
        //Luego de grabar nuevo usuario
	public function fn_carga_perfil_servicio($id_sistema,$id_perfil,$idpersona){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->fn_carga_perfil_servicio($id_sistema,$id_perfil,$idpersona);
            return $rs;
	}
        //Verifica si este login asignado pertenece a otra persona
	public function fn_busca_login($idpersona,$login){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->fn_busca_login($idpersona,$login);
            return $rs;
	}
        //Deshabilita un usuario de la lista de usuarios habilitados
	public function fn_habilitar_usuario($habilita,$idusuario,$idsistema){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->fn_habilitar_usuario($habilita,$idusuario,$idsistema);
            return $rs;
	}
	public function sp_lista_formulario_tree($idsistema,$idformulario,$select){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->sp_lista_formulario_tree($idsistema,$idformulario,$select);
            return $rs;
	}
        public function sp_lista_formulario_tree2($idsistema,$idformulario,$select){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->sp_lista_formulario_tree2($idsistema,$idformulario,$select);
            return $rs;
	}
	public function sp_lista_formulario_hijos($idsistema,$idformulario,$nomformulario){
            $oDFormulario = new DFormulario();
            $rs = $oDFormulario->sp_lista_formulario_hijos($idsistema,$idformulario,$nomformulario);
            return $rs;
	}
	public function sp_lista_formulario_hermanos($idsistema,$idformulario,$nomformulario){
            $oDFormulario 	= new DFormulario();
            $rs = $oDFormulario->sp_lista_formulario_hermanos($idsistema,$idformulario,$nomformulario);
            return $rs;
	}	
}
?>