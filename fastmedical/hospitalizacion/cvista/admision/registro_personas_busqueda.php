<div style="width: 100%;border:3px;border-color: #000000;margin-top:0px;margin-bottom:0px;margin-left: 0px;margin-right: 0px;min-height:680px;padding:0px;">
    <div class="titleform" style="width:100%;">
        <h1>Registro de datos del paciente</h1>
    </div>
    <div id="contenido_main" style="width:100%;height:650px;margin:0px; padding:2px; overflow: hidden; z-index:1; position:absolute;">
        <br>
        <table border="0" style="width:97%;margin: 0px;padding: 0px">
            <tr>
                <td valign="top" style="width:40%">
                    <div style="width:100%;height: 360px;background-color: #F9F9f9;" align="left">
                        <?php 
                            require_once("../../ccontrol/control/ActionPersona.php");
                            //print_r($_SESSION["permiso_formulario_servicio"]);
                            //$_SESSION["permiso_formulario_servicio"][118]["GRABAR_CITA"]==1
                            $o_ActionPersona  = new ActionPersona();
                            //$comboTipoDocumentos = $o_ActionPersona->comboTipoDocumento('1');
                            //$obtenerPersonas     = $o_ActionPersona->obtenerPersonas('','','','setDatosPersonasAdmision');
                              $arrayParametros['funcion']="setDatosPersonasAdmision";
                              $arrayParametros['alto']='200px';
                              $arrayParametros['nroOrden']=false;
                              $arrayParametros['codigo']=true;
                              $arrayParametros['documento']=true;
                              $arrayParametros['apellidoPaterno']=true;
                              $arrayParametros['apellidoMaterno']=true;
                              $arrayParametros['nombre']=true;
                              if($_SESSION["permiso_formulario_servicio"][110]["BUSCAR_PAC"]==1)
                                $arrayParametros['bbuscar']=true;
                              else
                                $arrayParametros['bbuscar']=false;
                              if($_SESSION["permiso_formulario_servicio"][110]["BUSCAR_PAC"]==1)
                                $arrayParametros['blimpiar']=true;
                              else
                                $arrayParametros['blimpiar']=false;
                              $arrayParametros['bnuevo']=false;
                              $arrayParametros['editar']=''; //editar: agrega el boton editar, otro valor no lo muestra

                            $obtenerPersonas     = $o_ActionPersona->buscadorPersona($arrayParametros);
                            //require_once("../busqueda/buscador_personas.php");

                        ?>
						<input type="hidden" id="hServicio" name="hServicio" value="">
                    </div>
                    <center><div id="toolbar" style="height:25px;">
                        <?php
                        if($_SESSION["permiso_formulario_servicio"][110]["NUEVO_PAC"]==1){
                            $toolbar=new ToollBar("right");
                            //$toolbar->SetBoton("RESULTADO","Resultado","btn","onclick,onkeypress","ventana_resultado()","../../../../medifacil_front/imagen/icono/resultado.png","","",true);
                            //$toolbar->SetBoton("HC","H.C.","btn","onclick,onkeypress","getDatosPersonasLab(document.getElementById('idBusquedaPersona').value)","../../../../medifacil_front/imagen/icono/historial.png","","",true);
                            //$toolbar->SetBoton("CONTRIBUYENTE","CONTRIBUYENTE","btn","onclick,onkeypress,onDblClick","ventana_contribuyente('setDatosContribuyente')","../../../../medifacil_front/imagen/icono/add_user.png","","",TRUE);
                            $toolbar->SetBoton("NUEVO","Nuevo","btn","onclick,onkeypress","DatosPersonasAdmision('')","../../../../medifacil_front/imagen/icono/nuevo.png","","",true);
                            //$toolbar->SetBoton("VER","Ver Datos","btn","onclick,onkeypress","ventana_formulario_persona('setDatosContribuyente')","../../../../medifacil_front/imagen/icono/add_user.png","","",true);
                            $toolbar->Mostrar();
                        }
                        ?>
                    </div>
                    </center>
                    <div id="idBusquedaPersona"></div>
                    <div id="idHospitalizacionPersona" style="display:none">
                        <?php
                        require_once("../../ccontrol/control/ActionAdmision.php");
                        $o_ActionAdmision = new ActionAdmision();
                        $resultado = $o_ActionAdmision->ListaPersonaHospitalizacion('');
                        echo $resultado;
                        ?>
                    </div>
                </td>
                <td valign="top" style="width:60%">
                    <div id="datos_persona" style="width:100%;height:620px;border:0px solid #000000"  align="left">
                        <?php
                        require_once("../../ccontrol/control/ActionAdmision.php");
                        $o_ActionAdmision	= new ActionAdmision();
                        $resultado=$o_ActionAdmision->formRegistroPersonas('','f');
                        ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>