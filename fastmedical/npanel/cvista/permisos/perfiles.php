<?php
    require_once("../../ccontrol/control/ActionFormulario.php");
    $id_sistema=$_REQUEST["id_sistema"];
    $id_formulario=$_REQUEST["id_formulario"];
    
    $o_ActionFormulario = new ActionFormulario();
    $cb_perfiles = $o_ActionFormulario->listaDatosPerfil($id_sistema);
    $id_perfil="";
?>
<form action="" id="form_detalle" name="form_detalle" method="get" onsubmit="return false">
    <div id="detalle">
        <table cellpadding="0" cellspacing="0" class="texto_interior"><!--height="100%"--> 
            <tr>
                <td height="20">
                    <div style="float:left">
                        <span class="blue negrita">ADMINISTRADOR DE PERFILES:</span>
                        <?php 
                            if($id_sistema==1){//Carga perfiles de panel
                                echo html_entity_decode($cb_perfiles);
                            }
                            else{
                                if($id_sistema==2){//Carga perfiles de Simedh web
                                    echo "<input type=\"text\" ondblclick=\"seleccionarPerfil()\" name=\"txtNombrePerfil\" id=\"txtNombrePerfil\" size=\"40\" value=\"Seleccione Perfil\" readonly>
                                          <a href=\"#\" onclick=\"seleccionarPerfil()\"><img src=\"../../../../fastmedical_front/imagen/icono/groupevent.png\" alt=\"Perfiles\" title=\"Perfiles\" border=0/></a>";
                                }
                            }
                        ?>
                        <!--<a href='#' onclick="nuevoPerfil()"><img src="../../../../fastmedical_front/imagen/btn/ b_nuevo_on.gif" alt='Nuevo' title='Nuevo' border='0'/></a>-->
                        <!--<input type="text" name="txtNombrePerfil" id="txtNombrePerfil" size="40" value="Seleccione Perfil" readonly/>
                        <a href='#' onclick="seleccionarPerfil()"><img src="../../../../fastmedical_front/imagen/icono/groupevent.png" alt='Perfiles' title='Perfiles' border='0'/></a>-->
                    </div>
                    <div style="float:right">
                        <span class="blue negrita">FORMULARIO</span>
                        <input type="text" name="nombre_formulario_perfil" id="nombre_formulario_perfil" size="20" onkeyup="buscarFormularioDePerfil()"/>
                        <span class="blue negrita">FORMULARIOS ACTIVOS</span>
                        <input type="checkbox" name="chk_activo" id="chk_activo" onclick="mostrarFormulariosActivosDePerfil()"/>
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <div id="contenido_detalle" style="overflow: auto;">
			<?php include('inicioPerfiles.php'); ?>
                    </div>
                    <div id="botones">
                        <?php
                            if($id_sistema==1){//Botones de nuevo perfil solo para el panel web
                                echo "<a href=\"#\" onclick=\"nuevoPerfil()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_nuevo_on.gif\" alt=\"Nuevo\" title=\"Nuevo\" border=0/></a>
                                      <a href=\"#\" onclick=\"editarPerfil()\"><img src=\"../../../../fastmedical_front/imagen/btn/b_editar_on.gif\" alt=\"Editar\" title=\"Editar\" border=0/></a>";
                            }
                        ?>
                        <!--<a href='#' onclick="CargarVentana('popupMantePerfil','Registro de Perfiles','../permisos/mantePerfil.php?id_sistema=<?php //echo $id_sistema?>&accion=insertar','305','180',false,true,'',1,'',10,10,10,10);"><img src="../../../../fastmedical_front/imagen/btn/b_nuevo_on.gif" alt='Nuevo' title='Nuevo' border='0'/></a>
                        <a href='#' onclick="editarPerfil()"><img src="../../../../fastmedical_front/imagen/btn/b_editar_on.gif" alt='Editar' title='Editar' border='0'/></a>-->
                        <!--<a href='#' onclick="eliminarPerfil('eliminar')"><img src="../../../../fastmedical_front/imagen/btn/b_borrar_on.gif" alt='Eliminar' title='Eliminar' border='0'/></a>-->
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <input type="hidden" name="idsistema" id="idsistema" value="<?php echo $id_sistema?>"/>
    <input type="hidden" name="idperfil" id="idperfil" value="0"/>
    <input type="hidden" name="idformulario" id="idformulario" value="<?php echo $id_formulario?>"/>
</form>