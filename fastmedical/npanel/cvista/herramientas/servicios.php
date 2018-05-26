<?php
    require_once("../../ccontrol/control/ActionFormulario.php");
    $id_sistema=$_REQUEST["id_sistema"];
    $id_formulario=$_REQUEST["id_formulario"];
    $nomServ='%';//Criterio para la busqueda de servicios

    $o_ActionFormulario = new ActionFormulario();
    //$total = $o_ActionFormulario->getNumeroServicios();
    $htmlServicio = $o_ActionFormulario->listaDetalleServicio($nomServ);
?>
<form action="" id="form_detalle" name="form_detalle" method="get" onsubmit="return false">
    <div id="detalle">
        <table cellpadding="0" cellspacing="0" class="texto_interior">
            <tr>
                <td height="20">
                    <div>
                        <div style="float:left">
                            <span class="blue negrita">LISTADO SERVICIOS</span>
                            <input type="text" name="nombre_servicio" id="nombre_servicio" size="20" onkeyup="buscarServicio()"/>
                        </div>
                        <div style="text-align:right; margin-top:5px; float:right;" class="blue negrita">TOTAL REGISTROS: <?php //echo $total?></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <div id="contenido_detalle" style="overflow: auto;">
                        <?php echo $htmlServicio;?>
                    </div>
                    <div id="botones">
                        <?php
                            /*
                            $Permisos_user = $_SESSION['permiso_formulario_servicio_panel'];//Ya está cargado esto al iniciar sesión
                            $permiso1 = $Permisos_user[$id_formulario]['HABILITAR'];
                            $permiso2 = $Permisos_user[$id_formulario]['EDITAR'];*/
                        ?>
                        <a href='#' onclick="CargarVentana('popupManteServicio','Registro de Sevicios','../herramientas/manteServicio.php?accion=insertar','305','220',false,true,'',1,'',10,10,10,10);"><img src="../../../../fastmedical_front/imagen/btn/b_nuevo_on.gif" alt='Nuevo' title='Nuevo' border='0'/></a>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</form>