<?php
require_once("../../../pholivo/Html.php");
require_once("../../../pholivo/Html1.php");
require_once("../../clogica/LFormulario.php");
require_once("../../../pholivo/HTML_TreeMenu/TreeMenuFacilito.php");

class ActionFormulario{

	public function __construct(){
            
	}
        //Buscador de empleados no registrados como usuarios
	public function listaEmpleadosNoUsuarios($opcion,$valor,$id_sistema)
	{   
            if($opcion==1){
                $datosSeparados = explode("|",$valor);
                $apPat = $datosSeparados[0];
                $apMat = $datosSeparados[1];
                $nombre = $datosSeparados[2];
                
                if($apPat!='' && $apMat=='' && $nombre==''){
                    $opcion2 = 11;
                    $valor2 = $apPat;
                }
                else{
                    if($apPat=='' && $apMat!='' && $nombre==''){
                        $opcion2 = 12;
                        $valor2 = $apMat;
                    }
                    else{
                        if($apPat=='' && $apMat=='' && $nombre!=''){
                            $opcion2 = 13;
                            $valor2 = $nombre;
                        }
                        else{
                            if($apPat!='' && $apMat!='' && $nombre==''){
                                $opcion2 = 14;
                                $valor2 = $apPat.' '.$apMat;
                            }
                            else{
                                if($apPat=='' && $apMat!='' && $nombre!=''){
                                    $opcion2 = 15;
                                    $valor2 = $apMat.' '.$nombre;
                                }
                                else{
                                    if($apPat!='' && $apMat=='' && $nombre!=''){
                                        $opcion2 = 16;
                                        $valor2 = $apPat.' '.$nombre;
                                    }
                                    else{
                                        if($apPat!='' && $apMat!='' && $nombre!=''){
                                            $opcion2 = 17;
                                            $valor2 = $apPat.' '.$apMat.' '.$nombre;
                                        }
                                        else{
                                            if($apPat=='' && $apMat=='' && $nombre==''){
                                                $opcion2 = 18;
                                                $valor2 = '';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else{
                $opcion2 = $opcion;
                $valor2 = $valor;
            }
            $oLFormulario = new LFormulario();
            $arrayFilas	= $oLFormulario->listaEmpleadosNoUsuarios($opcion2,$valor2,$id_sistema);

            //$arrayCabecera = array('c_cod_per'=>"CODIGO","nom_com"=>"EMPLEADO","c_ndide"=>"DOCUMENTO");
            $arrayCabecera = array('c_cod_per'=>"CÓDIGO","nom_com"=>"EMPLEADO","descri"=>"DOCUMENTO","c_ndide"=>"NÚMERO");
            $o_Tabla = new Tabla($arrayCabecera,$arrayFilas,'col1','col2','sele','title','js','selItem');
            $tablaHTML = $o_Tabla->getTabla();
            $row_ini = "<table class='grid' width='100%' border='0' cellpadding='2' cellspacing='0'>";
            $row_fin ="</table>";
            return $row_ini.$tablaHTML.$row_fin;
	}
        //Lista empleados que son usuarios
	public function listaUsuarios($opcion,$valor,$id_sistema)
	{
            if($opcion==1){
                $datosSeparados = explode("|",$valor);
                $apPat = $datosSeparados[0];
                $apMat = $datosSeparados[1];
                $nombre = $datosSeparados[2];
                
                if($apPat!='' && $apMat=='' && $nombre==''){
                    $opcion2 = 11;
                    $valor2 = $apPat;
                }
                else{
                    if($apPat=='' && $apMat!='' && $nombre==''){
                        $opcion2 = 12;
                        $valor2 = $apMat;
                    }
                    else{
                        if($apPat=='' && $apMat=='' && $nombre!=''){
                            $opcion2 = 13;
                            $valor2 = $nombre;
                        }
                        else{
                            if($apPat!='' && $apMat!='' && $nombre==''){
                                $opcion2 = 14;
                                $valor2 = $apPat.' '.$apMat;
                            }
                            else{
                                if($apPat=='' && $apMat!='' && $nombre!=''){
                                    $opcion2 = 15;
                                    $valor2 = $apMat.' '.$nombre;
                                }
                                else{
                                    if($apPat!='' && $apMat=='' && $nombre!=''){
                                        $opcion2 = 16;
                                        $valor2 = $apPat.' '.$nombre;
                                    }
                                    else{
                                        if($apPat!='' && $apMat!='' && $nombre!=''){
                                            $opcion2 = 17;
                                            $valor2 = $apPat.' '.$apMat.' '.$nombre;
                                        }
                                        else{
                                            if($apPat=='' && $apMat=='' && $nombre==''){
                                                $opcion2 = 18;
                                                $valor2 = '';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else{
                $opcion2 = $opcion;
                $valor2 = $valor;
            }

            $oLFormulario = new LFormulario();
            $arrayFilas	= $oLFormulario->listaUsuarios($opcion2,$valor2,$id_sistema);
            $arrayCabecera = array('c_cod_per'=>"CODIGO","nom_com"=>"EMPLEADO","descri"=>"DOCUMENTO","c_ndide"=>"NUMERO");
            $o_Tabla = new Tabla($arrayCabecera,$arrayFilas,'col1','col2','sele','title','cadenaDatosUsuario','selUsuario');
            $tablaHTML = $o_Tabla->getTabla();
            $row_ini = "<table class='grid' width='100%' border='0' cellpadding='2' cellspacing='0'>";
            $row_fin ="</table>";
            return $row_ini.$tablaHTML.$row_fin;
	}
	//Esto carga los datos de usuarios habilitados
	public function fun_pn_usuarios_habilitados($parametros){
            $opcion = $parametros["p2"];
            $valor = $parametros["p3"]==''?'%':$parametros["p3"];
            $habilitado	= $parametros["op"];//Se envia 1 desde fondo.php
            $id_sistema	= $parametros["id_sistema"];
            $id_formulario = $parametros["id_formulario"];
            $oLFormulario = new LFormulario();
            $arrayFilas	= $oLFormulario->fun_pn_usuarios_habilitados($opcion,$valor,$habilitado,$id_sistema,$id_formulario);

            $arrayTipo = array( 'descri_r'=>"c",
                                'c_ndide'=>"c",
                                'v_nomper'=>"h",
                                'v_apepat'=>"h",
                                'v_apemat'=>"h",
                                'vnom_perfil'=>"h",
                                'vnom_usuariobd'=>"h",
                                //'nom_com'=>"USUARIO",
                                'vlogin_usuario'=>"c",
                                'bt'=>"h",
                                'be'=>"h" );

            $arrayCabecera = array( 'descri_r'=>"DOC.",
                                    'c_ndide'=>"NUMERO",
                                    'v_nomper'=>"NOMBRE",
                                    'v_apepat'=>"APELLIDO PATERNO",
                                    'v_apemat'=>"APELLIDO MATERNO",
                                    'vnom_perfil'=>"PERFIL",
                                    'vnom_usuariobd'=>"USUARIO BD",
                                    //'nom_com'=>"USUARIO",
                                    'vlogin_usuario'=>"USUARIO",
                                    'bt'=>"HABILITAR",
                                    'be'=>"OPCIONES" );
            $o_Tabla = new Tabla($arrayCabecera,$arrayFilas,'col1','col2','sele','title','js','');
            $tablaHTML = $o_Tabla->getTabla();
            $row_ini = "<table class='grid' width='100%' border='0' cellpadding='2' cellspacing='0'>";
            $row_fin = "</table>";
            return $row_ini.$tablaHTML.$row_fin;

            /*
            $arrayTipo = array( "iid_formulario"=>"c",
                                "vnom_formulario"=>"h",
                                "vdesc_formulario"=>"h",
                                "inivel_formulario"=>"c",
                                "iorden_formulario"=>"c",
                                "idepende_formulario"=>"c",
                                "chk_final_formulario"=>"h",
                                "chk_habilitado"=>"h",
                                "opciones"=>"h");

            $arrayCabecera = array( "iid_formulario"=>"ID",
                                    "vnom_formulario"=>"NOMBRE",
                                    "vdesc_formulario"=>"DESCRIPCION",
                                    "inivel_formulario"=>"NIVEL",
                                    "iorden_formulario"=>"ORDEN",
                                    "idepende_formulario"=>"DEPENDE",
                                    "chk_final_formulario"=>"FINAL",
                                    "chk_habilitado"=>"HAB",
                                    "opciones"=>"OPCIONES");

            $o_Tabla = new Tabla1($arrayCabecera,50,$arrayFilas,'tablaOrden','col1','col2','sele','','',0,$arrayTipo,'','');
            $o_Tabla->setColumnasOrdenar(array("iid_formulario","vnom_formulario"));
            $tablaHTML = $o_Tabla->getTabla();
            return $tablaHTML;
             */

	}
        //Esto carga los datos de trabajador que no es usuario del buscador antiguo
	public function MostrarPersona($c,$f,$e){
            $a = base64_decode($c);
            $row = explode("|",$a);
            if(!isset($row[9]))
                $row[9]="";
            if(!isset($row[10]))
                $row[10]="";
            $row[100] = $this->listaPerfiles($row[8],$row[9]);//$row[9]es vacio, aun no se ha llenado nada; si es para editar perfil $row[9]: iid_perfil,   $r[8]: iid_sistema
            $row[101] = $this->listaUsuarioBD($row[8],$row[10]);//$row[10]es vacio, aun no se ha llenado nada; si es para editar perfil $row[10]: iid_sistema,   $r[8]: iid_sistema
            require_once("../../cvista/usuarios/edita_usuario_registrado.php");
	}
	public function listaPerfiles($id_sistema,$optionsHTML){//Invocado por MostrarPersona
            $o_LFormulario = new LFormulario();
            $arrayCombo = $o_LFormulario->listaPerfiles($id_sistema);
            $o_Combo = new Combo($arrayCombo);
            $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
            return $comboHTML;
	}
        public function listaUsuarioBD($id_sistema,$optionsHTML){//Invocado por MostrarPersona
            $o_LFormulario = new LFormulario();
            $arrayCombo = $o_LFormulario->listaUsuarioBD($id_sistema);
            $o_Combo = new Combo($arrayCombo);
            $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
            return $comboHTML;
	}
        public function listaDatosPerfil($id_sistema){//Dibuja combo con los perfiles
            $o_LFormulario = new LFormulario();
            $datosComboPerfil = $o_LFormulario->getArrayListaPerfiles($id_sistema);
            $o_ComboPerfil = new Combo($datosComboPerfil);
            $opcionesHTML = $o_ComboPerfil->getOptionsHTML();
            $row_ochg = "onchange=\"mostrarPerfil()\"";
            $row_ini = "<select name=\"cbo_filtroPerfil\" id=\"cbo_filtroPerfil\" class=\"combo_sin_borde_blue\" align=\"center\" style=\"font-family:Arial;font-size: 11pt\" ".$row_ochg.">";
            $row_fin = "</select>";
            $comboHTML=$row_ini.$opcionesHTML.$row_fin;
            return $comboHTML;
	}
        public function listaDetallePerfil($activo,$idsistema,$idperfil,$nomformulario){
            $o_LFormulario = new LFormulario();
            $nomformulario = ($nomformulario==''||$nomformulario==null)?'%':$nomformulario;
            $arrayFilas = $o_LFormulario->getDetallePerfil($activo,$idsistema,$idperfil,$nomformulario);

            $arrayTipo = array( "iid_formulario"=>"c",
                                "vnom_formulario"=>"h",
                                "vdesc_formulario"=>"h",
                                "inivel_formulario"=>"c",
                                "iorden_formulario"=>"c",
                                "idepende_formulario"=>"c",
                                "chk_final_formulario"=>"h",
                                "chk_habilitado"=>"h",
                                "opciones"=>"h");
                                
            $arrayCabecera = array( "iid_formulario"=>"ID",
                                    "vnom_formulario"=>"NOMBRE",
                                    "vdesc_formulario"=>"DESCRIPCION",
                                    "inivel_formulario"=>"NIVEL",
                                    "iorden_formulario"=>"ORDEN",
                                    "idepende_formulario"=>"DEPENDE",
                                    "chk_final_formulario"=>"FINAL",
                                    "chk_habilitado"=>"HAB",
                                    "opciones"=>"OPCIONES");

            $o_Tabla = new Tabla1($arrayCabecera,50,$arrayFilas,'tablaOrden','col1','col2','sele','','',0,$arrayTipo,'','');
            $o_Tabla->setColumnasOrdenar(array("iid_formulario","vnom_formulario"));
            $tablaHTML = $o_Tabla->getTabla();
            return $tablaHTML;
        }
        //Dibuja tabla de los servicios de un formulario de perfil
        public function listaPerfFormServ($idsistema,$idperfil,$idformulario){
            $o_LFormulario = new LFormulario();
            $arrayFilas = $o_LFormulario->getPerfFormServ($idsistema,$idperfil,$idformulario);

            $arraycabecera = array( "iid_servicio"=>"ID",
                                    "vnom_servicio"=>"NOMBRE",
                                    "vdesc_servicio"=>"DESCRIPCION",
                                    "boton"=>"BOTON",
                                    "icono"=>"ICONO",
                                    "chk_habilitado"=>"HAB",
                                    "opciones"=>"OPCIONES" );
            //$o_Tabla = new Tabla($arraycabecera,$arrayFilas,'fila1','fila2','filaEncima','filaCabecera','0','onClickFila');
            $o_Tabla = new Tabla($arraycabecera,$arrayFilas,'col1','col2','sele','title','0','');
            $tablaHTML = $o_Tabla->getTabla();
            $row_ini = "<table class='grid' width='100%' border='0' cellpadding='2' cellspacing='0'><tbody>";
            $row_fin ="</tbody></table>";
            return $row_ini.$tablaHTML.$row_fin;
        }
        //Dibuja tabla de los servicios de un formulario de permiso
        public function listaPermisoFormServ($idsistema,$idformulario,$idpersona){
            $o_LFormulario = new LFormulario();
            $arrayFilas = $o_LFormulario->getPermisoFormServ($idsistema,$idformulario,$idpersona);

            $arraycabecera = array( "iid_servicio"=>"ID",
                                    "vnom_servicio"=>"NOMBRE",
                                    "vdesc_servicio"=>"DESCRIPCION",
                                    "boton"=>"BOTON",
                                    "icono"=>"ICONO",
                                    "chk_habilitado"=>"HAB",
                                    "opciones"=>"OPCIONES" );
            //$o_Tabla = new Tabla($arraycabecera,$arrayFilas,'fila1','fila2','filaEncima','filaCabecera','0','onClickFila');
            $o_Tabla = new Tabla($arraycabecera,$arrayFilas,'col1','col2','sele','title','0','');
            $tablaHTML = $o_Tabla->getTabla();
            $row_ini = "<table class='grid' width='100%' border='0' cellpadding='2' cellspacing='0'><tbody>";
            $row_fin ="</tbody></table>";
            return $row_ini.$tablaHTML.$row_fin;
        }
        //Dibuja tabla de los servicios de un formulario
        public function listaFormServ($idsistema,$idformulario,$nomservicio){
            $o_LFormulario = new LFormulario();
            $nomservicio = ($nomservicio==''||$nomservicio==null)?'%':$nomservicio;
            $arrayFilas = $o_LFormulario->getFormServ($idsistema,$idformulario,$nomservicio);

            $arraycabecera = array( "iid_servicio"=>"ID",
                                    "vnom_servicio"=>"NOMBRE",
                                    "vdesc_servicio"=>"DESCRIPCION",
                                    "boton"=>"BOTON",
                                    "icono"=>"ICONO",
                                    "chk_habilitado"=>"HAB",
                                    "opciones"=>"OPCIONES" );
            //$o_Tabla = new Tabla($arraycabecera,$arrayFilas,'fila1','fila2','filaEncima','filaCabecera','0','onClickFila');
            $o_Tabla = new Tabla($arraycabecera,$arrayFilas,'col1','col2','sele','title','0','');
            $tablaHTML = $o_Tabla->getTabla();
            $row_ini = "<table class='grid' width='100%' border='0' cellpadding='2' cellspacing='0'><tbody>";
            $row_fin ="</tbody></table>";
            return $row_ini.$tablaHTML.$row_fin;
        }
        //Devuelve el número de servicios
        public function getNumeroServicios(){
            $o_LFormulario = new LFormulario();
            $numero = $o_LFormulario->getNumeroServicios();
            return $numero;
        }
        //Dibuja tabla de todos los Servicios
        public function listaDetalleServicio($nomservicio){
            $o_LFormulario = new LFormulario();
            $nomservicio = $nomservicio==''?'%':$nomservicio;
            $arrayFilas = $o_LFormulario->getDetalleServicio($nomservicio);

            $arrayTipo = array( "iid_servicio"=>"c",
                                "vnom_servicio"=>"c",
                                "vdesc_servicio"=>"h",
                                "boton"=>"h",
                                "icono"=>"h",
                                "opciones"=>"h" );

            $arrayCabecera = array( "iid_servicio"=>"ID",
                                    "vnom_servicio"=>"NOMBRE",
                                    "vdesc_servicio"=>"DESCRIPCION",
                                    "boton"=>"BOTON",
                                    "icono"=>"ICONO",
                                    "opciones"=>"OPCIONES" );

            $o_Tabla = new Tabla1($arrayCabecera,50,$arrayFilas,'tablaOrden','col1','col2','sele','','',0,$arrayTipo,'','');
            $o_Tabla->setColumnasOrdenar(array("iid_servicio","vnom_servicio"));
            $tablaHTML = $o_Tabla->getTabla();
            return $tablaHTML;
        }
        //Dibuja tabla de todos los Formularios
        public function listaDetalleFormulario($idsistema,$nomformulario){
            $o_LFormulario = new LFormulario();
            $nomformulario = ($nomformulario==''||$nomformulario==null)?'%':$nomformulario;
            $arrayFilas = $o_LFormulario->getDetalleFormulario($idsistema,$nomformulario);
            
            $arrayTipo = array( "iid_formulario"=>"c",
                                "vnom_formulario"=>"h",
                                "vdesc_formulario"=>"h",
                                "inivel_formulario"=>"c",
                                "iorden_formulario"=>"c",
                                "idepende_formulario"=>"c",
                                "vabrir_formulario"=>"c",
                                "chk_final_formulario"=>"h",
                                "chk_habilitado"=>"h",
                                "opciones"=>"h" );

            $arrayCabecera = array( "iid_formulario"=>"ID",
                                    "vnom_formulario"=>"NOMBRE",
                                    "vdesc_formulario"=>"DESCRIPCION",
                                    "inivel_formulario"=>"NIVEL",
                                    "iorden_formulario"=>"ORDEN",
                                    "idepende_formulario"=>"DEPENDE",
                                    "vabrir_formulario"=>"ABRIR",
                                    "chk_final_formulario"=>"FINAL",
                                    "chk_habilitado"=>"HAB",
                                    "opciones"=>"----OPCIONES----" );
            //$o_Tabla = new Tabla($arraycabecera,$arrayFilas,'fila1','fila2','filaEncima','filaCabecera','0','onClickFila');
            //$o_Tabla = new Tabla($arraycabecera,$arrayFilas,'col1','col2','sele','title','0','');
            
            //($_arrayCabecera,$_numFilas,$_arrayFilas='',$_estiloTabla='',$_estiloFila='',$_estiloFilaAlterna='',$_estiloFilaSeleccionada='',$_arrayEventosJS='',$_oyenteEventosJS='',$_indClave='',$_arrayTipos='' ,$_indiceEstados='',$_arrayColorEstado='')
            $o_Tabla = new Tabla1($arrayCabecera,50,$arrayFilas,'tablaOrden','col1','col2','sele','','',0,$arrayTipo,'','');
            $o_Tabla->setColumnasOrdenar(array("iid_formulario","vnom_formulario"));
            $tablaHTML = $o_Tabla->getTabla();
            /*$row_ini = "<table class='grid' width='100%' border='0' cellpadding='2' cellspacing='0'><tbody>";
            $row_fin ="</tbody></table>";
            return $row_ini.$tablaHTML.$row_fin;*/
            return $tablaHTML;
        }
        //Dibuja tabla de todos los Permisos Persona-Formulario
        public function listaDetallePermiso($idsistema,$idpersona,$nomformulario){
            $o_LFormulario = new LFormulario();
            //$idpersona = base64_decode($idpersona);
            $nomformulario = ($nomformulario==''||$nomformulario==null)?'%':$nomformulario;
            $arrayFilas = $o_LFormulario->getDetallePermiso($idsistema,$idpersona,$nomformulario);

            $arrayTipo = array( "iid_formulario"=>"c",
                                "vnom_formulario"=>"h",
                                "vdesc_formulario"=>"h",
                                "inivel_formulario"=>"c",
                                "iorden_formulario"=>"c",
                                "idepende_formulario"=>"c",
                                "chk_final_formulario"=>"h",
                                "chk_habilitado"=>"h",
                                "opciones"=>"h" );
            
            $arrayCabecera = array( "iid_formulario"=>"ID",
                                    "vnom_formulario"=>"NOMBRE",
                                    "vdesc_formulario"=>"DESCRIPCION",
                                    "inivel_formulario"=>"NIVEL",
                                    "iorden_formulario"=>"ORDEN",
                                    "idepende_formulario"=>"DEPENDE",
                                    "chk_final_formulario"=>"FINAL",
                                    "chk_habilitado"=>"HAB",
                                    "opciones"=>"OPCIONES" );

            $o_Tabla = new Tabla1($arrayCabecera,50,$arrayFilas,'tablaOrden','col1','col2','sele','','',0,$arrayTipo,'','');
            $o_Tabla->setColumnasOrdenar(array("iid_formulario","vnom_formulario"));
            $tablaHTML = $o_Tabla->getTabla();
            return $tablaHTML;
        }
	//Guarda nuevo usuario del buscador antiguo
	public function GuardaNuevoUsuario($c){
            $habil = $c["habilitado_usuario"];
            $clave = sha1('123456');

            switch($c["estado"]){
                case 'nuevo'://Registra nuevo empleado como usuario
                    $login = $this->genera_login(substr(trim($c["nombre"]),0,1),trim($c["apellido_p"]),substr(trim($c["apellido_m"]),0,1),$c["idpersona"]);
                    $savus = $this->fn_mante_usuario('inserted',$c["idpersona"],$c["idsistema"],$c["id_perfil"],$login,$clave,$habil,$c["id_usuariobd"]);//Retorna 1 si tiene exito
                    //$rpta  = $savus[0]['fn_mante_usuario'];
                    $rpta = $savus[0];
                    break;
                case 'editar'://Edita un usuario, como sólo perfil por ejemplo
                    $savus = $this->fun_pn_actualiza_perfil($c["idsistema"],$c["idpersona"],$c["id_perfil"],$c["id_usuariobd"]);
                    //$rpta = $savus[0]['fun_pn_actualiza_perfil'];
                    $rpta = $savus[0];
                    break;
                case 'recpwd'://Para el botón restaurar
                    $savus = $this->fn_mante_usuario('updatePwd',$c["idpersona"],$c["idsistema"],$c["id_perfil"],0,$clave,$habil,$c["id_usuariobd"]);
                    //$rpta = $savus[0]['fn_mante_usuario']+1;
                    $rpta = $savus[0]+1;
                    break;
            }
            if($rpta==1){
                $savpf = $this->fn_carga_perfil_formulario($c["idsistema"],$c["id_perfil"],$c["idpersona"]);
                $savps = $this->fn_carga_perfil_servicio($c["idsistema"],$c["id_perfil"],$c["idpersona"]);
                $msj = "Se insertó el registro con éxito. Usuario: $login";
            }else
                if($rpta==2){
                    $msj="Se actualizó la clave con éxito";
                }
                else
                    $msj="No se concretó el ingreso del registro, inténtelo nuevamente o contáctese con su administrador";

            return $msj;
	}
	//Se obtiene las opciones de menu para dibujar el arbol
	public function sp_lista_formulario_tree($idsistema,$idformulario,$select){
            $o_LFormulario = new LFormulario();
            $rs = $o_LFormulario->sp_lista_formulario_tree($idsistema,$idformulario,$select);
            return $rs;
	}
	//Se pasa como parametro $idsistema=2 porque se desea cargar las opciones de menu del HMLO
	public function getArbolMenu($idsistema){
            $o_LFormulario = new LFormulario();
            $arrayMenu = $o_LFormulario->sp_lista_formulario_tree($idsistema,'%','1');
            $arrayIconos = array("1"=>array("icono"=>"historial.png","iconoExpandido"=>"historial.png"),
                                 "2"=>array("icono"=>"forward.png","iconoExpandido"=>"forward.png"),
                                 "3"=>array("icono"=>"groupevent.png","iconoExpandido"=>"groupevent.png"),
                                 "4"=>array("icono"=>"folder_sent_mail.png","iconoExpandido"=>"folder_sent_mail.png"),
                                 "5"=>array("icono"=>"hos_medico.png","iconoExpandido"=>"hos_medico.png"));
            $oTreeMenu = new HTML_TreeMenuFacilito($arrayMenu,"div_arbol","../../../imagen/imagenTreeMenu",$arrayIconos,false,'eventoMenuArbol');
            $oTreeMenu->generaArrayNivelesRecursivo();
            $arrayOficinasNiveles = $oTreeMenu->getArrayNiveles();
            $arrayOficinasRecursivo = $oTreeMenu->getArrayRecursivo();
            $scripJsTreeMenuOficinas = $oTreeMenu->getTreeMenuJSAjax();
            $scripJsTreeMenuOficinas = str_replace("\\\\","\\",$scripJsTreeMenuOficinas);

            return $scripJsTreeMenuOficinas;
	}
	
	public function datosMenuItem($p){
            $o_LFormulario = new LFormulario();
            $arrayMenu = $o_LFormulario->sp_lista_formulario_tree2($p["idsistema"],$p["idformulario"],'2');
            $rs1 = $this->sp_lista_formulario_hijos($p["idsistema"],$p["idformulario"],'%');
            $rs2 = $this->sp_lista_formulario_hermanos($p["idsistema"],$p["idformulario"],'%');
            $cboHnos = $this->cbo_lista_formulario_hermanos($p["idsistema"],$p["idformulario"],'%');
            if(count($rs1)>0){
                $hijos = implode('|',$rs1);
            }
            if(count($rs2)>0){
                $hermanos = implode('|',$rs2);
            }
            $val = $arrayMenu[1];
            //var_dump($cboHnos);
            $toolbar = new ToollBar("left");
            $toolbar->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","nuevoMenuArbol()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png");
            //No funciona aún falta implementar
            $toolbar->SetBoton("NUEVO","Restaurar","btn","onclick,onkeypress","actualizaPwd()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/restaurar.png");
            //Si funciona el evento
            $toolbar->SetBoton("NUEVO","Nuevo Submenu","btn","onclick,onkeypress","eventoSubMenuArbol('m','$val[iid_formulario]','$val[inivel_formulario]')",$_SESSION['path_principal']."../medifacil_front/imagen/icono/restaurar.png");
            //No funciona aún falta implementar
            $toolbar->SetBoton("NUEVO","Editar","btn","onclick,onkeypress","actualizaPwd()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/restaurar.png");
            require_once("../../cvista/permisos/edita_formulario.php");
	}
        //Nuevo Submenu
	public function datosSubMenuItem($val){
            $cboHnos = $this->cbo_lista_formulario_hijos($val["idsistema"],$val["idformulario"],'%');
            $toolbar = new ToollBar("left");
            $toolbar->SetBoton("GRABAR","Grabar","btn","onclick,onkeypress","nuevoMenuArbol()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/grabar.png");
            $toolbar->SetBoton("NUEVO","Restaurar","btn","onclick,onkeypress","actualizaPwd()",$_SESSION['path_principal']."../medifacil_front/imagen/icono/restaurar.png");
            require_once("../../cvista/permisos/edita_formulario.php");
	}
	//Falta implementar para grabar nuevo menu
	public function nuevoMenuItem($val){

            var_export($val);

            $her= explode("|",$val["hermanos"]);
            $fila= array();

            //	for($i=0;$i < count($her);$i++){
            //	$dfila=explode("-",$her[$i]);
            //	array_push($fila,array($dfila[0],$dfila[1]));
            //	}

            foreach($her as $fil){
                $dfila=explode("-",$fil);
                $mam[$dfila[0]]=$dfila[1];
            }

            $j=1;
            foreach($her as $fil){
                $nfila=explode("-",$fil);
                if($nfila[1]!=$j){
                    $nfila[1]=$j;
                    if($nfila[0]==$val["orden_formulario"]){
                        $nmam["nuevo"]=$j;
                        $j++;
                    }
                    $nmam[$nfila[0]]=$j;
                }else{
                    $nmam[$nfila[0]]=$nfila[1];
                }
                $j++;
            }
            //var_export($nmam);
	}
	
	public function sp_lista_formulario_hijos($idsistema,$idformulario,$nomformulario){
                $o_LFormulario = new LFormulario();
                $rs = $o_LFormulario->sp_lista_formulario_hijos($idsistema,$idformulario,$nomformulario);
                foreach ($rs as $fila) {
                    $combo[$fila[0]]=trim($fila[0])."-".trim($fila[2])."-".trim($fila[1]);//0:iid_formulario,1:vnom_formulario,2:iorden_formulario
                }
                return $combo;
	}
	public function sp_lista_formulario_hermanos($idsistema,$idformulario,$nomformulario){
		$o_LFormulario 	= new LFormulario();
		$rs = $o_LFormulario->sp_lista_formulario_hermanos($idsistema,$idformulario,$nomformulario);
		foreach ($rs as $fila) {
                    $combo[$fila[0]]=trim($fila[0])."-".trim($fila[2])."-".trim($fila[1]);//0:iid_formulario,1:vnom_formulario,2:iorden_formulario
		}
		return $combo;	
	}
        //Esto se usa para Nuevo Submenu
	public function cbo_lista_formulario_hijos($idsistema,$idformulario,$nomformulario){
            $o_LFormulario = new LFormulario();
            $arrayCombo = $o_LFormulario->sp_lista_formulario_hijos($idsistema,$idformulario,$nomformulario);
            $comboHer['her_ini'] = "0 Inicio";
            foreach ($arrayCombo as $fila) {
                $comboHer[$fila[0]]=trim($fila[2])." (".trim($fila[1]).")";
            }
            $comboHer['her_fin'] = ($fila[2]+1)." Ultimo";
            $o_Combo = new Combo($comboHer);
            $comboHTML = $o_Combo->getOptionsHTML($idformulario);
            return $comboHTML;
	}	
	public function cbo_lista_formulario_hermanos($idsistema,$idformulario,$nomformulario){
            $o_LFormulario = new LFormulario();
            $arrayCombo = $o_LFormulario->sp_lista_formulario_hermanos($idsistema,$idformulario,$nomformulario);
            $comboHer['her_ini'] = "0 Inicio";
            foreach ($arrayCombo as $fila) {
                $comboHer[$fila[0]]=trim($fila[2])." (".trim($fila[1]).")";//0:iid_formulario,1:vnom_formulario,2:iorden_formulario
            }
            $comboHer['her_fin'] = ($fila[2]+1)." Ultimo";
            $o_Combo = new Combo($comboHer);
            $comboHTML = $o_Combo->getOptionsHTML($idformulario);
            return $comboHTML;
	}	

////////////////////FUNCIONES PARA GUARDAR USUARIO //////////////////////////
	public function fn_mante_usuario($opt,$per,$sis,$pef,$log,$pux,$hab,$ubd){//Guarda nuevo usuario
            $o_LFormulario = new LFormulario();
            $rs = $o_LFormulario->fn_mante_usuario($opt,$per,$sis,$pef,$log,$pux,$hab,$ubd);
            return $rs[0];
	}
	public function fun_pn_actualiza_perfil($id_sistema,$idpersona,$id_perfil,$id_usuariobd){//Edita usuario, como perfil por ejemplo
            $o_LFormulario = new LFormulario();
            $rs = $o_LFormulario->fun_pn_actualiza_perfil($id_sistema,$idpersona,$id_perfil,$id_usuariobd);
            //return $rs;
            return $rs[0];
	}
	public function fn_carga_perfil_formulario($id_sistema,$id_perfil,$idpersona){//Luego de grabar nuevo usuario
            $o_LFormulario = new LFormulario();
            $rs = $o_LFormulario->fn_carga_perfil_formulario($id_sistema,$id_perfil,$idpersona);
            return $rs;	
	}
	public function fn_carga_perfil_servicio($id_sistema,$id_perfil,$idpersona){//Luego de grabar nuevo usuario
            $o_LFormulario = new LFormulario();
            $rs = $o_LFormulario->fn_carga_perfil_servicio($id_sistema,$id_perfil,$idpersona);
            return $rs;
	}
	
////////////////////FIN FUNCIONES PARA GUARDAR USUARIO //////////////////////////	
	
////////////////////FUNCIONES PARA GENERAR EL LOGIN //////////////////////////
	public function genera_login($ini_nombre,$apellido_p,$ini_apellido_m,$idpersona){//Genera login para guardar nuevo usuario
            $login_base	= trim($this->remplaza_caracteres($ini_nombre)).trim($this->remplaza_caracteres($apellido_p)).trim($this->remplaza_caracteres($ini_apellido_m));
            $login = $login_base;
            $numero = 1;
            $band = 0;
            do{
                $result	= $this->fn_busca_login($idpersona,$login);
                //echo "Holaaa";
                //var_dump($result);
                //if($result['fn_busca_login']){
                if($result!=null){//Esto es si encontro el login y el idpersona es de otra persona
                    $login=$login_base.$numero;
                    $numero++;
                    $band=1;
                }
                else
                    $band=0;
            }while($band==1);
            return $login;
	}
	public function fn_busca_login($idpersona,$login){
            $o_LFormulario = new LFormulario();
            $rs = $o_LFormulario->fn_busca_login($idpersona,$login);
            return $rs[0];
	}
	function remplaza_caracteres($cadena){//Reemplaza caracteres especiales por caracteres simples
            $novalido = array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ","'"," ");
            $valido = array("a","e","i","o","u","n","A","E","I","O","U","N","","");
            $cadena = str_replace($novalido, $valido, $cadena);
            return $cadena;
	}
//////////////////// FIN FUNCIONES PARA GENERAR EL LOGIN //////////////////////////
        //Deshabilita un usuario de la lista de usuarios habilitados
	public function fn_habilitar_usuario($parametros){
            $habilita = $parametros['p2'];//Booleano opuesto para deshabilitar un usuario
            $idusuario = $parametros['p3'];//iid_usuario
            $idsistema = $parametros['p4'];//id_sistema
            $o_LFormulario = new LFormulario();
            $rs	= $o_LFormulario->fn_habilitar_usuario($habilita,$idusuario,$idsistema);//$rs=1 si tiene éxito
            return $rs[0][0];
	}
	/*---No se usa
        public function fn_editar_usuario($parametro){
                var_export($parametros);
		$o_LFormulario 	= new LFormulario();
		$rs 			= $o_LFormulario->fn_habilitar_usuario($habilita,$idpersona,$idsistema);
		var_export($rs);
		return $rs[0][0];
	}*/

        //Habilita-Deshabilita formulario de un perfil
	public function spHabFormDePerfil($parametros){
            $idsistema = $parametros['p2'];//id_sistema
            $idperfil = $parametros['p3'];//iid_perfil
            $idformulario = $parametros['p4'];//iid_formulario
            $estado = $parametros['p5'];//estado del formulario del perfil

            $o_LFormulario = new LFormulario();
            $rs	= $o_LFormulario->spHabFormDePerfil($idsistema,$idperfil,$idformulario,$estado);//$rs=1 si tiene éxito
            return $rs[0][0];
	}
        //Habilita-Deshabilita formulario de un permiso
	public function spHabFormDePermiso($parametros){
            $idsistema = $parametros['p2'];//id_sistema
            $idpersona = $parametros['p3'];//iid_persona
            $idformulario = $parametros['p4'];//iid_formulario
            $estado = $parametros['p5'];//estado del formulario del perfil

            $o_LFormulario = new LFormulario();
            $rs	= $o_LFormulario->spHabFormDePermiso($idsistema,$idpersona,$idformulario,$estado);//$rs=1 si tiene éxito
            return $rs[0][0];
	}

        public function spHabServDePerfil($parametros){
            $idsistema = $parametros['p2'];//id_sistema
            $idperfil = $parametros['p3'];//iid_perfil
            $idformulario = $parametros['p4'];//iid_formulario
            $idservicio = $parametros['p5'];//iid_servicio
            $estado = $parametros['p6'];//estado del servicio del perfil

            $o_LFormulario = new LFormulario();
            $rs	= $o_LFormulario->spHabServDePerfil($idsistema,$idperfil,$idformulario,$idservicio,$estado);//$rs=1 si tiene éxito
            return $rs[0][0];
        }

        public function spHabServDePermiso($parametros){
            $idsistema = $parametros['p2'];//id_sistema
            $idpersona = $parametros['p3'];//c_cod_per
            $idformulario = $parametros['p4'];//iid_formulario
            $idservicio = $parametros['p5'];//iid_servicio
            $estado = $parametros['p6'];//estado del servicio del permiso

            $o_LFormulario = new LFormulario();
            $rs	= $o_LFormulario->spHabServDePermiso($idsistema,$idpersona,$idformulario,$idservicio,$estado);//$rs=1 si tiene éxito
            return $rs[0][0];
        }

        public function spHabServDeForm($parametros){
            $idsistema = $parametros['p2'];//id_sistema
            $idformulario = $parametros['p3'];//iid_formulario
            $idservicio = $parametros['p4'];//iid_servicio
            $estado = $parametros['p5'];//estado del servicio del formulario

            $o_LFormulario = new LFormulario();
            $rs	= $o_LFormulario->spHabServDeForm($idsistema,$idformulario,$idservicio,$estado);//$rs=1 si tiene éxito
            return $rs[0][0];
        }

        public function spListaSistema($idSistema){
            $o_LFormulario = new LFormulario();
            $rs	= $o_LFormulario->spListaSistema($idSistema);
            return $rs[0][0];
        }
        //Mantenimiento de perfiles
        public function mantePerfil($parametros){
            $accion = $parametros["accion"];
            $o_LFormulario = new LFormulario();

            switch($accion){
                case 'insertar':
                    $idSistema = $parametros["idSistema"];
                    $idPerfil = $parametros["idPerfil"];
                    $nomPerfil = $parametros["nombre"];
                    $rs = $o_LFormulario->spMantePerfil($accion,$idSistema,$idPerfil,$nomPerfil);
                    $rpta = $rs[0][0];
                    break;
                case 'actualizar':
                    $idSistema = $parametros["idSistema"];
                    $idPerfil = $parametros["idPerfil"];
                    $nomPerfil = $parametros["nombre"];
                    $rs = $o_LFormulario->spMantePerfil($accion,$idSistema,$idPerfil,$nomPerfil);
                    $rpta = $rs[0][0]+1;
                    break;
                case 'eliminar':
                    $idSistema = $parametros["idSistema"];
                    $idPerfil = $parametros["idPerfil"];
                    $rs = $o_LFormulario->spEliminarPerfil($idSistema,$idPerfil);
                    $rpta = $rs[0][0]+2;
                    break;
            }
            if($rpta==1)
                $msj = "Se insertó el perfil con éxito";
            else
                if($rpta==2)
                    $msj = "Se actualizó el perfil con éxito";
                else
                    if($rpta==3)
                        $msj = "Se eliminó el perfil con éxito";
                    else
                        $msj = "No se concretó la acción, inténtelo nuevamente o contáctese con su administrador";
            return $msj;
	}
        //Para mostrar el arbol de puestos por centro de costo
        public function agregarPuestoEmpleado() {
            $o_LFormulario = new LFormulario();
            $arrayCombo = $o_LFormulario->seleccionarCategoria();
            $o_Combo = new Combo($arrayCombo);
            $optionsHTML = '0';
            $comboHTML = $o_Combo->getOptionsHTML($optionsHTML);
            $tablaPuestos = $this->aPuestosXCCostos(1);
            require_once("../../cvista/permisos/buscarPuestosEmpleados.php");
        }

        public function aPuestosXCCostos($datos) {
            $o_LFormulario = new LFormulario();
            $arrayFilas = $o_LFormulario->getListaPuestos($datos);
            $arrayTipo = array("0"=>"c","1"=>"c","2"=>"c","3"=>"c","4"=>"c");
            $arrayColorEstado = array("0"=>"6");
            $arrayCabecera = array("0"=>"Nro","1"=>"Puesto","2"=>"C.Costo","3"=>"Categoria","4"=>"Estado","6"=>"...");

            $o_Html = new Tabla1($arrayCabecera,9,$arrayFilas,'tablaOrden','filax','filay','filaSeleccionada','onClick',$datos['funcion'],0,$arrayTipo,5,$arrayColorEstado);
            //$o_Html->setColumnasOrdenar(array("1","2"));
            return $o_Html->getTabla();
        }

        public function getNombrePerfil($parametros){
            $idsistema = $parametros["idsistema"];
            $idperfil = $parametros["idperfil"];
            $o_LFormulario = new LFormulario();
            $rs = $o_LFormulario->getNombrePerfil($idsistema,$idperfil);
            return utf8_encode($rs[0][0]);
        }
        //Mantenimiento de formularios
	public function manteFormulario($parametros){
            $accion = $parametros["accion"];
            $o_LFormulario = new LFormulario();

            $datosDesencriptados = base64_decode($parametros["datos"]);
            $datosSeparados = explode("|",$datosDesencriptados);
            
            switch($accion){
                case 'insertar':
                    $idSistema = $datosSeparados[0];
                    $idForm = $datosSeparados[1];
                    $nomForm = $datosSeparados[2];
                    $fileForm = $datosSeparados[3];
                    $descForm = $datosSeparados[4];
                    $nivelForm = $datosSeparados[5];
                    $imgForm = $datosSeparados[6];
                    $ordenForm = $datosSeparados[7];
                    $abrirForm = $datosSeparados[8];
                    $habForm = $datosSeparados[9];
                    $finalForm = $datosSeparados[10];
                    $dependeForm = $datosSeparados[11];

                    $rs = $o_LFormulario->spManteFormulario($accion,$idSistema,$idForm,$nomForm,$fileForm,$descForm,$nivelForm,$imgForm,$ordenForm,$abrirForm,$habForm,$finalForm,$dependeForm);
                    $rpta = $rs[0][0];
                    break;
                case 'actualizar':
                    $idSistema = $datosSeparados[0];
                    $idForm = $datosSeparados[1];
                    $nomForm = $datosSeparados[2];
                    $fileForm = $datosSeparados[3];
                    $descForm = $datosSeparados[4];
                    $nivelForm = $datosSeparados[5];
                    $imgForm = $datosSeparados[6];
                    $ordenForm = $datosSeparados[7];
                    $abrirForm = $datosSeparados[8];
                    $habForm = $datosSeparados[9];
                    $finalForm = $datosSeparados[10];
                    $dependeForm = $datosSeparados[11];
                    
                    $rs = $o_LFormulario->spManteFormulario($accion,$idSistema,$idForm,$nomForm,$fileForm,$descForm,$nivelForm,$imgForm,$ordenForm,$abrirForm,$habForm,$finalForm,$dependeForm);
                    //$rpta = $rs[0][0]+1;
                    $rpta = $rs[0][0];
                    break;
                case 'eliminar':
                    $idSistema = $parametros["idSistema"];
                    $idForm = $parametros["idForm"];
                    $rs = $o_LFormulario->spEliminarFormulario($idSistema,$idForm);
                    //$rpta = $rs[0][0]+2;
                    $rpta = $rs[0][0];
                    break;
            }
            /*if($rpta==1)
                $msj = "Se insertó el formulario con éxito";
            else
                if($rpta==2)
                    $msj = "Se actualizó el formulario con éxito";
                else
                    if($rpta==3)
                        $msj = "Se eliminó el formulario con éxito";
                    else
                        $msj = "No se concretó la acción, inténtelo nuevamente o contáctese con su administrador";*/
            if($rpta==1)
                $msj = "Se realizó la acción con éxito";
            else
                $msj = "No se concretó la acción, inténtelo nuevamente o contáctese con su administrador";
            return $msj;
	}
        //Mantenimiento de servicios
	public function manteServicio($parametros){
            $accion = $parametros["accion"];
            $o_LFormulario = new LFormulario();

            switch($accion){
                case 'insertar':
                    $idServicio = $parametros["idServicio"];
                    $nomServicio = $parametros["nombre"];
                    $descServicio = $parametros["descripcion"];
                    $boton=$parametros["imgBoton"];
                    $icono=$parametros["imgIcono"];
                    $rs = $o_LFormulario->spManteServicio($accion, $idServicio, $nomServicio, $descServicio,$boton,$icono);
                    $rpta = $rs[0][0];
                    break;
                case 'actualizar':
                    $idServicio = $parametros["idServicio"];
                    $nomServicio = $parametros["nombre"];
                    $descServicio = $parametros["descripcion"];
                    $boton=$parametros["imgBoton"];
                    $icono=$parametros["imgIcono"];
                    $rs = $o_LFormulario->spManteServicio($accion, $idServicio, $nomServicio, $descServicio,$boton,$icono);
                    $rpta = $rs[0][0]+1;
                    break;
                case 'eliminar':
                    $idServicio = $parametros["idServicio"];
                    $rs = $o_LFormulario->spEliminarServicio($idServicio);
                    $rpta = $rs[0][0]+2;
                    break;
            }
            if($rpta==1)
                $msj = "Se insertó el servicio con éxito";
            else
                if($rpta==2)
                    $msj = "Se actualizó el servicio con éxito";
                else
                    if($rpta==3)
                        $msj = "Se eliminó el servicio con éxito";
                    else
                        $msj = "No se concretó la acción, inténtelo nuevamente o contáctese con su administrador";
            return $msj;
	}
}
?>
